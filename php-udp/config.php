<?php

function __autoload( $class ){
	if( file_exists( "Class/{$class}.php" ) ){
		include "Class/{$class}.php";
	}
}

function getTimestamp( ){
	return "[ " . date( "F j Y: G:i:s" ) . " ]";
}

?>
