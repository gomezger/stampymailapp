<?php

class LoginController extends Controller
{

    function __construct()
    {
        parent::__construct();
    }

    function default() {
        $this->view->render('login/index');
    }

}
