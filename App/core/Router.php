<?php

namespace App\core;

class Router
{
    protected $controller = 'home';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

        $url = $this->parseURL($url);

        print_r($url);

        if (isset($url[1])) :
            if (file_exists('../App/controllers/' . $url[1] . '.php')) :
                $this->controller = $url[1];
                unset($url[1]);
            endif;
        endif;

        echo "<br> Controlador a ser chamado: " . $this->controller;

        require_once '../App/controllers/' . $this->controller . '.php';

        $this->controller = new $this->controller;


        if (isset($url[2])) :
            var_dump($url[2]);
            if (method_exists($this->controller, $url[2])) :
                $this->method = $url[2];
                unset($url[2]); // apaga o metodo da string url

            else :
                echo 'Não achou o método<br />';
            endif;
        endif;


        echo 'method: ' . $this->method;


        unset($url[0]);

        if ($url) :
            $this->param = array_values($url);
        else :
            $this->param = [];
        endif;

        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseURL($url)
    {

        $aux = filter_var($url, FILTER_SANITIZE_URL);

        if (substr($aux, -1) == '/') :
            $aux = substr($aux, 0, -1);
        endif;
        $test = explode('/', $aux);


        return explode('/', $aux);
    }
}
