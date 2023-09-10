<?php

declare(strict_types=1);

// подключить класс из указанного пространства имен
use market\core\Router;
 
require_once 'vendor/autoload.php';
// конфигурация отслеживания ошибок
require_once 'app/errors/logger.php';
// файл конфигураций
require_once 'app/config/config.php';

require_once 'app/core/Router.php';

// список страниц!!!
require_once 'app/config/web.php';


Router::run();
