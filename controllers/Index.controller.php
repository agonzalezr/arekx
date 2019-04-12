<?php namespace Controllers;

use Arekx\Functions;

class Index {

	function default(){

		$context = [
			"title" => "The server is working...",
			"message" => "Hello, World!"
		];

		Functions::render("hello", $context);

	}


}
