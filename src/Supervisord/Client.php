<?php

namespace Supervisord;

use \Supervisord\Connection\Request\XmlRpc;

/**
 * Supervisord Client
 * 
 * @author Auto Generated
 */
class Client
{
    private $conn;
    
    /**
     * Create a new Client 
     * 
     * @param \Supervisord\Connection $connection
     */
    public function __construct( Connection $connection )
    {
        $this->conn = $connection;
    }

    /**
     * supervisor.addProcessGroup
     * 
     * Update the config for a running process from config file.
     * 
     * @param string name         name of process group to add
     * @return boolean result     true if successful
     * 
     */
    public function addProcessGroup( $name )
    {
        return $this->conn->call( new XmlRpc( 'supervisor.addProcessGroup', array( $name ) ) )->getData();
    }

    /**
     * supervisor.clearAllProcessLogs
     * 
     * Clear all process log files
     * 
     * @return boolean result      Always return true
     * 
     */
    public function clearAllProcessLogs()
    {
        return $this->conn->call( new XmlRpc( 'supervisor.clearAllProcessLogs' ) )->getData();
    }

    /**
     * supervisor.clearLog
     * 
     * Clear the main log.
     * 
     * @return boolean result always returns True unless error
     * 
     */
    public function clearLog()
    {
        return $this->conn->call( new XmlRpc( 'supervisor.clearLog' ) )->getData();
    }

    /**
     * supervisor.clearProcessLog
     * 
     * Clear the stdout and stderr logs for the named process and
     * reopen them.
     * 
     * @param string name   The name of the process (or 'group:name')
     * @return boolean result      Always True unless error
     * 
     */
    public function clearProcessLog( $name )
    {
        return $this->conn->call( new XmlRpc( 'supervisor.clearProcessLog', array( $name ) ) )->getData();
    }

    /**
     * supervisor.clearProcessLogs
     * 
     * Clear the stdout and stderr logs for the named process and
     * reopen them.
     * 
     * @param string name   The name of the process (or 'group:name')
     * @return boolean result      Always True unless error
     * 
     */
    public function clearProcessLogs( $name )
    {
        return $this->conn->call( new XmlRpc( 'supervisor.clearProcessLogs', array( $name ) ) )->getData();
    }

    /**
     * supervisor.getAPIVersion
     * 
     * Return the version of the RPC API used by supervisord
     * 
     * @return string version version id
     * 
     */
    public function getAPIVersion()
    {
        return $this->conn->call( new XmlRpc( 'supervisor.getAPIVersion' ) )->getData();
    }

    /**
     * supervisor.getAllConfigInfo
     * 
     * Get info about all availible process configurations. Each record
     * represents a single process (i.e. groups get flattened).
     * 
     * @return array result  An array of process config info records
     * 
     */
    public function getAllConfigInfo()
    {
        return $this->conn->call( new XmlRpc( 'supervisor.getAllConfigInfo' ) )->getData();
    }

    /**
     * supervisor.getAllProcessInfo
     * 
     * Get info about all processes
     * 
     * @return array result  An array of process status results
     * 
     */
    public function getAllProcessInfo()
    {
        return $this->conn->call( new XmlRpc( 'supervisor.getAllProcessInfo' ) )->getData();
    }

    /**
     * supervisor.getIdentification
     * 
     * Return identifiying string of supervisord
     * 
     * @return string identifier identifying string
     * 
     */
    public function getIdentification()
    {
        return $this->conn->call( new XmlRpc( 'supervisor.getIdentification' ) )->getData();
    }

    /**
     * supervisor.getPID
     * 
     * Return the PID of supervisord
     * 
     * @return int PID
     * 
     */
    public function getPID()
    {
        return $this->conn->call( new XmlRpc( 'supervisor.getPID' ) )->getData();
    }

    /**
     * supervisor.getProcessInfo
     * 
     * Get info about a process named name
     * 
     * @param string name The name of the process (or 'group:name')
     * @return array result     A structure containing data about the process
     * 
     */
    public function getProcessInfo( $name )
    {
        return $this->conn->call( new XmlRpc( 'supervisor.getProcessInfo', array( $name ) ) )->getData();
    }

