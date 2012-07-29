<?php

namespace Supervisord\Connection;

class RpcConnection implements \Supervisord\Connection
{
    protected $socket;
    
    public function __construct( $dsn )
    {
        $this->socket = stream_socket_client( $dsn, $errno, $errstr );
    }
    
    public function __destruct()
    {
        fclose( $this->socket );
    }
    
    public function call( $method, $params = array() )
    {
        // Encode RPC
        $xmlRequest = xmlrpc_encode_request( $method, $params );
        
        // Encode HTTP
        $httpRequest = sprintf( "POST /RPC2 HTTP/1.1\r\nContent-Length: %s\r\n\r\n%s", 
            mb_strlen( $xmlRequest ),
            $xmlRequest
        );
        
        // Read & Write from socket
        fwrite( $this->socket, $httpRequest, mb_strlen( $httpRequest ) );
        $httpResponse = fread( $this->socket, 4096 );
        
        // Decode HTTP
        $xmlResponse = trim( strstr( $httpResponse, "\r\n\r\n" ) );
        
        // Decode RPC
        $rpcResponse = xmlrpc_decode( $xmlResponse );
        
        // Validate Response
        if( is_array( $rpcResponse ) && isset( $rpcResponse[ 'faultString' ], $rpcResponse[ 'faultCode' ] ) )
        {
            throw new RpcException(
                $rpcResponse[ 'faultString' ],
                $rpcResponse[ 'faultCode' ],
                new ConnectionException( sprintf( 'Failed to execute method: %s', $method ) )
            );
        }

        // Handle Empty Response
        else if( null === $rpcResponse )
        {
            throw new ConnectionException( sprintf( 'Failed to connect to server' ) );
        }

        return $rpcResponse;
    }
}