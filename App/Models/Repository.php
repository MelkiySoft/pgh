<?php

namespace App\Models;


class Repository
{

    public $name;
    public $url;
    public $size;
    public $forks;
    public $stars;

    function __construct($name, $url, $size, $forks, $stars)
    {
        $this->name = $name;
        $this->url = $url;
        $this->size = $size;
        $this->forks = $forks;
        $this->stars = $stars;
    }
}