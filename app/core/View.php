<?php

namespace market\core;


class View
{
  private array $modules_css = [];
  private array $modules_js = [];
  private array $modules_remote_css = [];
  private array $modules_remote_js = [];
  public static string $path;
  public string $IMPORT_MODULE_CSS = '';
  public string $IMPORT_MODULE_JS = '';

  public function __construct(public array $params)
  {
    // xampp http://localhost/marketplace
    if ($_SERVER['SERVER_NAME'] == 'localhost') {
      self::$path = ROOT . '/' . PROJECT . '/app/views';
      return;
    }

    // если используем алиас/псевдоним
    // http://marketplace/
    self::$path = ROOT . '/app/views';
  }

  public function AddJS(string $path, bool $remote = false)
  {
    if ($remote) {
      $this->modules_remote_js[] = $path;
    } else {
      $this->getFile($path);
    }
  }

  public function AddCss(string $path, bool $remote = false)
  {
    if ($remote) {
      $this->modules_remote_css[] = $path;
    } else {
      $this->getFile($path);
    }
  }


  private function getFile(string $path): void
  {
    try {
      $old = $path;
      // разбиваем по делиметру
      $arr = explode('/', $path);
      // получили имя файла
      $fName = array_pop($arr);
      // получаем расширения
      $ext = explode('.', $fName);
      $ext = end($ext);

      // вернули в строку
      $path = implode('/', $arr);
      // получаем полный путь к файлу
      $path = ROOT . '/app/public/' . $ext . '/' . $path . '/' . $fName;
      // проверяем, что файл существует
      if (file_exists($path)) {
        // получаем время последнего изменения файла
        $time = filemtime($path);
        $old .= '?v=' . $time;
        switch ($ext) {
          case 'js':
            $this->modules_js[] = $old;
            break;
          case 'css':
            $this->modules_css[] = $old;
            break;
          default:
            throw new \Exception('Недопустимый формат!');
            break;
        }
      }
    } catch (\Exception $e) {
      //throw new \Exception('Неизвестная ошибка!');
    }
  }

  private function imports(): void
  {
    foreach ($this->modules_remote_css as $link) {
      $this->IMPORT_MODULE_CSS .= "<link rel='stylesheet' href='$link'>" . PHP_EOL;
    }

    foreach ($this->modules_css as $link) {
      $this->IMPORT_MODULE_CSS .= "<link rel='stylesheet' href='/app/public/css/$link'>" . PHP_EOL;
    }

    foreach ($this->modules_remote_js as $link) {
      $this->IMPORT_MODULE_JS .= "<script defer src='$link'></script>" . PHP_EOL;
    }

    foreach ($this->modules_js as $link) {
      $this->IMPORT_MODULE_JS .= "<script defer src='/app/public/js/$link'></script>" . PHP_EOL;
    }

    /*    foreach ($this->modules_remote_js as $link) {
          $this->IMPORT_MODULE_JS .= "<script defer type='module' src='$link'></script>" . PHP_EOL;
        }

        foreach ($this->modules_js as $link) {
          $this->IMPORT_MODULE_JS .= "<script defer type='module' src='/app/public/js/$link'></script>" . PHP_EOL;
        }*/
  }

  public static function responceJsonSuccess(array $data, string $method): string
  {
    $method = explode('\\', $method);
    $method = end($method);
    echo json_encode(['success' => true,'result' => $data,'method' => $method], JSON_UNESCAPED_UNICODE);
    exit;
  }

  public static function responceJsonFailed(array $data, string $method): string
  {
    $method = explode('\\', $method);
    $method = end($method);
    echo json_encode(['success' => false,'result' => $data,'method' => $method], JSON_UNESCAPED_UNICODE);
    exit;
  }

  public function render(array $data = [])
  {

    $this->imports();

    require_once self::$path . '/header.php';
    // подключаем нужный интерфейст в зависимости от url

    //C:\OpenServer\domain\marketplace2023\app\views\User\registration.php
    require_once self::$path . '/' . $this->params['controller'] . '/' . strtolower($this->params['action']) . '.php';

    require_once self::$path . '/footer.php';
  }
}