<?php

namespace Supervisord\Connection;

class RpcConnection implements \Supervisord\Connection
{
    protected $socket;
    
    public function __construct( Socket $socket )
    {
        $this->socket = $socket;
    }
    
    public function call( Request\XmlRpc $xmlRpc )
    {  
        $this->socket->send( new Request\Http( $xmlRpc ) );
        
        $response = new Response\Validator(
            new Response\XmlRpc(
                new Response\Http(
                    $this->socket->recv()
                )
            )
        );

        return $response->getData();
    }
}