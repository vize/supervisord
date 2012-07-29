<?php

namespace Supervisord;

use \Supervisord\Connection\Request\XmlRpc;

class Client
{
    private $conn;
    
    public function __construct( Connection $connection )
    {
        $this->conn = $connection;
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
        return $this->conn->call( new XmlRpc( 'supervisor.getSupervisorVersion' ) )->getData();
    }
    
    public function getIdentification(){
        return $this->conn->call( new XmlRpc( 'supervisor.getIdentification' ) )->getData();
    }
    public function getState(){
        return $this->conn->call( new XmlRpc( 'supervisor.getState' ) )->getData();
    }
    public function getPID(){
        return $this->conn->call( new XmlRpc( 'supervisor.getPID' ) )->getData();
    }
    public function readLog( $offset = -1024, $length = 0 ){
        return $this->conn->call( new XmlRpc( 'supervisor.readLog', array( $offset, $length ) ) )->getData();
    }
    public function clearLog(){
        return $this->conn->call( new XmlRpc( 'supervisor.clearLog' ) )->getData();
    }
    public function shutdown(){
        return $this->conn->call( new XmlRpc( 'supervisor.shutdown' ) )->getData();
    }
    public function restart(){
        return $this->conn->call( new XmlRpc( 'supervisor.restart' ) )->getData();
    }

    /** Process Control */
    
    /**
     * Get info about a process named name
     * 
     * @param string name The name of the process (or ‘group:name’)
     * @return array result A structure containing data about the process
     */
    public function getProcessInfo( $name ){
        return $this->conn->call( new XmlRpc( 'supervisor.getProcessInfo', array( $name ) ) )->getData();
    }
    
    /**
     * Get info about all processes
     * 
     * @return array result An array of process status results
     */
    public function getAllProcessInfo(){
        return $this->conn->call( new XmlRpc( 'supervisor.getAllProcessInfo' ) )->getData();
    }
    
    public function startProcess( $name, $wait = true ){
        return $this->conn->call( new XmlRpc( 'supervisor.startProcess', array( $name, $wait ) ) )->getData();
    }
    
    public function startAllProcesses( $wait = true ){
        return $this->conn->call( new XmlRpc( 'supervisor.startAllProcesses', array( $wait ) ) )->getData();
    }
    
    public function startProcessGroup( $name, $wait = true ){
        return $this->conn->call( new XmlRpc( 'supervisor.startProcessGroup', array( $name, $wait ) ) )->getData();
    }
    
    public function stopProcessGroup( $name, $wait = true ){
        return $this->conn->call( new XmlRpc( 'supervisor.stopProcessGroup', array( $name, $wait ) ) )->getData();
    }
    
    public function sendProcessStdin( $name, $chars ){
        return $this->conn->call( new XmlRpc( 'supervisor.sendProcessStdin', array( $name, $chars ) ) )->getData();
    }
    
    public function sendRemoteCommEvent( $type, $data ){
        return $this->conn->call( new XmlRpc( 'supervisor.sendRemoteCommEvent', array( $type, $data ) ) )->getData();
    }
    
    public function addProcessGroup( $name ){
        return $this->conn->call( new XmlRpc( 'supervisor.addProcessGroup', array( $name ) ) )->getData();
    }
    
    public function removeProcessGroup( $name ){
        return $this->conn->call( new XmlRpc( 'supervisor.removeProcessGroup', array( $name ) ) )->getData();
    }

    /** Process Logging */
    public function readProcessStdoutLog( $name, $offset = 0, $length = 1024 ){
        return $this->conn->call( new XmlRpc( 'supervisor.readProcessStdoutLog', array( $name, $offset, $length ) ) )->getData();
    }
    
    public function readProcessStderrLog( $name, $offset = 0, $length = 1024 ){
        return $this->conn->call( new XmlRpc( 'supervisor.readProcessStderrLog', array( $name, $offset, $length ) ) )->getData();
    }
    
    public function tailProcessStdoutLog( $name, $offset = 0, $length = 1024 ){
        return $this->conn->call( new XmlRpc( 'supervisor.tailProcessStdoutLog', array( $name, $offset, $length ) ) )->getData();
    }
    
    public function tailProcessStderrLog( $name, $offset = 0, $length = 1024 ){
        return $this->conn->call( new XmlRpc( 'supervisor.tailProcessStderrLog', array( $name, $offset, $length ) ) )->getData();
    }
    
    public function clearProcessLogs( $name ){
        return $this->conn->call( new XmlRpc( 'supervisor.clearProcessLogs', array( $name ) ) )->getData();
    }
    
    public function clearAllProcessLogs(){
        return $this->conn->call( new XmlRpc( 'supervisor.clearAllProcessLogs' ) )->getData();
    }
    
    /** System */
    public function listMethods(){
        return $this->conn->call( new XmlRpc( 'system.listMethods' ) )->getData();
    }
    
    public function methodHelp( $method ){
        return $this->conn->call( new XmlRpc( 'system.methodHelp', array( $method ) ) )->getData();
    }
    
    public function methodSignature( $name ){
        return $this->conn->call( new XmlRpc( 'system.methodSignature', array( $name ) ) )->getData();
    }
    
//    public function multicall( $call ){
//        throw new \RuntimeException( 'Multicall feature is not implemented' ) )->getData();
//    }
}