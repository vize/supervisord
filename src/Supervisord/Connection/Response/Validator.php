<?php

namespace Supervisord\Connection\Response;

use \Supervisord\Connection\SocketException;
use \Supervisord\Connection\RpcException;

class Validator
{
    public function validate( XmlRpc $xmlRpc )
    {
        $data = $xmlRpc->getData();
        
        // Validate Response
        if( is_array( $data ) && isset( $data[ 'faultString' ], $data[ 'faultCode' ] ) )
        {
            throw new RpcException(
                $data[ 'faultString' ],
                $data[ 'faultCode' ],
                new SocketException( sprintf( 'Failed to execute command' ) )
            );
        }

        // Handle Empty Response
        else if( null === $data )
        {
            throw new SocketException( sprintf( 'Failed to connect to server' ) );
        }
    }
}