<?php namespace Controllers;

use Arekx\Render;

class Index {

	function default(){

		$context = [
			"title" => "The server is working...",
			"message" => "Hello, World!"
		];

		Render::html("hello", $context);

	}

}
