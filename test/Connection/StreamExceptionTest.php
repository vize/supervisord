<?php

namespace Supervisord\Connection;

class StreamExceptionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers \Supervisord\Connection\StreamException::__construct
     */
    public function testConstructor()
    {
        $exception = new StreamException( 'test' );
        
        $this->assertTrue( $exception instanceof \RuntimeException );
        
        $this->setExpectedException( 'Supervisord\Connection\StreamException' );
        
        throw $exception;
    }
}