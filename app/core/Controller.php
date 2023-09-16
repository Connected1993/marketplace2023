<?php


namespace market\core;


abstract class Controller
{
//    вид
    public View $view;
    public ?Model $model;
    public array $variables = [];
    public array $session = [];

    protected ?int $role = 0;

    public function __construct(public array $params)
    {
      // создаем обьект вида(интрейфейс)
        //$this->view = new View();
      // запуск загрузки модели для работы с БД
      $this->model = $this->loaderModel();
    }

    private function loaderModel(): ?Model
    {
      // преобразуем в нижний регистр
      $model = mb_strtolower($this->params['controller']);
      // делаем первый символ в верхнем регистре
      $model = ucfirst($model);

      $action = mb_strtolower($this->params['action']);
      $action = ucfirst($action);

      $path = "market\models\\" .$model. "\\". $action ."Model";

      // если существует класс такой модели
      if (class_exists($path))
      {
        return new $path();
      }
      else
      {
        dump("Модель $action не найдена!");
        exit;
      }

      return null;
    }

}
