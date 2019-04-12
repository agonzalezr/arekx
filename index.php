<?php
require_once 'config/Autoload.php';
Config\Autoload::start();
Config\Router::run(new Config\Request());