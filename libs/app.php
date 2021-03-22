<?php
require_once 'controllers/errors-controller.php';

class app
{

    function __construct()
    {

        // obtener datos de la url
        $url = isset($_GET['url']) ? $_GET['url'] : null;
        $url = rtrim($url, '/');
        $url = explode('/', $url);

        var_dump($url);
        exit;

        // si no hay ruta: abro url main
        if (empty($url[0])) {

            $fileController = 'controllers/login-controller.php';
            require_once $fileController;
            $controller = new LoginController();
            $controller->default();
            return;
        }

        // hay controlador
        $fileController = 'controllers/' . $url[0] . '-controller.php';

        if (file_exists($fileController)) {
            require_once $fileController;

            $nameController = $url[0] . 'Controller';
            $controller = new $nameController;

            // hay metodo
            if (isset($url[1])) {

            
                if (method_exists($controller, $url[1])) {

                    if (isset($url[2])) {
                        // tiene parametros
                        $i = 2;
                        $params = [];
                        while(isset($url[$i])) {
                            array_push($params, $url[$i]);
                            $i++;
                        }

                        $controller->{$url[1]}($params);
                        return;

                    } else {
                        // no tiene parametros, se llama a la función
                        $controller->{$url[1]}();
                        return;
                    }
                } 
            } else {
                // no hay metodo, porque cual abro por defecto
                $controller->default();
                return;
            }
        }

        $controller = new ErrorsController();
        $controller->error404(); */
    }
}
