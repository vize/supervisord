<?php

namespace Supervisord\Connection;

use \RuntimeException;

class SocketException extends RuntimeException
{
    public function __construct( $message, $code = null, $previous = null )
    {
        $code = socket_last_error();
        $message .= sprintf( ' - %s', socket_strerror( $code ) );
        
        parent::__construct( $message, $code, $previous );
    }
}