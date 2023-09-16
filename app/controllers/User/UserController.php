<?php

declare(strict_types=1);

namespace market\controllers\User;

use market\core\Controller;

class UserController extends Controller {

//    public function __construct()
//    {
//      echo 'Я конструктор  класса '.__CLASS__.PHP_EOL;
//      parent::__construct();
//    }

  public function registration()
    {
        dump($this->params);
        echo PHP_EOL.'<br>типо регистрируемся';
    }
    public function authorization()
    {
        echo 'типо авторизуемся';
    }

}
