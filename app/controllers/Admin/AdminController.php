<?php

declare(strict_types=1);

namespace market\controllers\Admin;

use market\core\Controller;
use market\core\View;

class AdminController extends Controller
{

  public function index()
  {
    $this->view->AddCss('admin/drag.css');
    $this->view->AddJS('https://kit.fontawesome.com/f931fab46d.js', true);
    $this->view->AddJS('admin/drag.js');
    $this->view->render();
  }


}
