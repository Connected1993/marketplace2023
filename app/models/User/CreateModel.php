<?php

namespace market\models\User;

use market\core\Connection;
use market\core\Model;
use market\core\View;

class CreateModel extends Model
{
    const TABLE_NAME = 'users';

    public function create(string $hash):bool
    {

      // валидация данных
      $email = filter_var($_POST['email'],FILTER_VALIDATE_EMAIL);
      $phone = filter_var($_POST['phone'],FILTER_VALIDATE_INT);

      if (!$email || !$phone) View::responceJsonFailed(['не верные данные!'],'create');

      $sql = "INSERT IGNORE INTO ".self::TABLE_NAME. " (login,password,email,phone) VALUES (:login,:password,:email,:phone)";
      // отправляем запрос
      $stm = Connection::$db->prepare($sql);

      try {
        $stm->execute(['login'=>$_POST['login'],'password'=>$_POST['password'],'email'=>$email,'phone'=>$phone]);
      } catch (\PDOException $e)
      {
        View::responceJsonFailed(['Сервис временно не доступен!'],'create');
      }
      $id = (int)Connection::$db->lastInsertId() ?? false;

      if ($id === 0)
      {
        View::responceJsonFailed(['Такой пользователь уже существует!'],'create');
      }
      // если запись в базу удалась, тогда в $id будет какой-то номер
      if ($id)
      {
        View::responceJsonSuccess(['Поздравляем, Вы успешно зарегистрировалрись!'],'create');
      }

    }
}