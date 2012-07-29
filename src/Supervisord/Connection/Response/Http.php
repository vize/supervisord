<?php

namespace Supervisord\Connection\Response;

class Http
{
    protected $http;
    
    public function __construct( $http )
    {
        $this->http = $http;
    }
    
    public function getBody()
    {
        return trim( strstr( $this->http, "\r\n\r\n" ) );
    }
}