    /**
     * supervisor.getState
     * 
     * Return current state of supervisord as a struct
     * 
     * @return array A struct with keys string statecode, int statename
     * 
     */
    public function getState()
    {
        return $this->conn->call( new XmlRpc( 'supervisor.getState' ) )->getData();
    }

    /**
     * supervisor.getSupervisorVersion
     * 
     * Return the version of the supervisor package in use by supervisord
     * 
     * @return string version version id
     * 
     */
    public function getSupervisorVersion()
    {
        return $this->conn->call( new XmlRpc( 'supervisor.getSupervisorVersion' ) )->getData();
    }

    /**
     * supervisor.getVersion
     * 
     * Return the version of the RPC API used by supervisord
     * 
     * @return string version version id
     * 
     */
    public function getVersion()
    {
        return $this->conn->call( new XmlRpc( 'supervisor.getVersion' ) )->getData();
    }

    /**
     * supervisor.readLog
     * 
     * Read length bytes from the main log starting at offset
     * 
     * @param int offset         offset to start reading from.
     * @param int length         number of bytes to read from the log.
     * @return string result     Bytes of log
     * 
     */
    public function readLog( $offset, $length )
    {
        return $this->conn->call( new XmlRpc( 'supervisor.readLog', array( $offset, $length ) ) )->getData();
    }

    /**
     * supervisor.readMainLog
     * 
     * Read length bytes from the main log starting at offset
     * 
     * @param int offset         offset to start reading from.
     * @param int length         number of bytes to read from the log.
     * @return string result     Bytes of log
     * 
     */
    public function readMainLog( $offset, $length )
    {
        return $this->conn->call( new XmlRpc( 'supervisor.readMainLog', array( $offset, $length ) ) )->getData();
    }

    /**
     * supervisor.readProcessLog
     * 
     * Read length bytes from name's stdout log starting at offset
     * 
     * @param string name        the name of the process (or 'group:name')
     * @param int offset         offset to start reading from.
     * @param int length         number of bytes to read from the log.
     * @return string result     Bytes of log
     * 
     */
    public function readProcessLog( $name, $offset, $length )
    {
        return $this->conn->call( new XmlRpc( 'supervisor.readProcessLog', array( $name, $offset, $length ) ) )->getData();
    }

    /**
     * supervisor.readProcessStderrLog
     * 
     * Read length bytes from name's stderr log starting at offset
     * 
     * @param string name        the name of the process (or 'group:name')
     * @param int offset         offset to start reading from.
     * @param int length         number of bytes to read from the log.
     * @return string result     Bytes of log
     * 
     */
    public function readProcessStderrLog( $name, $offset, $length )
    {
        return $this->conn->call( new XmlRpc( 'supervisor.readProcessStderrLog', array( $name, $offset, $length ) ) )->getData();
    }

    /**
     * supervisor.readProcessStdoutLog
     * 
     * Read length bytes from name's stdout log starting at offset
     * 
     * @param string name        the name of the process (or 'group:name')
     * @param int offset         offset to start reading from.
     * @param int length         number of bytes to read from the log.
     * @return string result     Bytes of log
     * 
     */
    public function readProcessStdoutLog( $name, $offset, $length )
    {
        return $this->conn->call( new XmlRpc( 'supervisor.readProcessStdoutLog', array( $name, $offset, $length ) ) )->getData();
    }

    /**
     * supervisor.reloadConfig
     * 
     * 
     * Reload configuration
     * 
     * @return boolean result  always return True unless error
     * 
     */
    public function reloadConfig()
    {
        return $this->conn->call( new XmlRpc( 'supervisor.reloadConfig' ) )->getData();
    }

    /**
     * supervisor.removeProcessGroup
     * 
     * Remove a stopped process from the active configuration.
     * 
     * @param string name         name of process group to remove
     * @return boolean result     Indicates wether the removal was successful
     * 
     */
    public function removeProcessGroup( $name )
    {
        return $this->conn->call( new XmlRpc( 'supervisor.removeProcessGroup', array( $name ) ) )->getData();
    }

