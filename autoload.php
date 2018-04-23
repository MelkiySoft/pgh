<?php

/**
 * App\Models\Cat => ./App/Models/Cat.php
 * @param $class
 */
function __autoload($class)
{
    $path = __DIR__ . '/' .str_replace('\\', '/', $class) . '.php';
    if (file_exists($path)) {
        require_once($path);
    }
}
