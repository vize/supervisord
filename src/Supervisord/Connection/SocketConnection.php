<?php

namespace Supervisord\Connection;

class SocketConnection implements \Supervisord\Connection
{
    protected $socket;
    
    public function __construct( Socket $socket )
    {
        $this->socket = $socket;
    }
    
    /**
     * Query supervisord
     * 
     * @param Request\XmlRpc $xmlRpc
     * @return \Response\XmlRpc 
     */
    public function call( Request\XmlRpc $xmlRpc )
    {  
        $this->socket->send( new Request\Http( $xmlRpc ) );

        $http = new Response\Http( $this->socket->recv() );
        $response = new Response\XmlRpc( $http->getBody() );

        return $response;
    }
}