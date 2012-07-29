<?php

namespace Supervisord\Connection\Response;

class XmlRpc
{
    protected $xmlString;
    
    public function __construct( $xmlString )
    {
        $this->xmlString = $xmlString;
    }
    
    public function getData()
    {
        return xmlrpc_decode( $this->xmlString );
    }
}