<!DOCTYPE html>
<html>
<head>
	<title>123</title>
	<!-- bootstrap CDN -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
</head>
<body>
	<?php 

			//留言處
			if(isset($_POST["Name"]) && isset($_POST["Content"])&&$_POST["Name"]!=""&&$_POST["Content"]!=""){
				$name = $_POST["Name"];
				$content = $_POST["Content"];
				// 取得時間
				date_default_timezone_set('Asia/Taipei');
				$date = date('Y-m-d H:i:s', time());
				require_once("connectBoard.php");
				// 新增進資料庫
				try{
					$sql = "INSERT INTO  `all_messages`  (name,content,time) VALUES ('$name','$content','$date')";
					echo $sql;
					// 執行SQL指令
					$affected_rows = $link->exec($sql);
					/*// 判斷是否新增成功
					 if($affected_rows == 0){
						$info = "新增資料失敗..";
					 }
					 else{
					 	$info = "新增資料成功..";
					 }*/
				}catch(PDOException $e){
					echo "Error!! : " . $e->getMessage();
				}
			}
		
	?>
	<!-- nav-->
	<nav class="navbar navbar-inverse">
	  <div class="container-fluid">
	    <!-- Brand and toggle get grouped for better mobile display -->
	    <div class="navbar-header">
	      	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
	        	<span class="sr-only">Toggle navigation</span>
	        	<span class="icon-bar"></span>
	        	<span class="icon-bar"></span>
	        	<span class="icon-bar"></span>
	      	</button>
	      	<a class="navbar-brand" href="#">首頁</a>
	    </div>

	    <!-- Collect the nav links, forms, and other content for toggling -->
	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	      	<ul class="nav navbar-nav navbar-right">
	        	<button type="button" class="btn btn-default navbar-btn">Login</button>
	      	</ul>
	    </div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>
	<?php 
		require_once("connectBoard.php");
		try{
				$sql2 = "SELECT * FROM `all_messages` LIMIT 5";
				// 執行SQL指令
				$result = $link->query($sql2);
				$datalist = $result->fetchAll();
			}catch(PDOException $e){
				echo "連結失敗: " . $e->getMessage();
			}
	 ?>
	 <div class="col-md-offset-2 col-md-8" >
	    <table class="table table-hover" >
	    	<!-- head -->
	        <thead>
	            <tr>
	                <th class="col-md-3 text-center">
	                    內容
	                </th>
	                <th class="col-md-2 text-center">
	                	留言者
	                </th>
	                <th class="col-md-3 text-center">
	                	發布日期
	                </th>	                
	            </tr>
	        </thead>
	        <!-- body -->
	        <tbody>
	        		<?php foreach($datalist as $datainfo){ ?>
		            <tr>
		            	<!-- 留言者 -->
		                <td class="text-center">
 							<?php echo $datainfo["name"]; ?>
		                </td>
		                <!-- 內容 -->
		                <td class="text-center">
		                	<?php echo $datainfo["content"]; ?>
		                </td >
		                <!-- 發布日期 -->
		                <td class="text-center">
		                	<?php echo $datainfo["time"]; ?>
		                </td>
		            </tr>
		            <?php } ?>
	        </tbody>
	    </table>
	</div>
	<div class="jumbotron">
		<form class="form-horizontal center" role="form"  method="post" action="">
			<div class="form-group">
				<label  class="col-sm-4 control-label">姓名:</label>
			  		<div class="col-sm-4">
			  			<textarea class="form-control" name="Name" rows="2"></textarea>
		    		</div>
			</div>
	  		<div class="form-group">
				<label  class="col-sm-4 control-label">內容:</label>
			  		<div class="col-sm-4">
			  			<textarea class="form-control" name="Content" rows="5"></textarea>
		    		</div>
			</div>
	  		<input type="submit" value="留言!" style="display: block; margin: auto;">
		</form> 
	</div>>
</body>
</html>