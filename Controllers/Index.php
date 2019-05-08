<?php namespace Controllers;

use Arekx\Render;
use Arekx\Controller;

class Index implements Controller {

	function default(){

		$context = [
			"title" => "The server is working...",
			"message" => "Hello, World!"
		];

		Render::html("hello", $context);

	}
}
