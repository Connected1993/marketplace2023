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

    public function index()
    {
      echo 'базовый индекс!';

    }

    public function __construct(public array $params)
    {
      // создаем обьект вида(интрейфейс)
      $this->view = new View($this->params);
      // запуск загрузки модели для работы с БД
      $this->model = $this->loaderModel();
      $this->params['controller'] = ucfirst(mb_strtolower($this->params['controller']));
      $this->params['action'] = ucfirst(mb_strtolower($this->params['action']));

      foreach ($params['placeholder'] as $key => $param) {
        $param = preg_replace('/{|}/', '', $param);
        preg_match("/$param\/[0-9]+/", $_SERVER['REQUEST_URI'], $id);
        $this->variables[$param] = preg_replace('/[^0-9]/', '', current($id));
      }

    }

    private function loaderModel(): ?Model
    {
      $model = $this->params['controller'];
      $action = $this->params['action'];
      $method = isset($this->params['method']);


      if (!$method)
      {

        $path = "market\models\\" . $model . "\\" . $action . "Model";
        // если существует класс такой модели
        if (class_exists($path)) {
          return new $path();
        } else {
          dump("Модель $action не найдена!");
          exit;
        }

      }

      return new Model();

    }

}
