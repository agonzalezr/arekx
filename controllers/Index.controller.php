<?php namespace Controllers;

use \Twig\Environment;
use \Twig\Loader\FilesystemLoader;

class Index {

	function default(){
		$context = [
			"title" => "The server is runnig...",
			"hello_world" => "Hello, World!"
		];
		echo $this->twig()->render('index.html.twig', $context);
	}

	private function twig(){
	    return new Environment(new FilesystemLoader(VIEWS_PATH));
	}
}
