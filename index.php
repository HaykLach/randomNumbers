<?php

use RandomNumbers\Dispatcher\Dispatcher;

error_reporting(E_ALL);
ini_set('display_errors', 1);


require_once 'vendor/autoload.php';

Dispatcher::dispatch();



