<?php

namespace Supervisord\Connection;

class RpcExceptionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers \Supervisord\Connection\RpcException::__construct
     */
    public function testConstructor()
    {
        $exception = new RpcException( 'test' );
        
        $this->assertTrue( $exception instanceof \RuntimeException );
        
        $this->setExpectedException( 'Supervisord\Connection\RpcException' );
        
        throw $exception;
    }
}