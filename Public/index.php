<?php
require_once '../Config/Autoload.php';
Config\Autoload::start();
Config\Router::run(new Config\Request());