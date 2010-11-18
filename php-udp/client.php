<?php

include './config.php';

if( $argc < 4 ){
	die( "Usage: {$argv[0]} [host] [port] [message to send.]\n" );
}

$host	= $argv[1];
$port	= $argv[2];
$msg	= "";

for($x=3;$x<$argc;$x++){
	if($x==$argc-1){
		$msg .= $argv[$x];
	}else{
		$msg .= $argv[$x]." ";
	}
}

try{

	$myClient	= new Client( $host, $port );
	echo $myClient->showStatus();
	$myClient->startUp();
	echo $myClient->showStatus();

	echo $myClient->send( $msg );
	$myClient->disconnect();
	echo $myClient->showStatus();

}catch( Exception $e ){
	die( "Fatal error: {$e->getMessage()}\n" );
}
?>
