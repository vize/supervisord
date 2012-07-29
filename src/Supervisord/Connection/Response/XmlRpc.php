<?php

namespace Supervisord\Connection\Response;

use \Supervisord\Connection\StreamException;

class XmlRpc
{
    protected $xmlString;
    
    public function __construct( $xmlString )
    {
        $this->xmlString = $xmlString;
    }
    
    public function getData()
    {
        $response = xmlrpc_decode( $this->xmlString );
        
        // Validate Response
        if( is_array( $response ) && isset( $response[ 'faultString' ], $response[ 'faultCode' ] ) )
        {
            throw new \DomainException(
                $response[ 'faultString' ],
                $response[ 'faultCode' ],
                new StreamException( sprintf( 'Failed to execute command' ) )
            );
        }

        // Handle Empty Response
        else if( null === $response )
        {
            throw new StreamException( sprintf( 'Failed to connect to server' ) );
        }
        
        return $response;
    }
}