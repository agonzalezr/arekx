<?php namespace Config;

class Request
{
    private $controller = DEFAULT_CONTROLLER;
    private $method = DEFAULT_METHOD_NAME;
    private $data = NULL;

    public function __construct()
    {
        if(isset($_GET[VARIABLE_NAME]))
        {
          $route = filter_input(INPUT_GET, VARIABLE_NAME, FILTER_SANITIZE_URL);
          $route = explode("/", $route);
          $route = array_filter($route);
          $this->controller = ucfirst(strtolower(array_shift($route)));
          $this->method = strtolower(array_shift($route));
          $this->data = $route;
          if(!$this->method)
              $this->method = DEFAULT_METHOD_NAME;
        }
    }

    public function getController(){
    return $this->controller;
    }

    public function getMethod(){
    return $this->method;
    }

    public function getData(){
    return $this->data;
    }

}
