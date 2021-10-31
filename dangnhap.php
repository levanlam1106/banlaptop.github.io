<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Đăng nhập</title>
	<link rel="stylesheet" href="css/all.min.css">
	<link rel="stylesheet" href="styleTrangchu.css">
	<style>
		i {
			color: black;
		}
		form > p:first-child {
			left: 50px;
			font-size: 15px;
		}
		.quenDangnhap{
			text-decoration: none;
			padding-right: 45px;
			cursor: pointer;
		}
	</style>
</head>
<?php 
		session_start();
		session_unset();
 ?> 
<body class="dangnhap_trangchu">
	<form action="dangnhap_trangchu.php" method="post">
		<p ><a href="trangchu.php"><i class="fas fa-arrow-left"></i> Quay lại trang chủ</a></p>
		<div class="trai"><i class="fas fa-laptop-code fa-9x"></i>
		</div>
		<div class="form_dangnhap">
			<h2>Login</h2>
			<i class="far fa-envelope"></i><input type="text" name="email" placeholder="Email" required>
			<i class="fas fa-lock"></i><input type="password" name="password" placeholder="Password" required>
			<input class="login" type="submit" name="submit_dangnhap" value="Login">
		</div>
		<a href="doimatkhau.php" class="quenDangnhap">Quên mật khẩu</a>
		<p><a href="dangky.php">Create your acount<i class="fas fa-arrow-right"></i></a></p>
	</form>
</body>
</html>