<?php

namespace App\Controllers;

use App\Models\RepoPage;
use App\View;

class getGitHubInfo
{
    protected $view;

    public function __construct()
    {
        $this->view = new View();
    }

    public function action()
    {
        $inf = new RepoPage($_POST['jsonForGitHub']);
        $tmp = $inf->getArrRepos();
        $this->view->responseGitHub = $tmp;
        $this->view->display(__DIR__ . '/../templates/gitHubInfo.php');
    }
}