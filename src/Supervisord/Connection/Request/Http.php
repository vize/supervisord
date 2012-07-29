<?php

namespace Supervisord\Connection\Request;

class Http
{
    protected $xml;
    
    public function __construct( XmlRpc $xml )
    {
        $this->xml = $xml;
    }
    
    public function __toString()
    {
        return sprintf( "POST /RPC2 HTTP/1.1\r\nContent-Length: %s\r\n\r\n%s", 
            mb_strlen( $this->xml ),
            $this->xml
        );
    }
}