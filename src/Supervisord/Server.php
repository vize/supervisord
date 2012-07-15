<?php

namespace Supervisord;

use Visor\Cli\Shell;

class Server
{
    private $config, $shell;
    
    public function __construct( Config $config, Shell $shell )
    {
        $this->config = $config;
        $this->shell = $shell;
    }
    
    public function start()
    {
        $this->shell->exec( 'supervisord' );
    }
    
    public function stop()
    {
        $this->shell->exec( sprintf( 'kill -QUIT %s', $this->getPid() ) );
    }
    
    public function clearLogs()
    {
        $this->shell->exec( sprintf( 'kill -USR2 %s', $this->getPid() ) );
    }
    
    public function reload()
    {
        $this->shell->exec( sprintf( 'kill -HUP %s', $this->getPid() ) );
    }
    
    public function restart()
    {
        $this->isRunning() ? $this->reload() : $this->start();
    }
    
    public function isRunning()
    {
        if( isset( $this->config[ 'supervisord' ][ 'pidfile' ] ) )
        {
            if( is_readable( $this->config[ 'supervisord' ][ 'pidfile' ] ) )
            {
                $pid = trim( file_get_contents( $this->config[ 'supervisord' ][ 'pidfile' ] ) );
                
                if( is_numeric( $pid ) && is_dir( sprintf( '/proc/%u', $pid ) ) ) 
                {
                    return (int) $pid;
                }
            }
        }
        
        return false;
    }
    
    public function getPid()
    {
        if( false === ( $pid = $this->isRunning() ) )
        {
            throw new ServerException( 'Could not read PID file, is the server running?' );
        }
        
        return $pid;
    }
}