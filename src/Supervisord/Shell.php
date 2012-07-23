<?php

namespace Supervisord;

class Shell
{
    public function exec( $command )
    {
        $exitCode = 0;
        $output = exec( $command . ' 2>&1', $lines, $exitCode );
        
        if( $exitCode > 0 )
        {
            throw new CliException( isset( $lines[ 0 ] ) ? $lines[ 0 ] : $output, $exitCode );
        }
        
        return $output;
    }
}
