<?php

namespace Supervisord\Connection;

class CurlConnection implements \Supervisord\Connection
{
    private $dsn;
    
    public function __construct( $dsn )
    {
        $this->dsn = $dsn;
    }
    
    public function call( Request\XmlRpc $xmlRpc )
    {
        $curl = curl_init();

        curl_setopt( $curl, \CURLOPT_URL, $this->dsn );
        curl_setopt( $curl, \CURLOPT_POST, 1 );
        curl_setopt( $curl, \CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt( $curl, \CURLOPT_POSTFIELDS, (string) $xmlRpc );
        
        $response = new Response\XmlRpc( curl_exec( $curl ) );
        curl_close( $curl );
        
        $validator = new Response\Validator;
        $validator->validate( $response );

        return $response;
    }
}
