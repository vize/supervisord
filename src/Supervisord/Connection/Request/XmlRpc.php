<?php

namespace Supervisord\Connection\Request;

class XmlRpc
{
    protected $method,
              $param = array();
    
    public function __construct( $method, $params = array() )
    {
        $this->method = $method;
        $this->params = $params;
    }
    
    public function __toString()
    {
        return xmlrpc_encode_request( $this->method, $this->params );
    }
}