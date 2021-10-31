<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Đăng nhập</title>
	<link rel="stylesheet" href="css/all.min.css">
	<link rel="stylesheet" href="styleTrangchu.css">
	<style>
		.quenDangnhap{
			text-decoration: none;
			padding-right: 45px;
			cursor: pointer;
		}
	</style>
</head>
<body class="dangnhap_trangchu">
	<?php 
			session_start();
			$errorEmail="";
			$errorPassword="";
			$checkEmail=true;
			$checkPassword=true;
			// $check_dangnhap=0;
			$email=(isset($_POST['email']))? $_POST['email']: "";
			$password=(isset($_POST['password']))? $_POST['password']: "";
			if(isset($_POST['submit_dangnhap'])){
				require 'connect.php';
				$sql="SELECT id_TaiKhoan, gmail, fullname, password FROM taiKhoan";
				$result=mysqli_query($conn,$sql);
				while ($row=mysqli_fetch_assoc($result)) {
					if(strcasecmp($email, $row['gmail'])!=0){
						$errorEmail="Email không hợp lệ!";
						$checkEmail=false;
						continue;
						 
					}else{
						$checkEmail=true;
						$_SESSION["info"]["gmail"]=$row["gmail"];
						$errorEmail="";
						if(strcasecmp($password, $row['password'])!=0){
						$errorPassword="Password không hợp lệ!";
						$checkPassword=false;
						break;
					}else{
						$checkPassword=true;
						$errorPassword="";
					}	 
				}
				if($checkEmail == true && $checkPassword == true){
					 
					$_SESSION["check"]=true;
					$_SESSION["info"]["id_TaiKhoan"]=$row["id_TaiKhoan"];
					break;
				}
			}
			mysqli_close($conn);
		}
	 ?>
	<form action="" method="post">
		<div class="trai"><i class="fas fa-laptop-code fa-9x"></i></div>
		<div class="form_dangnhap">
			<h2>Login</h2>
			<i class="far fa-envelope"></i><input type="text"  name="email" placeholder="Email" value="<?php if($checkEmail==true){echo $email;} ?>" required><span  class="span2"><?php echo $errorEmail; ?></span>
			<i class="fas fa-lock"></i><input type="text" name="password" placeholder="Password" required><span class="span1"><?php echo $errorPassword; ?></span>
			<input class="login" type="submit" name="submit_dangnhap" value="Login">
		</div>
		<a href="doimatkhau.php" class="quenDangnhap">Quên mật khẩu</a>
		<p><a href="dangky.php">Create your acount<i class="fas fa-arrow-right"></i></a></p>
	</form>
</body>
</html>

<?php
	if($checkEmail == true &&  $checkPassword == true){
		 
		if($email == "admin@gmail.com"){
			header('location:admimistrator.php');
		} else {
			header('location:trangchu.php');
		}
	}
 ?> 