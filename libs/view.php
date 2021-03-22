<?php

class View
{

    function __construct()
    {
    }

    function render($nombre, $title = 'StampyMail App', $styles = [], $jsFiles = [], $data = [])
    {
        $this->d = $data;
        $this->title = $title;
        $this->styles = $styles;
        $this->jsFiles = $jsFiles;
        require 'views/modules/header.php';
        require 'views/' . $nombre . '.php';
        require 'views/modules/footer.php';
    }


    
}
