<?php
use Pecee\SimpleRouter\SimpleRouter;

define('VIEWS', __DIR__);


require __DIR__ . '/vendor/autoload.php';

/* Load external routes file */
require_once './routes/route.php';


$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();


/**
 * The default namespace for route-callbacks, so we don't have to specify it each time.
 * Can be overwritten by using the namespace config option on your routes.
 */

SimpleRouter::setDefaultNamespace('App\Controllers');

// Start the routing
SimpleRouter::start();