<?php

namespace Supervisord;

use \Supervisord\Client;
use \Supervisord\Connection\Stream;
use \Supervisord\Connection\StreamConnection;

require_once sprintf( '%s/vendor/autoload.php', __DIR__ );
 
$connection = new StreamConnection( new Stream( '127.0.0.1:9001' ) );
$reflector  = new Reflection\Client( $connection );

echo $reflector->generatePhpClass();