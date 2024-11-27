<?php

namespace Core;

use controllers\DashController;

class Router
{
    public function run()
    {
        session_start();
        $url = $_SERVER['REQUEST_URI'];

        switch ($url) {
            case '/index':
                $controllerName = 'App\controllers\AuthController';
                $actionName = 'register';
                break;
            case '/login':
                $controllerName = 'App\controllers\AuthController';
                $actionName = 'login';
                break;
            case '/dash':
                $controllerName = 'App\controllers\DashController';
                $actionName = 'dash';
                break;
            case '/link':
                $controllerName = 'App\controllers\DashController';
                $actionName = 'link';
                break;
            case '/' . $_SESSION['slink']:
                $controllerName = 'App\controllers\DashController';
                $actionName = 'linkr';
                break;
             //Adicionar novas rotas aqui....
            default:
                http_response_code(404);
                echo "Página não encontrada!";
                exit;
        }

        if (class_exists($controllerName)) {
            $controller = new $controllerName();
            if (method_exists($controller, $actionName)) {
                $controller->$actionName();
            } else {
                echo "Método '$actionName' não encontrado no controller '$controllerName'!";
            }
        } else {
            echo "Controller '$controllerName' não encontrado!";
        }
    }
}