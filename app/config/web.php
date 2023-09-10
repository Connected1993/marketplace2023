<?php

declare(strict_types=1);

/*
    Маршрутизатор URL
*/

Router::addUrl('/admin','Admin','banned');
Router::addUrl('/registration','User','registration');
Router::addUrl('/authorization','User','authorization');