<?php


namespace market\core;


class Model extends Connection
{
  public function __construct()
  {
    // подключаемся к бд
    Connection::connect();
  }
}