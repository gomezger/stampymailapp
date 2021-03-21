<?php

class UserController extends Controller
{

    function __construct()
    {
        parent::__construct();
    }

    function insert()
    {
        echo $_POST['username'];

        $user = $this->loadModel('User');       
        $user->insert();
    }
}
