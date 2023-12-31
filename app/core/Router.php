<?php

declare(strict_types=1);

namespace market\core;

class Router
{

  // массив доступных url
  public static array $pages = [];
  public static array $request = [];

  /**
   * $pages = [
   *  '/admin' => ['controller'=>контроллер который запустим,'action'=>'метод который запустим']
   * ];
   *
   * метод добавление url адреса
   * @param $page - string url
   * @param $controller - string контроллер который будет запущен
   * @param $action - string метод который будет запущен
   * @return void
   *  */

  public static function addUrl(string $page, string $controller, string $action = 'index'): void
  {
    self::$pages[$page] = ['controller' => $controller, 'action' => $action];
  }

  public static function addRequest(string $page, string $controller, string $action = 'index', string $method = 'GET'): void
  {
    self::$pages[$page] = ['controller' => $controller, 'action' => $action, 'method' => $method];
  }

  public static function redirect($url)
  {
    header("Location: " . $_SERVER['REQUEST_SCHEME'] . "://" . HOST . "/$url", true, 301);
    exit;
  }


  public static function run(): void
  {
    $uri = rtrim($_SERVER['REQUEST_URI'], '/');
    $uri = (empty($uri)) ? '/' : $uri;
    $uri = explode('?', $uri);
    $uri = $uri[0];

    // перебираем все ссылки которые были добавлены в файле web.php
    foreach (self::$pages as $page => $params) {
      // проверяем есть ли такой url в нашем маршрутизаторе web.php
      //  ---    \/product\/id\/{id}
      $validationPage = str_replace('/', '\/', $page);
      $result = preg_match_all('/{\w+}/', $validationPage, $dynamic);
      if ($result) {
        $pattern = preg_replace('/{\w+}/', '\d+', $validationPage) . '$';
      } else {
        $pattern = $validationPage . '$';
      }

      $result = preg_match("/$pattern/", $uri);

      if ($result) {
          $controller = self::$pages[$page]['controller'];
          $action = self::$pages[$page]['action'];
          $path = "market\controllers\\" . $controller . "\\" . $controller . "Controller";
          // существует ли такой класс ?
          if (class_exists($path)) {
            // если есть такой метод
            if (method_exists($path, $action)) {
                $params = array_merge( self::$pages[$page], ['placeholder'=>current($dynamic)] );
                $controller = new $path($params);
                $controller->$action();
                exit;
              } else {
                dump("Метод $action не найден!");
                exit;
            }
          } else {
            dump("Класс $controller не найден!");
            exit;
          }
      }
    }
    self::redirect('404.php');
  }

}

