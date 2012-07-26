<?php

namespace Supervisord\Connection;

class SocketConnection extends ConnectionAbstract implements \Supervisord\Connection
{
    public function call( $method, $params = array() )
    {
        $sock = socket_create( AF_UNIX, SOCK_STREAM, 0 );
        
        if( !socket_connect( $sock, $this->dsn, null ) )
        {
            var_dump( $this->dsn );
            throw new Exception( socket_strerror( socket_last_error() ) );
        }
        
        socket_set_nonblock( $sock );
        
        $request = xmlrpc_encode_request( $method, $params ) . "\n\0"; // . "\n\0"
        $length = strlen( $request );

        $sent = socket_write( $sock, $request, $length );
        
        if( $sent === false )
        {
            throw new \Exception( socket_strerror( socket_last_error() ) );
        }
        
        $retval = array();

        while( $buffer = socket_read( $sock, 4096, \PHP_BINARY_READ ) )
        {
            $retval[] = trim( $buffer );
        }

        $this->validateResponse( $retval, $method, $params );

        return $retval;
    }
}