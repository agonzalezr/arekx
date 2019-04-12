<?php namespace Config;

use Arekx\Functions;

class ErrorHandler {

    public static function handler_error($errno, $errstr, $errfile, $errline)
    {

        if (!(error_reporting() & $errno))
            return;

        $errfile = str_replace(PATH_FOR_HIDE, "", $errfile);
        $errstr = str_replace(PATH_FOR_HIDE, "", $errstr);

        switch ($errno) {

            case E_ERROR:
                $context['icon'] = "fa-times";
                $context['tipo'] = "error";
                $context['titulo'] = 'Error';
                $context['mensaje'] = static::error_dump($errstr);
                $context['ubicacion'] = "<strong>Archivo:</strong> ".$errfile."<br><strong>Linea:</strong> ".$errline;
                break;

            case E_WARNING:
                $context['icon'] = "fa-exclamation-triangle";
                $context['tipo'] = "warning";
                $context['titulo'] = 'Advertencia';
                $context['mensaje'] = static::error_dump($errstr);
                $context['ubicacion'] = "<strong>Archivo:</strong> ".$errfile."<br><strong>Linea:</strong> ".$errline;
                break;

            case E_NOTICE:
                $context['icon'] = "fa-exclamation";
                $context['tipo'] = "notice";
                $context['titulo'] = 'Aviso';
                $context['mensaje'] = static::error_dump($errstr);
                $context['ubicacion'] = "<strong>Archivo:</strong> ".$errfile."<br><strong>Linea:</strong> ".$errline;
                break;

            default:
                $context['icon'] = "fa-question";
                $context['tipo'] = "default";
                $context['titulo'] = 'Desconocido';
                $context['mensaje'] = static::error_dump($errstr);
                $context['ubicacion'] = "<strong>Archivo:</strong> ".$errfile."<br><strong>Linea:</strong> ".$errline;
                break;
        }

        Functions::render("error_handler", $context);
        exit;
    }

    public static function fatal_handler_error(){
        $last_error = error_get_last();
        if ($last_error['type'] === E_ERROR) {
            static::handler_error(E_ERROR, $last_error['message'], $last_error['file'], $last_error['line']);
        }
    }

    public static function error_dump() {

        $return = "<pre style='background: #eee; border: 1px solid #aaa; clear: both; overflow: auto; padding: 10px; text-align: left; margin-bottom: 5px'>";
        $return .= "\n";

        $args = func_get_args();
        ob_start();
        foreach ($args as $arg)
            print $arg;
        $str = ob_get_contents();
        ob_end_clean();

        $str = str_replace("{main}\n", "{main}", $str);
        $return .= $str . "</pre>";

        return $return;
    }
}