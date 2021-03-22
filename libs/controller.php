<?php

abstract class Controller
{
    protected View $view;

    protected function __construct()
    {
        $this->view = new View();
    }

    function loadModel(string $model) {
        $url = 'models/' . $model . '-model.php';

        if(file_exists($url)){
            require_once $url;
            $modelName = $model.'Model';
            return new $modelName();
        }

        return null;
    }

    function getGet(string $name): string{
        return $_GET[$name];
    }

    function getPost(string $name): string{
        return $_POST[$name];
    }

    function allPost(): array {
        return $_POST;
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