    /**
     * supervisor.restart
     * 
     * Restart the supervisor process
     * 
     * @return boolean result  always return True unless error
     * 
     */
    public function restart()
    {
        return $this->conn->call( new XmlRpc( 'supervisor.restart' ) )->getData();
    }

    /**
     * supervisor.sendProcessStdin
     * 
     * Send a string of chars to the stdin of the process name.
     * If non-7-bit data is sent (unicode), it is encoded to utf-8
     * before being sent to the process' stdin.  If chars is not a
     * string or is not unicode, raise INCORRECT_PARAMETERS.  If the
     * process is not running, raise NOT_RUNNING.  If the process'
     * stdin cannot accept input (e.g. it was closed by the child
     * process), raise NO_FILE.
     * 
     * @param string name        The process name to send to (or 'group:name')
     * @param string chars       The character data to send to the process
     * @return boolean result    Always return True unless error
     * 
     */
    public function sendProcessStdin( $name, $chars )
    {
        return $this->conn->call( new XmlRpc( 'supervisor.sendProcessStdin', array( $name, $chars ) ) )->getData();
    }

    /**
     * supervisor.sendRemoteCommEvent
     * 
     * Send an event that will be received by event listener
     * subprocesses subscribing to the RemoteCommunicationEvent.
     * 
     * @param  string  type  String for the "type" key in the event header
     * @param  string  data  Data for the event body
     * @return boolean       Always return True unless error
     * 
     */
    public function sendRemoteCommEvent( $type, $data )
    {
        return $this->conn->call( new XmlRpc( 'supervisor.sendRemoteCommEvent', array( $type, $data ) ) )->getData();
    }

    /**
     * supervisor.shutdown
     * 
     * Shut down the supervisor process
     * 
     * @return boolean result always returns True unless error
     * 
     */
    public function shutdown()
    {
        return $this->conn->call( new XmlRpc( 'supervisor.shutdown' ) )->getData();
    }

    /**
     * supervisor.startAllProcesses
     * 
     * Start all processes listed in the configuration file
     * 
     * @param boolean wait Wait for each process to be fully started
     * @return array result     A structure containing start statuses
     * 
     */
    public function startAllProcesses( $wait )
    {
        return $this->conn->call( new XmlRpc( 'supervisor.startAllProcesses', array( $wait ) ) )->getData();
    }

    /**
     * supervisor.startProcess
     * 
     * Start a process
     * 
     * @param string name Process name (or 'group:name', or 'group:*')
     * @param boolean wait Wait for process to be fully started
     * @return boolean result     Always true unless error
     * 
     * 
     */
    public function startProcess( $name, $wait )
    {
        return $this->conn->call( new XmlRpc( 'supervisor.startProcess', array( $name, $wait ) ) )->getData();
    }

    /**
     * supervisor.startProcessGroup
     * 
     * Start all processes in the group named 'name'
     * 
     * @param string name        The group name
     * @param boolean wait       Wait for each process to be fully started
     * @return array result     A structure containing start statuses
     * 
     */
    public function startProcessGroup( $name, $wait )
    {
        return $this->conn->call( new XmlRpc( 'supervisor.startProcessGroup', array( $name, $wait ) ) )->getData();
    }

    /**
     * supervisor.stopAllProcesses
     * 
     * Stop all processes in the process list
     * 
     * @param boolean wait    Wait for each process to be fully stopped
     * @return boolean result Always return true unless error.
     * 
     */
    public function stopAllProcesses( $wait )
    {
        return $this->conn->call( new XmlRpc( 'supervisor.stopAllProcesses', array( $wait ) ) )->getData();
    }

    /**
     * supervisor.stopProcess
     * 
     * Stop a process named by name
     * 
     * @param string name  The name of the process to stop (or 'group:name')
     * @param boolean wait        Wait for the process to be fully stopped
     * @return boolean result     Always return True unless error
     * 
     */
    public function stopProcess( $name, $wait )
    {
        return $this->conn->call( new XmlRpc( 'supervisor.stopProcess', array( $name, $wait ) ) )->getData();
    }

