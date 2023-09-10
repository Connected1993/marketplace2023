<?php

use market\library\User as OtherUser,market\User\User as MyUser;


require_once __DIR__.'/../vendor/autoload.php';


$user1 = new \market\library\User('dddd',30);
$user2 = new \market\User\User('dddd',30);
// $user1 = new OtherUser('dddd',30);
// $user2 = new MyUser('ssss',10);