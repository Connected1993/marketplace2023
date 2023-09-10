<?php

declare(strict_types=1);

class Router {

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
        self::$pages[$page] = ['controller' => $controller,'action' => $action];
    }


    public static function run():void
    {
        $uri = rtrim($_SERVER['REQUEST_URI'], '/');
        $uri = ( empty($uri) ) ? '/' : $uri;
        $uri = explode('?', $uri);
        $uri = $uri[0];
        dump(self::$pages);
         // перебираем все ссылки которые были добавлены в файле web.php
        foreach(self::$pages as $page => $params)
        {
            // проверяем есть ли такой url в нашем маршрутизаторе web.php
            if ($page === $uri)
            {
                $controller = self::$pages[$page]['controller'];
                $action = self::$pages[$page]['action'];
            }
        } 
    }

}

