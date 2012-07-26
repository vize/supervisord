<?php

namespace Supervisord;

interface Server
{
    public function __construct( Config $config );
    public function start();
    public function stop();
    public function clearLogs();
    public function reload();
    public function restart();
    public function isRunning();
    public function getPid();
}