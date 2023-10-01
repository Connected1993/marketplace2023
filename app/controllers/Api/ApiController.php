<?php


namespace market\controllers\Api;

use market\core\Connection;
use market\core\View;
use PDOException;

class ApiController
{
  private array $extensions = ['png', 'jpg', 'webp', 'svg', 'jpeg', '7z', 'rar', 'zip'];
  private int $maxsize = (20 * 1024) * 1024;

  function upload()
  {

    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_INT, ["default" => 'NULL']);
    $articul = filter_input(INPUT_POST, 'articul', FILTER_SANITIZE_NUMBER_INT, ["default" => 'NULL']);
    $count = filter_input(INPUT_POST, 'count', FILTER_SANITIZE_NUMBER_INT, ["default" => 'NULL']);
    $category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_NUMBER_INT, ["default" => 'NULL']);
    $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING, ["default" => 'NULL']);

    $name = empty($name) ? 'NULL' : $name;
    $price = empty($price) ? 'NULL' : $price;
    $articul = empty($articul) ? 'NULL' : $articul;
    $count = empty($count) ? 'NULL' : $count;
    $category = empty($category) ? 'NULL' : $category;
    $description = empty($description) ? 'NULL' : $description;

    $columns = '';

    // сортировка массива в алфавитном порядке
    ksort($_POST);


    foreach ($_POST as $key => $value) {
      $columns .= $key . ',';
    }
    $columns = rtrim($columns, ',');

    $sql = "INSERT IGNORE INTO productShop ($columns) VALUES (:articul,:category,:count,:description,:name,:price)";

    try {
      $stmt = Connection::connect()->prepare($sql);
      $stmt->execute(['articul' => $articul, 'category' => $category, 'count' => $count, 'description' => $description, 'name' => $name, 'price' => $price]);
    } catch (PDOException $error) {
      echo View::responceJsonFailed(['не удалось выполнить запрос', $error->getMessage()], __METHOD__);
      exit;
    }
    // если товар был успешно добавлен, получили его id
    if (Connection::$db->lastInsertId()) {
      $id = Connection::$db->lastInsertId();
      $this->validationUploadFiles($id);
    } else {
      echo View::responceJsonFailed(['не удалось выполнить запрос', ''], __METHOD__);
    }
  }


  private function validationUploadFiles(int $id): void
  {
    // валидировать данные ?
    // 1) все что в POST
    // 2) валидация файлов (размер,расширение и.т.д)
    // если есть хоть 1 файл
    if (count($_FILES)) {
      $moveFiles = [];
      $fName = '';
      $files = [];
      foreach ($_FILES['files']['name'] as $key => $value) {
        $files[$key] = [
          'name' => $_FILES['files']['name'][$key],
          'full_path' => $_FILES['full_path']['name'][$key],
          'type' => $_FILES['files']['type'][$key],
          'tmp_name' => $_FILES['files']['tmp_name'][$key],
          'error' => $_FILES['files']['error'][$key],
          'size' => $_FILES['files']['size'][$key],
        ];
      }

      foreach ($files as $key => $file) {
        $getType = explode('.', $file['name']);
        // получаем расширение файла
        $getType = end($getType);
        // если такой тип разрешен и размер файла не превышает MAXSIZE
        if (array_search($getType, $this->extensions) && ($file['size'] <= $this->maxsize)) {
          // получили имя файла
          $name = explode('.', $file['name']);
          $name = $name[0];

          // avatar_165974352.png
          $fName = $name . '_' . time() . '.' . $getType;
          // замена слешей для кроссплатформенности Ubuntu,Windows,Mac ...
          $tmp = str_replace('\\', '/', $file['tmp_name']);
          $folder = ROOT . '/app/public/uploads/' . $fName;
          $result = move_uploaded_file($file['tmp_name'], $folder);
          // если файл успешно перемещен в постоянную директорию
          if ($result) {
            $moveFiles['num' . $key] = $fName;
          }
        }
      }

      // проверяем массив в котором находятся только те файлы которые прошли валидацию
      if (count($moveFiles)) {
        dump($moveFiles);
        $sql = "INSERT INTO productImages (idProduct,path) VALUES ";
        $values = '';
        foreach ($moveFiles as $key => $path) {
          $values .= "($id,:num$key),";
        }
        // обрезали запятую
        $values = rtrim($values, ',');
        $sql .= $values;

        try {
          $stmt = Connection::connect()->prepare($sql);
          $stmt->execute($moveFiles);
        } catch (PDOException $error) {
          View::responceJsonFailed(['не удалось выполнить запрос', $error->getMessage()], __METHOD__);
        }
        $id = Connection::$db->lastInsertId();
        // если пути на изображения были успешно добавлены, получили его id
        if ($id) {
          View::responceJsonSuccess([$id], __METHOD__);
        }
      }
    }
  }


}