    /**
     * supervisor.stopProcessGroup
     * 
     * Stop all processes in the process group named 'name'
     * 
     * @param string name  The group name
     * @param boolean wait    Wait for each process to be fully stopped
     * @return boolean result Always return true unless error.
     * 
     */
    public function stopProcessGroup( $name, $wait )
    {
        return $this->conn->call( new XmlRpc( 'supervisor.stopProcessGroup', array( $name, $wait ) ) )->getData();
    }

    /**
     * supervisor.tailProcessLog
     * 
     * 
     * Provides a more efficient way to tail the (stdout) log than
     * readProcessStdoutLog().  Use readProcessStdoutLog() to read
     * chunks and tailProcessStdoutLog() to tail.
     * 
     * Requests (length) bytes from the (name)'s log, starting at
     * (offset).  If the total log size is greater than (offset +
     * length), the overflow flag is set and the (offset) is
     * automatically increased to position the buffer at the end of
     * the log.  If less than (length) bytes are available, the
     * maximum number of available bytes will be returned.  (offset)
     * returned is always the last offset in the log +1.
     * 
     * @param string name         the name of the process (or 'group:name')
     * @param int offset          offset to start reading from
     * @param int length          maximum number of bytes to return
     * @return array result       [string bytes, int offset, bool overflow]
     * 
     */
    public function tailProcessLog( $name, $offset, $length )
    {
        return $this->conn->call( new XmlRpc( 'supervisor.tailProcessLog', array( $name, $offset, $length ) ) )->getData();
    }

    /**
     * supervisor.tailProcessStderrLog
     * 
     * 
     * Provides a more efficient way to tail the (stderr) log than
     * readProcessStderrLog().  Use readProcessStderrLog() to read
     * chunks and tailProcessStderrLog() to tail.
     * 
     * Requests (length) bytes from the (name)'s log, starting at
     * (offset).  If the total log size is greater than (offset +
     * length), the overflow flag is set and the (offset) is
     * automatically increased to position the buffer at the end of
     * the log.  If less than (length) bytes are available, the
     * maximum number of available bytes will be returned.  (offset)
     * returned is always the last offset in the log +1.
     * 
     * @param string name         the name of the process (or 'group:name')
     * @param int offset          offset to start reading from
     * @param int length          maximum number of bytes to return
     * @return array result       [string bytes, int offset, bool overflow]
     * 
     */
    public function tailProcessStderrLog( $name, $offset, $length )
    {
        return $this->conn->call( new XmlRpc( 'supervisor.tailProcessStderrLog', array( $name, $offset, $length ) ) )->getData();
    }

    /**
     * supervisor.tailProcessStdoutLog
     * 
     * 
     * Provides a more efficient way to tail the (stdout) log than
     * readProcessStdoutLog().  Use readProcessStdoutLog() to read
     * chunks and tailProcessStdoutLog() to tail.
     * 
     * Requests (length) bytes from the (name)'s log, starting at
     * (offset).  If the total log size is greater than (offset +
     * length), the overflow flag is set and the (offset) is
     * automatically increased to position the buffer at the end of
     * the log.  If less than (length) bytes are available, the
     * maximum number of available bytes will be returned.  (offset)
     * returned is always the last offset in the log +1.
     * 
     * @param string name         the name of the process (or 'group:name')
     * @param int offset          offset to start reading from
     * @param int length          maximum number of bytes to return
     * @return array result       [string bytes, int offset, bool overflow]
     * 
     */
    public function tailProcessStdoutLog( $name, $offset, $length )
    {
        return $this->conn->call( new XmlRpc( 'supervisor.tailProcessStdoutLog', array( $name, $offset, $length ) ) )->getData();
    }

    /**
     * system.listMethods
     * 
     * Return an array listing the available method names
     * 
     * @return array result  An array of method names available (strings).
     * 
     */
    public function listMethods()
    {
        return $this->conn->call( new XmlRpc( 'system.listMethods' ) )->getData();
    }

