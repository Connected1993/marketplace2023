<?php

declare(strict_types=1);

use market\core\Router;
/*
    Маршрутизатор URL
*/

Router::addUrl('/','Main');
Router::addUrl('/admin','Admin','banned');
Router::addUrl('/registration','User','registration');
Router::addUrl('/authorization','User','authorization');
Router::addUrl('/catalog','Product','catalog');


Router::addRequest('/create','User','create','POST');

