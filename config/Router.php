<?php namespace Config;

use \Twig\Environment;
use \Twig\Loader\FilesystemLoader;

class Router {

  public static function run(Request $request) {

    date_default_timezone_set('America/Mexico_City');
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
    set_error_handler([ErrorHandler::class, 'handler_error']);
    register_shutdown_function([ErrorHandler::class, 'fatal_handler_error']);

    $controller = $request->getController();
    $method = $request->getMethod();
    $data = $request->getData();

    $route = DOCUMENT_ROOT . "controllers" . DIRECTORY_SEPARATOR . $controller . ".controller.php";
    if(is_readable($route))
    {
      try {
          require_once $route;
          $controller_class = "controllers\\" . $controller;
          $controller_class = new $controller_class;

          (!isset($data)) ? call_user_func(array($controller_class, $method)) : call_user_func_array(array($controller_class, $method),$data);

      }catch(\ArgumentCountError $e){

          $context = [
              'icon' => "fa-times",
              'tipo' => "error",
              'titulo' => 'URL inválida',
              'mensaje' => $e->getMessage(),
          ];

          echo static::twig()->render('error_handler.html.twig', $context);
      }
    }

    }

    private static function twig(){
        return new Environment(new FilesystemLoader(VIEWS_PATH));
    }

}
