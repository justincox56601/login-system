<?php
/**
 * this file is for generally acessible helper functions
 */

function get_template_part($part){
	if(file_exists(APPROOT . '/template-parts/' . $part . '.php')){
		include_once(APPROOT . '/template-parts/' . $part . '.php');
	} 
 }