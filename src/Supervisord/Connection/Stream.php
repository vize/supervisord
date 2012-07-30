<?php

namespace Supervisord\Connection;

class Stream
{
    protected $sock;
    
    public function __construct( $dsn )
    {
        $this->sock = @stream_socket_client( $dsn, $errno, $errstr );
        
        if( !$this->sock )
        {
            throw new StreamException( $errstr, $errno );
        }
    }
    
    public function __destruct()
    {
        $this->close();
    }
    
    public function send( $message )
    {
        fwrite( $this->sock, $message, mb_strlen( $message ) );
    }
    
    public function recv( $bytes = 4096 )
    {
        return fread( $this->sock, $bytes );
    }
    
    public function close()
    {
        return fclose( $this->sock );
    }
}