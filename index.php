<?php

use Pecee\SimpleRouter\SimpleRouter;

define('ROOT_PATH', __DIR__);
$currentUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";

// Parse the URL to extract the domain name
$parsedUrl = parse_url($currentUrl);
$baseUrl = $parsedUrl['scheme'] . '://' . $parsedUrl['host'] . ':' . $_SERVER['SERVER_PORT'];

// Define the base URL constant
define('BASEURL', $baseUrl);


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
