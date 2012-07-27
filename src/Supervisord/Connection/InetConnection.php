<?php

namespace Supervisord\Connection;

class InetConnection extends ConnectionAbstract implements \Supervisord\Connection
{
    public function call( $method, $params = array() )
    {
        $curl = curl_init();

        curl_setopt( $curl, \CURLOPT_URL, $this->dsn );
        curl_setopt( $curl, \CURLOPT_POST, 1 );
        curl_setopt( $curl, \CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt( $curl, \CURLOPT_POSTFIELDS, xmlrpc_encode_request( $method, $params ) );
        
        $response = xmlrpc_decode( curl_exec( $curl ) );
        curl_close( $curl );
        
        $this->validateResponse( $response, $method, $params );

        return $response;
    }
}