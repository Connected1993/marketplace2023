<?php


namespace market\models\User;


use market\core\Model;

class AuthorizationModel extends Model
{
    public function auth(string $login,string $password): array
    {
      //$sql =" SELECT * FROM Users WHERE login='$login' and password='$password' ";
      return ['Данные о пользователе с базы!'];
    }
}