<?php


namespace market\controllers\Api;

use market\core\Connection;
use market\core\Controller;

class ApiController
{
  private array $extensions = ['png', 'jpg', 'webp', 'svg', 'jpeg', '7z', 'rar', 'zip'];
  private int $maxsize = (20 * 1024) * 1024;

  function upload()
  {
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
    //dump($_POST);
    dump($_FILES);

  }
}