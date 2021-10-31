<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Đổi Mật Khẩu</title>
	<link rel="stylesheet" href="styleTrangchu.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<style>
		form {
			background-color: #fff;
		}

		.form-group label:first-child {
			font-weight: bold;
			color: #34495e;
			margin-top: 20px;
		}
	</style> 

</head>
<?php 
	session_start();
    require 'connect.php';
    $password = (isset($_POST["password"])) ? $_POST["password"] : "";
    $repassword = (isset($_POST["repassword"])) ? $_POST["repassword"] : "";
    $check=false;
    $errorPassword="";
    if ($password == $repassword) {
    	 $check=true;
    }else{
    	$errorPassword="Nhập lại mật khẩu mới";
    }
    if(isset($_POST["submit_DMK"]) && $check==true){
         $update = "UPDATE taikhoan set password='$password' WHERE gmail='".$_SESSION["info"]["gmail"]."'";
        mysqli_query($conn,$update);
        echo '<script>alert("đổi mật khẩu thành công")</script>'; 
        mysqli_close($conn); 
  }
 ?>
<body class="form_dangky">
	<form class="container p-5 mt-5 mb-5 rounded col-5" action="" method="post">
		<h3>Đổi mật khẩu</h3>
  		<div class="form-group">
  			<label for="pass">Mật khẩu mới</label><br>
  			<input type="password" name="password" class="form-control" id="pass" placeholder="" 
  			value="<?php if($check==true)  echo $password; ?>" required>
  			<div id="errorPassword"><?php echo $errorPassword; ?></div>
  		</div>

  		<div class="form-group">
  			<label for="pass">Nhập lại mật khẩu mới</label><br>
  			<input type="password" name="repassword" class="form-control" id="pass" placeholder="" 
  			value="<?php if($check==true) echo $password; ?>" required>
  			<div id="errorPassword"></div>
  		</div>
 
 
  		<button type="submit" class="btn btn-outline-primary px-4 mt-5" name="submit_DMK">Xác nhận</button><br>
  		<div style="text-align: center">
  			<a href="dangnhap.php">Login</a>
  		</div>

	</form>

	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
	
	<script>
		// var errorEmail="<?php echo $checkDinhDangEmail; ?>";
		var errorPassword="<?php echo $checkDinhDangPassword; ?>";
		if(errorEmail == "1" && errorPassword == "1")
		alert("Bạn đã đổi mật khẩu thành công!");
	</script>

</body>
</html>

 