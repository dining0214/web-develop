<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel="stylesheet" href="login.css">
</head>
<body>
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
          $msg = "Login suceesfully.";
        }
        else{
          $msg = "The username or password is incorrect！";
        }

    }
  ?>
  <div class="body"></div>
  <div class="grad"></div>
  <div class="header">
    <div>Grow<span>goro</span></div>
  </div>
  <br>
  <form role="form" method="post" action="">
      <div class="login">
          <input type="text" placeholder="username" id="Username" name="Username" ><br>
          <input type="password" placeholder="password" id="Password" name="Password" ><br>
          <div>
            <button type="submit">Login</button>
          </div>
          <div>
            <input type="button" onclick="location.href='register.php'" value="Register">
          </div>
          <br>
          <div class="showmsg">
            <?php echo $msg ?>  
          </div>
      </div>
  </form>

</body>
</html>