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
		try {
			$conn = new PDO("mysql:host={$database['servername']};dbname={$database['dbname']}",$database['username'],$database['password'] );
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $conn;
			}
		catch(PDOException $e)
			{
			echo "Connection failed: " . $e->getMessage();
			return null;
			}
		
		// set the PDO error mode to exception
		// $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		// $conn=mysqli_connect($database['servername'],$database['username'],$database['password'],$database['dbname']);
		// mysqli_set_charset($conn,$database['charset']);
		
	}
	
	function disconnectDb($conn){
		$conn=null;
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