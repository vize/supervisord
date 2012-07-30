<?php

namespace Supervisord\Reflection;

use \Supervisord\Connection;

/**
 * Client class generator
 * 
 * Useful if you would like to regenerate the client for a non-standard supervisord API 
 */
class Client
{
    private $client;
    
    public function __construct( \Supervisord\Client $client )
    {
        $this->client = $client;
    }
    
    public function generatePhpClass()
    {
        $php = '';
        
        foreach( $this->client->listMethods() as $method )
        {
            $docblock = $this->client->methodHelp( $method );
            $docblock = explode( "\n", $docblock );
            $docblock = array_map( 'trim', $docblock );
            $docblock = array_map( function( $a ){ return "     * " . $a; }, $docblock );
            $docblock = implode( "\n", $docblock );
            $docblock = preg_replace( '/(@return|@param) (struct)/', '$1 array', $docblock );

            $php .= sprintf( $this->loadView( 'function' ),
                $method,
                $docblock,
                trim( strstr( $method, '.' ), '.' ),
                $this->parseParams( $docblock, true ),
                sprintf( $this->loadView( 'command' ), $method, $this->parseParams( $docblock ) )
            );
        }
        
        return sprintf( $this->loadView( 'client' ), $php );
    }
    
    private function parseParams( $docblock, $typehint = false, $return = '' )
    {
        if( preg_match_all( "/@param +(?<type>[^ ]+) +(?<name>[^ ]+).*\n/", $docblock, $matches ) )
        {
            $params = array();
            $typehinting = '';

            foreach( $matches[ 'name' ] as $k => $name )
            {
                if( true === $typehint && 'array' === $matches[ 'type' ][ $k ] )
                {
                    $typehinting = 'array ';
                }

                $params[] = sprintf( '%s$%s', $typehinting, $name );
            }

            $return = sprintf( ' %s ', implode( ', ', $params ) );
        }
        
        return $return;
    }
    
    private function loadView( $file )
    {
        return file_get_contents( sprintf( '%s/view/%s.inc', __DIR__, $file ) );
    }
}