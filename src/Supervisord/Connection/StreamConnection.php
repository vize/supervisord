<?php

namespace Supervisord\Connection;

class StreamConnection implements \Supervisord\Connection
{
    protected $stream;
    
    public function __construct( Stream $socket )
    {
        $this->stream = $socket;
    }
    
    /**
     * Query supervisord
     * 
     * @param Request\XmlRpc $xmlRpc
     * @return Response\XmlRpc 
     */
    public function call( Request\XmlRpc $xmlRpc )
    {  
        $this->stream->send( new Request\Http( $xmlRpc ) );

        $http = new Response\Http( $this->stream->recv() );
        $response = new Response\XmlRpc( $http->getBody() );

        return $response;
    }
}