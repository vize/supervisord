<?php

namespace Supervisord;

use \Supervisord\Connection\Stream;
use \Supervisord\Connection\StreamConnection;
use \Supervisord\Connection\CurlConnection;

class ConnectionTest extends \PHPUnit_Framework_TestCase
{
    private $configFile;
    
    public function setUp()
    {
        $this->configFile = new \SplFileObject( sprintf( '%s/supervisord.conf', dirname( __DIR__ ) ) );
        
        $this->config = new Config;
        $this->config->import( $this->configFile );

        $this->server = new Server\Local( $this->config );
        $this->server->start();
    }
    
    public function tearDown()
    {
        $this->server->stop();
    }
    
    public function testSomething()
    {
        $transport = new Stream( $this->config['inet_http_server']['port'] );
        $connection = new StreamConnection( $transport );
        
        $reflector = new \Supervisord\Reflect\Client( $connection );
        
        echo $reflector->generatePhpClass();
    }
    
    public function testInetConnection_Stream()
    {
        if( !isset( $this->config['inet_http_server'], $this->config['inet_http_server']['port'] ) )
        {
            $this->markTestSkipped( 'Inet Server Not Configured' );
        }
        
        $transport = new Stream(
            $this->config['inet_http_server']['port']
        );
        
        $connection = new StreamConnection( $transport );
        
        $client = new Client( $connection );
        
        $this->assertEquals( '3.0a12', $client->getSupervisorVersion() );
        $this->assertEquals( array(), $client->getAllProcessInfo() );
    }
    
    public function testInetConnection_Curl()
    {
        if( !isset( $this->config['inet_http_server'], $this->config['inet_http_server']['port'] ) )
        {
            $this->markTestSkipped( 'Inet Server Not Configured' );
        }
        
        $connection = new CurlConnection(
            sprintf( 'http://%s/RPC2', $this->config['inet_http_server']['port'] )
        );
        
        $client = new Client( $connection );
        
        $this->assertEquals( '3.0a12', $client->getSupervisorVersion() );
        $this->assertEquals( array(), $client->getAllProcessInfo() );
    }
    
    public function testUnixStreamConnection_Stream()
    {
        if( !isset( $this->config['unix_http_server'], $this->config['unix_http_server']['file'] ) )
        {
            $this->markTestSkipped( 'Unix Server Not Configured' );
        }

        $transport = new Stream(
            sprintf( 'unix://%s', $this->config['unix_http_server']['file'] )
        );
                
        $connection = new StreamConnection( $transport );
        
        $client = new Client( $connection );
        
        $this->assertEquals( '3.0a12', $client->getSupervisorVersion() );
        $this->assertEquals( array(), $client->getAllProcessInfo() );
    }
}