    /**
     * system.methodHelp
     * 
     * Return a string showing the method's documentation
     * 
     * @param string name   The name of the method.
     * @return string result The documentation for the method name.
     * 
     */
    public function methodHelp( $name )
    {
        return $this->conn->call( new XmlRpc( 'system.methodHelp', array( $name ) ) )->getData();
    }

    /**
     * system.methodSignature
     * 
     * Return an array describing the method signature in the
     * form [rtype, ptype, ptype...] where rtype is the return data type
     * of the method, and ptypes are the parameter data types that the
     * method accepts in method argument order.
     * 
     * @param string name  The name of the method.
     * @return array result  The result.
     * 
     */
    public function methodSignature( $name )
    {
        return $this->conn->call( new XmlRpc( 'system.methodSignature', array( $name ) ) )->getData();
    }

    /**
     * system.multicall
     * 
     * Process an array of calls, and return an array of
     * results. Calls should be structs of the form {'methodName':
     * string, 'params': array}. Each result will either be a
     * single-item array containg the result value, or a struct of
     * the form {'faultCode': int, 'faultString': string}. This is
     * useful when you need to make lots of small calls without lots
     * of round trips.
     * 
     * @param array calls  An array of call requests
     * @return array result  An array of results
     * 
     */
    public function multicall( array $calls )
    {
        return $this->conn->call( new XmlRpc( 'system.multicall', array( $calls ) ) )->getData();
    }

    /**
     * twiddler.addGroup
     * 
     * Add a new process group.
     * 
     * @param string  group_name       Name of group to create
     * @param int     priority         Group start priority
     * @return boolean                 True unless error
     * 
     */
    public function addGroup( $group_name, $priority )
    {
        return $this->conn->call( new XmlRpc( 'twiddler.addGroup', array( $group_name, $priority ) ) )->getData();
    }

    /**
     * twiddler.addProgramToGroup
     * 
     * Add a new program to an existing process group.  Depending on the
     * numprocs option, this will result in one or more processes being
     * added to the group.
     * 
     * @param string  group_name       Name of an existing process group
     * @param string  program_name     Name of the new process in the process table
     * @param array  program_options  Program options, same as in supervisord.conf
     * @return boolean                 Always True unless error
     * 
     */
    public function addProgramToGroup( $group_name, $program_name, array $program_options )
    {
        return $this->conn->call( new XmlRpc( 'twiddler.addProgramToGroup', array( $group_name, $program_name, $program_options ) ) )->getData();
    }

    /**
     * twiddler.getAPIVersion
     * 
     * Return the version of the RPC API used by supervisor_twiddler
     * 
     * @return int version version id
     * 
     */
    public function getTwiddlerAPIVersion()
    {
        return $this->conn->call( new XmlRpc( 'twiddler.getAPIVersion' ) )->getData();
    }

    /**
     * twiddler.getGroupNames
     * 
     * Return an array with the names of the process groups.
     * 
     * @return array                Process group names
     * 
     */
    public function getGroupNames()
    {
        return $this->conn->call( new XmlRpc( 'twiddler.getGroupNames' ) )->getData();
    }

    /**
     * twiddler.log
     * 
     * Write an arbitrary message to the main supervisord log.  This is
     * useful for recording information about your twiddling.
     * 
     * @param  string      message      Message to write to the log
     * @param  string|int  level        Log level name (INFO) or code (20)
     * @return boolean                  Always True unless error
     * 
     */
    public function log( $message, $level )
    {
        return $this->conn->call( new XmlRpc( 'twiddler.log', array( $message, $level ) ) )->getData();
    }

    /**
     * twiddler.removeProcessFromGroup
     * 
     * Remove a process from a process group.  When a program is added with
     * addProgramToGroup(), one or more processes for that program is added
     * to the group.  This method removes individual processes (named by the
     * numprocs and process_name options), not programs.
     * 
     * @param string group_name    Name of an existing process group
     * @param string process_name  Name of the process to remove from group
     * @return boolean             Always return True unless error
     * 
     */
    public function removeProcessFromGroup( $group_name, $process_name )
    {
        return $this->conn->call( new XmlRpc( 'twiddler.removeProcessFromGroup', array( $group_name, $process_name ) ) )->getData();
    }
  
}