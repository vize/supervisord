<?php

namespace Supervisord\Server;

class ShellExceptionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers \Supervisord\Server\ShellException::__construct
     */
    public function testConstructor()
    {
        $exception = new ShellException( 'test' );
        
        $this->assertTrue( $exception instanceof \RuntimeException );
        
        $this->setExpectedException( 'Supervisord\Server\ShellException' );
        
        throw $exception;
    }
}