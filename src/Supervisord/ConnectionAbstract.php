<?php

namespace Supervisord;

abstract class ConnectionAbstract implements Connection
{
    protected $dsn;
    
    public function __construct( $dsn )
    {
        $this->dsn = $dsn;
        $this->call( 'supervisor.getSupervisorVersion' ); // Confirm server is active
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