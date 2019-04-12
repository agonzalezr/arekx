<?php namespace Config;

class Autoload
{
  public static function start(){

    require_once "Globals.php";
    require_once DOCUMENT_ROOT."vendor/autoload.php";

    spl_autoload_register(function($class){
        $route = DOCUMENT_ROOT . str_replace("\\", "/", $class) . ".php";
        if(is_readable($route))
            require_once $route;
        break; 
    });
  }
}
