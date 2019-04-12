<?php

/* Main Config */
define('DOCUMENT_ROOT', realpath(dirname(__FILE__,2)) . DIRECTORY_SEPARATOR);
define('DEFAULT_CONTROLLER', 'Index');
define('DEFAULT_METHOD_NAME', 'default');
define('VARIABLE_NAME', 'Path');
define('VIEWS_PATH', DOCUMENT_ROOT.'views');

/*Auth Config*/
define("ROOT_ACCESS", "root");
define("CONCESSIONAIRE_ACCESS", "concessionaire");
define("USER_ACCESS", "user");

