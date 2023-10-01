<?php

declare(strict_types=1);

use market\core\Router;
/*
    Маршрутизатор URL
*/

Router::addUrl('/', 'Main');
Router::addUrl('/admin/panel', 'Admin', 'index');
Router::addUrl('/registration', 'User', 'registration');
Router::addUrl('/authorization', 'User', 'authorization');
Router::addUrl('/catalog', 'Product', 'catalog');
Router::addUrl('/create', 'User', 'create');
Router::addUrl('/product/id/{id}', 'User', 'uploads');


Router::addRequest('/upload', 'Api', 'upload', 'POST');
//Router::addUrl('/api/v1/{value}/method/{methodName}/','User','uploads');



