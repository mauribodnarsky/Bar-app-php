<?php
 function isAdmin()
 {
	if(isset($_SESSION['identity'])and $_SESSION['identity']->rol=='admin'){
	
	return true;
	}else{
	return false;
	}
}
function isCajero(){
	if(isset($_SESSION['identity'])and $_SESSION['identity']->rol=='cajero'){
	return true;
	}else{
	return false;
	}
}
function isMozo(){
	if(isset($_SESSION['identity'])and $_SESSION['identity']->rol=='mozo'){
	return true;
	}else{
	return false;
	}
}

