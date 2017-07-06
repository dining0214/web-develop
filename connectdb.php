<?php 
	$dsn = "mysql:dbname=db_chatting;host=localhost;port=3306";
	$dbusername = "root";
	$dbpassword = "1234";

	try{
		$link = new PDO($dsn, $dbusername, $dbpassword);
		//echo "DB is conneted!";
	}catch(PDOException $e){
		echo "Error!! : ".$e->getMessage();
	}
 ?>