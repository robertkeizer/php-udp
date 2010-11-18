<?php

class Client{

	private $_sock;
	private $_host;
	private $_port;
	
	public function __construct( $host, $port ){
		$this->_host	= $host;
		$this->_port	= $port;
	}

	public function startUp( ){
		if( $this->_sock !== null ){
			throw new Exception( "startUp can only be called once." );
		}
		$this->_sock	= socket_create( AF_INET, SOCK_DGRAM, SOL_UDP );
		socket_bind( $this->_sock, '127.0.0.1' );
		socket_connect( $this->_sock, $this->_host, $this->_port );
	}

	public function send( $msg ){
		socket_write( $this->_sock, $msg );
		return getTimestamp()." Sent message.\n";
	}

	public function showStatus( ){
		if( $this->_sock == null ){
			return getTimestamp()." not connected. Configured for server {$this->_host}:{$this->_port}\n";
		}else{
			return getTimestamp()." connected.\n";
		}
	}

	public function disconnect( ){
		$this->__destruct();
		return getTimestamp()." disconnected.\n";
	}

	public function __destruct( ){
		if( $this->_sock !== null ){
			@socket_close( $this->_sock );
			$this->_sock = null;
		}
	}
}
?>
