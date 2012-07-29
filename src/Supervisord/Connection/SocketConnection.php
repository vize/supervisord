<?php

namespace Supervisord\Connection;

class SocketConnection extends ConnectionAbstract implements \Supervisord\Connection
{
    public function call( $method, $params = array() )
    {
        $socket = stream_socket_client( $this->dsn, $errno, $errstr );
        $xmlRequest = xmlrpc_encode_request( $method, $params );
        
        $httpRequest = sprintf( "POST /RPC2 HTTP/1.1\r\nContent-Length: %s\r\n\r\n%s", 
            mb_strlen( $xmlRequest ),
            $xmlRequest
        );
        
        fwrite( $socket, $httpRequest, mb_strlen( $httpRequest ) );
        
        $httpResponse = fread( $socket, 4096 );
        $xmlResponse = trim( strstr( $httpResponse, "\r\n\r\n" ) );
        $rpcResponse = xmlrpc_decode( $xmlResponse );
        
        fclose( $socket );
        $this->validateResponse( $rpcResponse, $method, $params );

        return $rpcResponse;
    }
}