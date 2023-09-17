<?php

namespace market\core;

use \PDO,\PDOException;

abstract class Connection
{
  //https://server170.hosting.reg.ru/phpmyadmin/index.php
  private static string $DB_NAME = '';
  private static string $DB_LOGIN = '';
  private static string $DB_PASSWORD = '';
  private static string $DB_HOST = '';

  public static $db = null;

  /**
   * https://www.php.net/manual/ru/pdo.setattribute.php
   *
   * */
  private static array $params = [
    // по умолчанию возвращаем ассоциативный массив
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    // кодировка
    PDO::MYSQL_ATTR_INIT_COMMAND => " SET NAMES 'utf8mb4' ",
    // держим постоянное соединение с БД ( даже если скрипт был завершен)
    PDO::ATTR_PERSISTENT => true,
    // Включить или отключить эмуляцию подготовленных запросов
    PDO::ATTR_EMULATE_PREPARES => true,
  ];

  public static function connect(): PDO
  {
    if (!self::$db) {
      try {
        self::$db = new PDO('mysql:dbname=' . self::$DB_NAME . ';host=' . self::$DB_HOST, self::$DB_LOGIN, self::$DB_PASSWORD, self::$params);
      } catch (PDOException $error) {
        // тормозим скрипт если была ошибка при коннекте к БД
        die($error->getMessage());
      }
    }
    return self::$db;
  }
}