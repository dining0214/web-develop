<!DOCTYPE html>
<html lang="en">
<head>
  
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <!-- bootstrap CDN -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
  <noscript>
    <link rel="stylesheet" href="css/style.css" />
  </noscript>
  <link rel="stylesheet" href="main.css">

	<title>使用者登入系統</title>
</head>
<body class="loginPage" style="background-color:white;">
  <!-- 會員登入程序 -->
  <?php  
    $msg="";
    session_start();
    if(isset($_POST["Username"]) && isset($_POST["Password"])){
        $username=$_POST["Username"];
        $password=$_POST["Password"];
        require_once("connect_db.php");
        //選取儲存帳號密碼的資料表
        $sql= "SELECT * FROM `users` WHERE `name`= '$username' AND `password` = '".md5($password)."'"; 
        $result = $db->prepare($sql);
        $result->execute(array($username,$password));
        //取得資料結果集合
        $result2 = $result->fetchAll(PDO::FETCH_OBJ);
        //若有資料，即登入成功->進往管理界面；否則就退回主畫面
        if($result2){
          $_SESSION["login_session"]=true;
          $_SESSION["User"]=$username;
          header("location:index.php");
          $msg = "登入成功";
        }
        else{
          $msg = "使用者名稱或密碼錯誤！";
        }

    }
  ?>

  
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

		</div>
  <!-- 登入表單 -->
  <div class="jumbotron">
    <h1 class="Title text-center" style="font-family:Microsoft JhengHei">登入系統</h1>
    <form class="form-horizontal center" role="form"  method="post" action="">
        <div class="form-group">
          <label  class="col-sm-4 control-label" style="font-family:Microsoft JhengHei">使用者名稱</label>
          <div class="col-sm-4">
              <input type="text" class="form-control" style="font-family:Microsoft JhengHei" id="Username" name="Username" placeholder="請輸入使用者名稱">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-4 control-label" style="font-family:Microsoft JhengHei">密碼</label>
          <div class="col-sm-4">
              <input type="password" class="form-control" style="font-family:Microsoft JhengHei" id="Password" name="Password" placeholder="密碼">
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-4 col-sm-10">
              <button type="submit" class="btn btn-success" style="font-family:Microsoft JhengHei">登入</button>
              <input type="button" class="btn btn-warning" style="font-family:Microsoft JhengHei" onclick="location.href='register.php'" value="註冊">
              <br>
              <?php echo $msg; ?>
          </div>
        </div>
    </form>
  </div>
</body>
</html>