<?php

namespace Supervisord\Connection;

class RpcConnection implements \Supervisord\Connection
{
    protected $dsn;
    
    public function __construct( $dsn )
    {
        $this->dsn = $dsn;
        $this->call( 'supervisor.getSupervisorVersion' ); // Confirm server is active
    }
    
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

    protected function validateResponse( $response, $method, array $params )
    {
        if( null === $response )
        {
            throw new ConnectionException( sprintf( 'Could not connect to server at %s', $this->dsn ) );
        }
        
        else if( is_array( $response ) && isset( $response[ 'faultString' ], $response[ 'faultCode' ] ) )
        {
            throw new RpcException(
                $response[ 'faultString' ],
                $response[ 'faultCode' ],
                new ConnectionException( sprintf( 'Failed to execute method: %s', $method ) )
            );
        }
    }
}