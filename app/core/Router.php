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

}
