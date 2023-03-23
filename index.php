<?php

use Core\Request;
use Core\Router;

require 'core/bootstrap.php';


Router::load('app/Routes/routes.php')
    ->direct(Request::uri(), Request::method());
