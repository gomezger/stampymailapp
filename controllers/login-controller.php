<?php

include_once 'session-controller.php';
include_once 'models/login-model.php';
include_once 'helpers/validate.php';

class LoginController extends SessionController
{

    function __construct()
    {
        parent::__construct();
    }

    function default (array $params = []): void {        
        $data = (isset ($params[0])) ? ["error"=>$params[0]] : [];
        $this->view->render('users/login', 'StampyMailApp | Login', ['login.css'], [], $data);
    }

    function form (array $params = []): void {
        $this->default($params);
    }

    
    function authenticate(): void {

        $errors = Validate::required($_POST, ['username', 'password']);

        if( count($errors) == 0){
            $username = $this->getPost('username');
            $password = $this->getPost('password');

            //validate data
            if($username == '' || empty($username) || $password == '' || empty($password)){
                $error = Encryption::encrypt('El usuario y/o contraseña  son obligatorios');
                $this->redirect('login/form/' . $error);
                return;
            }

            // si el login es exitoso regresa solo el ID del usuario
            $login = new LoginModel();
            $user = $login->login($username, $password);

            if($user != NULL){
                // inicializa el proceso de las sesiones
                $this->initialize($user);
            }else{
                $error = Encryption::encrypt('El usuario y/o contraseña incorrectas');
                $this->redirect('login/form/' . $error);
                return;
            } 
        }else{
            $error = Encryption::encrypt('El usuario y/o contraseña  son obligatorios');
            $this->redirect('users/form/' . $error);
        }
    }
    

}
