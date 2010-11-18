<?php

include './config.php';

if( $argc != 3 ){
	die( "Usage: {$argv[0]} host port\n" );
}

$myServer	= new Server( $argv[1], $argv[2] );
echo $myServer->showStatus();
$myServer->startUp();
echo $myServer->showStatus();

while( ( $string = $myServer->listen() ) !== false ){
	echo getTimestamp()." Got string of '{$string}'\n";
};
?>
