<?php namespace Arekx;

use \Twig\Environment;
use \Twig\Error\LoaderError;
use \Twig\Error\RuntimeError;
use \Twig\Error\SyntaxError;
use \Twig\Loader\FilesystemLoader;

class Functions
{
    static function render($template, $context) {
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