<?php

namespace Supervisord\Server;

class ServerExceptionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers \Supervisord\Server\ServerException::__construct
     */
    public function testConstructor()
    {
        $exception = new ServerException( 'test' );
        
        $this->assertTrue( $exception instanceof \RuntimeException );
        
        $this->setExpectedException( 'Supervisord\Server\ServerException' );
        
        throw $exception;
    }
}