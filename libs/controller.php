<?php

abstract class Controller
{
    protected View $view;

    protected function __construct()
    {
        $this->view = new View();
    }

    function loadModel(string $model): Model {
        $url = 'models/' . $model . '-model.php';

        if(file_exists($url)){
            require_once $url;
            $modelName = $model.'Model';
            return new $modelName();
        }

        return null;
    }
    
    function existPOST(array $params): bool{
        foreach ($params as $param) {
            if(!isset($_POST[$param])){
                error_log("ExistPOST: No existe el parametro $param" );
                return false;
            }
        }
        error_log( "ExistPOST: Existen parámetros" );
        return true;
    }

    function existGET(array $params): bool{
        foreach ($params as $param) {
            if(!isset($_GET[$param])){
                return false;
            }
        }
        return true;
    }

    function getGet(string $name): string{
        return $_GET[$name];
    }

    function getPost(string $name): string{
        return $_POST[$name];
    }

    function redirect(string $url, array $mensajes = []): void{
        $data = [];
        $params = '';
        
        foreach ($mensajes as $key => $value) {
            array_push($data, $key . '=' . $value);
        }
        $params = join('&', $data);
        
        if($params != ''){
            $params = '?' . $params;
        }
        header('location: ' . constant('URL') . $url . $params);
    }

}
