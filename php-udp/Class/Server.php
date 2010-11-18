<?php

class Server{
	
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
		socket_bind( $this->_sock, $this->_host, $this->_port );
	}

	public function listen( ){
		if( $this->_sock == null ){
			$this->startUp();
		}

		return socket_read( $this->_sock, 2048 );
	}

	public function showStatus( ){
		if( $this->_sock !== null ){
			return getTimestamp()." Listening on {$this->_host}:{$this->_port}\n";
		}else{
			return getTimestamp()." Not listening yet. Configured for {$this->_host}:{$this->_port}\n";
		}
	}

	public function __destruct( ){
		socket_close( $this->_socket );
	}
}

?>
