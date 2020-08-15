<?php

$connect = new mysqli("localhost","root","","db_master_apri");

if($connect){
	echo "Connection Berhasil"; 
}else{
	
	echo "Connection Failed";
	exit();
}