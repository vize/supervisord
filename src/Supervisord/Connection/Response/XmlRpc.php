<?php

namespace Supervisord\Connection\Response;

class XmlRpc
{
    protected $http;
    
    public function __construct( Http $http )
    {
        $this->http = $http;
    }
    
    public function getData()
    {
        return xmlrpc_decode( $this->http );
    }
}