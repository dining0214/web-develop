<!DOCTYPE HTML>
<html>
<head>
	<title>註冊系統</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<!-- bootstrap CDN -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
	<noscript>
		<link rel="stylesheet" href="css/style.css" />
	</noscript>
	<link rel="stylesheet" href="main.css">


</head>
<body class="registerPage" style="background-color:white;">
	<header id='header'>
      <div class='logo'>
        <img src='http://archive.download.redhat.com/pub/redhat/linux/7.0/en/os/alpha/RedHat/instimage/usr/share/anaconda/pixmaps/first.png' height="65" width="65" class="imgg" />
      </div>

      <div class='center'>
        <h3>
         	<a href="#">Welcome to GROWGORO!</a>
        </h3>	
      </div>
      
    </header>

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
				$msg = "此使用者名稱已存在";
			}
			else{
				$msg = "使用者註冊成功";
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
	
	<!-- 註冊表單 -->
	<div class="jumbotron">
		<h1 class="Title text-center" style="font-family:Microsoft JhengHei">註冊系統</h1>
		<form class="form-horizontal center" role="form"  method="post" action="">
		  <div class="form-group">
		    <label  class="col-sm-4 control-label" style="font-family:Microsoft JhengHei">使用者名稱</label>
		    <div class="col-sm-4">
		      <input type="text" class="form-control" style="font-family:Microsoft JhengHei" id="Username" name = "Username" placeholder="請輸入欲註冊之使用者名稱">
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="col-sm-4 control-label" style="font-family:Microsoft JhengHei">密碼</label>
		    <div class="col-sm-4">
		      <input type="password" class="form-control" style="font-family:Microsoft JhengHei" id="Password" name = "Password" placeholder="請輸入欲註冊之密碼">
		    </div>
		  </div>
		  <div class="form-group">
		    <div class="col-sm-offset-4 col-sm-10">
		      <button type="submit" class="btn btn-success" style="font-family:Microsoft JhengHei">確認</button>
		      <input type="button" class="btn btn-info" style="font-family:Microsoft JhengHei" onclick="location.href='login.php'" value="回登入系統">
		      <br>
		      <?php echo $msg; ?>
		    </div>

		  </div>
		</form>
	</div>
</body>
</html>