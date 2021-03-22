<?php

include_once 'session-controller.php';

class LoginController extends SessionController
{

    function __construct()
    {
        parent::__construct();
    }

    function default() {
        $this->view->render('login/index');
    }

}
