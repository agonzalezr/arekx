<?php namespace Controllers;

use Twig_Environment;
use Twig_Loader_Filesystem;

class Index {

	function default(){
		$context = [
			"title" => "The server is runnig...",
			"hello_world" => "<h1>Hello, World!"
		];
		echo $this->twig()->render('index.html.twig', $context);
	}

	private function twig(){
	    return new Twig_Environment(new Twig_Loader_Filesystem(VIEWS_PATH));
	}
}
