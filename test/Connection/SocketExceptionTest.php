<?php

namespace Supervisord\Connection;

class SocketExceptionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers \Supervisord\Connection\SocketException::__construct
     */
    public function testConstructor()
    {
        $exception = new SocketException( 'test' );
        
        $this->assertTrue( $exception instanceof \RuntimeException );
        
        $this->setExpectedException( 'Supervisord\Connection\SocketException' );
        
        throw $exception;
    }
}