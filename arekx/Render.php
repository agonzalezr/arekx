<?php namespace Arekx;

use \Twig\Environment;
use \Twig\Error\LoaderError;
use \Twig\Error\RuntimeError;
use \Twig\Error\SyntaxError;
use \Twig\Loader\FilesystemLoader;

class Render
{
    static function json($arr)
    {
        header('Content-Type: application/json; charset=utf-8');
        print json_encode($arr,JSON_PRETTY_PRINT ,JSON_UNESCAPED_UNICODE);
    }

    static function html($template, $context) {
        try {
            print static::twig()->render($template . '.html.twig', $context);
        } catch (LoaderError $e) {
            print $e->getMessage();
        } catch (RuntimeError $e) {
            print $e->getMessage();
        } catch (SyntaxError $e) {
            print $e->getMessage();
        }
    }

    private static function twig(){
        return new Environment(new FilesystemLoader(VIEWS_PATH));
    }
}