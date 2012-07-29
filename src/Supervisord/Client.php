<?php

namespace Supervisord;

use \Supervisord\Connection\Request\XmlRpc;

class Client
{
    private $connection;
    
    public function __construct( Connection $connection )
    {
        $this->connection = $connection;
    }
    
    /** API Documentation */
    public function generateDocumentation( $store = array() )
    {
        foreach( $this->listMethods() as $method )
        {
            $store[ $method ] = $this->methodHelp( $method );
        }
        
        return $store;
    }
    
    /** Supervisor */
    public function getSupervisorVersion(){
        return $this->connection->call( new XmlRpc( 'supervisor.getSupervisorVersion' ) );
    }
    
    public function getIdentification(){
        return $this->connection->call( new XmlRpc( 'supervisor.getIdentification' ) );
    }
    public function getState(){
        return $this->connection->call( new XmlRpc( 'supervisor.getState' ) );
    }
    public function getPID(){
        return $this->connection->call( new XmlRpc( 'supervisor.getPID' ) );
    }
    public function readLog( $offset = -1024, $length = 0 ){
        return $this->connection->call( new XmlRpc( 'supervisor.readLog', array( $offset, $length ) ) );
    }
    public function clearLog(){
        return $this->connection->call( new XmlRpc( 'supervisor.clearLog' ) );
    }
    public function shutdown(){
        return $this->connection->call( new XmlRpc( 'supervisor.shutdown' ) );
    }
    public function restart(){
        return $this->connection->call( new XmlRpc( 'supervisor.restart' ) );
    }

    /** Process Control */
    
    /**
     * Get info about a process named name
     * 
     * @param string name The name of the process (or ‘group:name’)
     * @return array result A structure containing data about the process
     */
    public function getProcessInfo( $name ){
        return $this->connection->call( new XmlRpc( 'supervisor.getProcessInfo', array( $name ) ) );
    }
    
    /**
     * Get info about all processes
     * 
     * @return array result An array of process status results
     */
    public function getAllProcessInfo(){
        return $this->connection->call( new XmlRpc( 'supervisor.getAllProcessInfo' ) );
    }
    
    public function startProcess( $name, $wait = true ){
        return $this->connection->call( new XmlRpc( 'supervisor.startProcess', array( $name, $wait ) ) );
    }
    
    public function startAllProcesses( $wait = true ){
        return $this->connection->call( new XmlRpc( 'supervisor.startAllProcesses', array( $wait ) ) );
    }
    
    public function startProcessGroup( $name, $wait = true ){
        return $this->connection->call( new XmlRpc( 'supervisor.startProcessGroup', array( $name, $wait ) ) );
    }
    
    public function stopProcessGroup( $name, $wait = true ){
        return $this->connection->call( new XmlRpc( 'supervisor.stopProcessGroup', array( $name, $wait ) ) );
    }
    
    public function sendProcessStdin( $name, $chars ){
        return $this->connection->call( new XmlRpc( 'supervisor.sendProcessStdin', array( $name, $chars ) ) );
    }
    
    public function sendRemoteCommEvent( $type, $data ){
        return $this->connection->call( new XmlRpc( 'supervisor.sendRemoteCommEvent', array( $type, $data ) ) );
    }
    
    public function addProcessGroup( $name ){
        return $this->connection->call( new XmlRpc( 'supervisor.addProcessGroup', array( $name ) ) );
    }
    
    public function removeProcessGroup( $name ){
        return $this->connection->call( new XmlRpc( 'supervisor.removeProcessGroup', array( $name ) ) );
    }

    /** Process Logging */
    public function readProcessStdoutLog( $name, $offset = 0, $length = 1024 ){
        return $this->connection->call( new XmlRpc( 'supervisor.readProcessStdoutLog', array( $name, $offset, $length ) ) );
    }
    
    public function readProcessStderrLog( $name, $offset = 0, $length = 1024 ){
        return $this->connection->call( new XmlRpc( 'supervisor.readProcessStderrLog', array( $name, $offset, $length ) ) );
    }
    
    public function tailProcessStdoutLog( $name, $offset = 0, $length = 1024 ){
        return $this->connection->call( new XmlRpc( 'supervisor.tailProcessStdoutLog', array( $name, $offset, $length ) ) );
    }
    
    public function tailProcessStderrLog( $name, $offset = 0, $length = 1024 ){
        return $this->connection->call( new XmlRpc( 'supervisor.tailProcessStderrLog', array( $name, $offset, $length ) ) );
    }
    
    public function clearProcessLogs( $name ){
        return $this->connection->call( new XmlRpc( 'supervisor.clearProcessLogs', array( $name ) ) );
    }
    
    public function clearAllProcessLogs(){
        return $this->connection->call( new XmlRpc( 'supervisor.clearAllProcessLogs' ) );
    }
    
    /** System */
    public function listMethods(){
        return $this->connection->call( new XmlRpc( 'system.listMethods' ) );
    }
    
    public function methodHelp( $method ){
        return $this->connection->call( new XmlRpc( 'system.methodHelp', array( $method ) ) );
    }
    
    public function methodSignature( $name ){
        return $this->connection->call( new XmlRpc( 'system.methodSignature', array( $name ) ) );
    }
    
//    public function multicall( $call ){
//        throw new \RuntimeException( 'Multicall feature is not implemented' ) );
//    }
}