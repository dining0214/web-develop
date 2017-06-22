<?php  
	$dsn = "mysql:dbname=db_chatting;host=localhost;port=3306";
	$DBusername = "root";
	$DBpassword = "1234";
	try{
		$db = new PDO($dsn,$DBusername,$DBpassword, array(PDO::ATTR_PERSISTENT => true,PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
		// echo "成功建立伺服器且開啟資料庫";
	}catch(PDOException $e){
		echo "連結失敗: " . $e->getMessage();
	}
	// $db=null;
?>