<?php namespace Config;

class Autoload
{
  public static function start(){

    require_once __DIR__ . "/Globals.php";
    require_once SYSTEM_ROOT . "Libs/autoload.php";

    spl_autoload_register(function($class){
        $route = SYSTEM_ROOT . str_replace("\\", "/", $class) . ".php";
        if(is_readable($route))
            require_once $route;
    });
  }
}
