<?php

namespace Supervisord\Connection\Response;

class Http
{
    protected $http;
    
    public function __construct( $http )
    {
        $this->http = $http;
    }
    
    public function __toString()
    {
        return trim( strstr( $this->http, "\r\n\r\n" ) );
    }
}