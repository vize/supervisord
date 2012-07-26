<?php

namespace Supervisord;

class FunctionalTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->config = new Config;
        $this->config->import( new \SplFileObject( 'supervisord.conf' ) );
        
        $this->server = new Server\Local( $this->config );
        $this->server->start();
        
        sleep( 1 ); // Wait for supervisord to start
        
        //$this->timer = microtime( true );
    }
    
    public function tearDown()
    {
        //printf( 'Total Time: %.2fs', microtime( true ) - $this->timer );
        
        $this->server->stop();
    }
    
    public function testInetConnection()
    {
        $connection = new Connection\InetConnection( 'http://localhost:9001/RPC2' );
        $client = new Client( $connection );
        
        $this->assertEquals( array(), $client->getAllProcessInfo() );
    }
    
    public function testSocketConnection()
    {
        $connection = new Connection\SocketConnection( sprintf( '%s/../tmp/supervisord.sock', __DIR__ ) );
        $client = new Client( $connection );
        
        $this->assertEquals( array(), $client->getAllProcessInfo() );
    }
}