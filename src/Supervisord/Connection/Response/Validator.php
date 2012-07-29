<?php

namespace Supervisord\Connection\Response;

use \Supervisord\Connection\ConnectionException;
use \Supervisord\Connection\RpcException;

class Validator
{
    protected $xmlRpc;
    
    public function __construct( XmlRpc $xmlRpc )
    {
        $this->xmlRpc = $xmlRpc;
    }
    
    private function validate()
    {
        $data = $this->xmlRpc->getData();
        
        // Validate Response
        if( is_array( $data ) && isset( $data[ 'faultString' ], $data[ 'faultCode' ] ) )
        {
            throw new RpcException(
                $data[ 'faultString' ],
                $data[ 'faultCode' ],
                new ConnectionException( sprintf( 'Failed to execute command' ) )
            );
        }

        // Handle Empty Response
        else if( null === $data )
        {
            throw new ConnectionException( sprintf( 'Failed to connect to server' ) );
        }
    }
    
    public function getData()
    {
        return $this->xmlRpc->getData();
    }
}