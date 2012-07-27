<?php

namespace Supervisord;

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
        if( !isset( $this->config['inet_http_server'], $this->config['inet_http_server']['port'] ) )
        {
            $this->markTestSkipped( 'Inet Server Not Configured' );
        }
        
        $connection = new Connection\InetConnection( sprintf( 'http://%s/RPC2',
            $this->config['inet_http_server']['port'] )
        );
        
        $client = new Client( $connection );
        
        $this->assertEquals( '3.0a12', $client->getSupervisorVersion() );
        $this->assertEquals( array(), $client->getAllProcessInfo() );
    }
    
    public function testSocketConnection()
    {
        if( !isset( $this->config['unix_http_server'], $this->config['unix_http_server']['file'] ) )
        {
            $this->markTestSkipped( 'Unix Server Not Configured' );
        }
        
        $socketPath = $this->config['unix_http_server']['file'];
        $socketPathIsAbsolute = ( '/' == substr( $socketPath, 0, 1 ) );
        
        $connection = new Connection\SocketConnection( sprintf( 'unix://%s',
            $socketPathIsAbsolute
                ? $socketPath
                : sprintf( '%s/%s', $this->configFile->getPath(), $socketPath )
        ));
        
        $client = new Client( $connection );
        
        $this->assertEquals( '3.0a12', $client->getSupervisorVersion() );
        $this->assertEquals( array(), $client->getAllProcessInfo() );
    }
}