<?php

namespace App\Controllers;


use App\View;

class AddRules
{
    protected $view;

    public function __construct()
    {
        $this->view = new View();
    }
    
    public function action()
    {
        $this->view->display(__DIR__ . '/../templates/index.php');
    }
}
