<?php

namespace Supervisord;

use \Supervisord\Connection\Request\XmlRpc;

/**
 * Supervisord Client
 * 
 * @author Auto Generated
 */
class Client
{
    private $conn;
    
    /**
     * Create a new Client 
     * 
     * @param \Supervisord\Connection $connection
     */
    public function __construct( Connection $connection )
    {
        $this->conn = $connection;
    }
%s  
}