<?php

namespace Supervisord\Connection;

class SocketConnection extends ConnectionAbstract implements \Supervisord\Connection
{
    public function call( $method, $params = array() )
    {
        $socket = stream_socket_client( $this->dsn, $errno, $errstr );
        stream_set_blocking( $socket, 0 );
        
        $message = sprintf( "%s\0", xmlrpc_encode_request( $method, $params ) );
        fwrite( $socket, $message, strlen( $message ) );
        
        $response = fread( $socket, 4096 );
        $xmlResponse = xmlrpc_decode( $response );
        
        fclose( $socket );
        $this->validateResponse( $xmlResponse, $method, $params );

        return $xmlResponse;
    }
}