<?php

namespace Supervisord\Connection;

class ConnectionExceptionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers \Supervisord\Connection\ConnectionException::__construct
     */
    public function testConstructor()
    {
        $exception = new ConnectionException( 'test' );
        
        $this->assertTrue( $exception instanceof \RuntimeException );
        
        $this->setExpectedException( 'Supervisord\Connection\ConnectionException' );
        
        throw $exception;
    }
}