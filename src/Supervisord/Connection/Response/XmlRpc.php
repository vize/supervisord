<?php

namespace Supervisord\Connection\Response;

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
                new SocketException( sprintf( 'Failed to execute command' ) )
            );
        }

        // Handle Empty Response
        else if( null === $response )
        {
            throw new SocketException( sprintf( 'Failed to connect to server' ) );
        }
        
        return $response;
    }
}