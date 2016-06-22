<?php
	/*--------------Database--------------*/
	function connectDb(){
		$database = array(
			'servername' => "localhost",
			'username' => "root",
			'password' => "",
			'dbname' => "fitness",
			'charset' => "utf8"
		);
		$conn=mysqli_connect($database['servername'],$database['username'],$database['password'],$database['dbname']);
		mysqli_set_charset($conn,$database['charset']);
		return $conn;
	}
	function disconnectDb($conn){
		mysqli_close($conn);
	}
	/*----------------------------*/
	$home="http://".$_SERVER['SERVER_NAME']."/"; 
	function baseurl() 
	{
		$currentPath = $_SERVER['PHP_SELF']; 
		$pathInfo = pathinfo($currentPath); 
		$hostName = $_SERVER['HTTP_HOST']; 
		$protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https://'?'https://':'http://';
		return $protocol.$hostName.$pathInfo['dirname']."/";
	}
?>