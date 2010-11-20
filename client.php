<?php

include './config.php';

if( $argc < 5 ){
	die( "Usage: {$argv[0]} [fromHost] [toHost] [port] [message to send.]\n" );
}

$fromHost	= $argv[1];
$toHost		= $argv[2];
$port		= $argv[3];

$msg	= "";
for($x=3;$x<$argc;$x++){
	if($x==$argc-1){
		$msg .= $argv[$x];
	}else{
		$msg .= $argv[$x]." ";
	}
}

try{

	$myClient	= new Client( $fromHost, $toHost, $port );
	echo $myClient->showStatus();
	$myClient->startUp();
	echo $myClient->showStatus();

	$myClient->send( $msg );

	$myClient->disconnect();
	echo $myClient->showStatus();

}catch( Exception $e ){
	die( "Fatal error: {$e->getMessage()}\n" );
}
?>
