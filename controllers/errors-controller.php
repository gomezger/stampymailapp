<?php

class ErrorsController extends Controller
{
    function __construct()
    {
        parent::__construct();
        //$this->view->render('errors/index');
    }

    function error404()
    {
        $this->view->message = 'La ruta solicitada no existe';
        $this->view->code = 404;   
        $this->view->render('errors/index');     
    }
}

?>