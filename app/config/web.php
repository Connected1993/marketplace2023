<?php

declare(strict_types=1);

use market\core\Router;
/*
    Маршрутизатор URL
*/

Router::addUrl('/product/id/{id}','User','uploads');
Router::addUrl('/','Main');
Router::addUrl('/admin','Admin','banned');
Router::addUrl('/registration','User','registration');
Router::addUrl('/authorization','User','authorization');
Router::addUrl('/catalog','Product','catalog');
Router::addUrl('/create','User','create');

//Router::addUrl('/api/v1/{value}/method/{methodName}/','User','uploads');



