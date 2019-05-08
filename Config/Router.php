<?php namespace Config;

use Arekx\Render;

class Router {

  public static function run(Request $request) {

    date_default_timezone_set(TIMEZONE);
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
    set_error_handler([ErrorHandler::class, 'error_handler']);
    register_shutdown_function([ErrorHandler::class, 'fatal_error_handler']);

    $controller = $request->getController();
    $method = $request->getMethod();
    $data = $request->getData();

    $route = SYSTEM_ROOT . CONTROLLER_DIR . DIRECTORY_SEPARATOR . $controller . ".php";
    if(is_readable($route))
    {
      try {
          require_once $route;
          $controller_class = CONTROLLER_DIR . "\\" . $controller;
          $controller_class = new $controller_class;

          (!isset($data)) ? call_user_func(array($controller_class, $method)) : call_user_func_array(array($controller_class, $method),$data);

      }catch(\ArgumentCountError $e){

          $context = [
              'icon' => "fa-times",
              'tipo' => "error",
              'titulo' => 'URL inválida',
              'mensaje' => $e->getMessage(),
          ];

          Render::html("error_handler", $context);
      }
    }

    }
}
