<?php

namespace Supervisord;

use \Supervisord\Connection\Request;

interface Connection
{
    const UNKNOWN_METHOD = 1;
    const INCORRECT_PARAMETERS = 2;
    const SIGNATURE_UNSUPPORTED = 4;
    const SHUTDOWN_STATE = 6;
    const BAD_NAME = 10;
    const NOT_RUNNING = 70;
    const SUPER_READ_NO_FILE = 1000;
    const SUPER_READ_BAD_ARGUMENTS = 1001;
    const SUPER_CLEAR_FAILED = 1010;
    const SUPER_CLEAR_NO_FILE = 1011;
    const START_BAD_NAME = 2002;
    const START_ABNORMAL_TERMINATION = 2003;
    const START_SPAWN_ERROR = 2004;
    const START_ALREADY_STARTED = 2006;
    const STOP_BAD_NAME = 2010;
    const STOP_UNSUCCESSFUL = 2011;
    const STOP_NOT_RUNNING = 2012;
    const INFO_BAD_NAME = 2020;
    const READ_BAD_NAME = 2040;
    const READ_BAD_ARGUMENTS = 2041;
    const READ_NO_FILE = 2042;
    const CLEAR_BAD_NAME = 2050;
    const CLEAR_FAILED = 2051;
    
    public function call( Request\XmlRpc $xmlRpc );
}