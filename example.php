<?php

namespace Supervisord;

use \Supervisord\Connection\Stream;
use \Supervisord\Connection\StreamConnection;
use \Supervisord\Connection\StreamException;

require_once sprintf( '%s/vendor/autoload.php', __DIR__ );

// Connect to server
try {
    $stream = new Stream( '127.0.0.1:9900' );
    $connection = new StreamConnection( $stream );
}

// Connection Error
catch( StreamException $e ) {
    die( "Can't connect to server at 127.0.0.1:9900\n" );
}

try
{
    // Create client
    $client = new Client( $connection );
    
    // Output header
    printf( "Supervisord v%s\n\n", $client->getAPIVersion() );
    
    // Output process info
    printf( "Processes:\n%s\n", print_r( $client->getAllProcessInfo(), true ) );
    
    // Add a group
    $client->addGroup( 'log', 999 );

    // Create a new process
    $client->addProgramToGroup( 'log', 'syslog01', array(
        'command' => 'tail -f /var/log/syslog',
        'autostart' => 'false',
        'autorestart' => 'true',
        'startsecs' => 1,
    ));
    
    // Start the process
    $client->startProcess( 'log:syslog01', 'false' );
    
    // Start the whole group
    $client->startProcessGroup( 'log', 'false' );
    
    // Output single process info
    printf( "Single Process:\n%s\n", print_r( $client->getProcessInfo( 'log:syslog01' ), true ) );
    
    // Output process stdout
    printf( "StdOut:\n%s\n", print_r( $client->tailProcessStdoutLog( 'log:syslog01', 0, 1024 ), true ) );
    
    // Output process stderr
    printf( "StdErr:\n%s\n", print_r( $client->tailProcessStderrLog( 'log:syslog01', 0, 1024 ), true ) );
    
    // Send process stdin
    $client->sendProcessStdin( 'log:syslog01', 'hello world!' );
    
    // Stop the process
    $client->stopProcess( 'log:syslog01', 'false' );
    
    // Stop the whole group
    $client->stopProcessGroup( 'log', 'false' );
    
    // Add a group
    $client->removeProcessGroup( 'log' );
    
    // Reset server
    $client->reloadConfig();
}

catch( \Exception $e )
{
    printf( "Error %s: %s\n", $e->getCode(), $e->getMessage() );
}