<?php

class ErrorsController extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function error404()
    {
        $this->view->message = 'La ruta solicitada no existe';
        $this->view->code = 404;   
        $this->view->render('errors/index', 'StampyMailApp | Error '. $this->view->code, ['error.css'], ['error.js'], []);     
    }
}

?>