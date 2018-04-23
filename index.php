<?php 

require __DIR__ . '/autoload.php';

//заглушка
//$_POST['jSonDataForGitHub'] = '111';
//var_dump($_POST);
//var_dump($_SERVER);

if (empty($_POST['jsonForGitHub'])) {
    $controller = new \App\Controllers\AddRules();
    $controller->action();
} else {
    $controller = new \App\Controllers\getGitHubInfo();
    $controller->action();
}
