<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Register</title>
	<link rel="stylesheet" href="register.css">
</head>
<body>
	<!-- 會員註冊程序 -->
	<?php
		$username="";
		$password="";
		$msg="";
		$showBack=false;
		//取得表單
		if(isset($_POST["Username"]) && isset($_POST["Password"])){
			$username = $_POST["Username"];
			$password = $_POST["Password"];
			require_once("connect_db.php");
			$sql= "SELECT * FROM `users` WHERE `name` = '$username'";
			$result = $db->prepare($sql);
			$result->execute();
			$count = $result->fetchColumn();
			//檢查是否有相同使用者名稱之會員
			if($count>0){
				$msg = "This username already exists.";
			}
			else{
				$msg = "User registration is successful.";
				// 新增進資料庫
				try{
					$sql2 = "INSERT INTO  `users` "."(name,password)"."VALUES ('$username','".md5($password)."')";
					// 執行SQL指令
					$affected_rows = $db->exec($sql2);
					// 判斷是否新增成功
					// if($affected_rows == 0){
					// 	$info = "新增資料失敗..";
					// }
					// else{
					// 	$info = "新增資料成功..";
					// }
				}catch(PDOException $e){
					echo "連結失敗: " . $e->getMessage();
				}
			}
		}

	?>

	
	<div class="body"></div>
	<div class="grad"></div>
	<div class="header">
		<div>Grow<span>goro</span></div>
	</div>
	<br>
	<form role="form"  method="post" action="">
		<div class="register">
			<input type="text" placeholder="Enter your username" id="Username" name = "Username" ><br>
			<input type="password" placeholder="Enter your password" id="Password" name = "Password" ><br>
			<div>
				<button type="submit">Confirm</button>
			</div>
			<div>
				<input type="button" onclick="location.href='login.php'" value="Back">
			</div>
			<br>
          	<div class="showmsg">
            	<?php echo $msg ?>  
          	</div>	
		</div>
	</form>
	
	
</body>
</html>