<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Sửa Tài Khoản</title>
	<link rel="stylesheet" href="styleTrangchu.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<style>
		form {
			background-color: #fff;
		}

		#birth {
			border: 1px solid #bdc3c7;
			border-radius: 5px;
			width: 100%;
		}

		textarea {
			resize: none;
			width: 100%;
			min-height: 80px;
			background-color: #fff;
			border: 1px solid #bdc3c7;
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
    $gmail = (isset($_POST["gmail"])) ? $_POST["gmail"] : "";
    $fullname = (isset($_POST["fullname"])) ? $_POST["fullname"] : "";
    $gender = (isset($_POST["gender"])) ? $_POST["gender"] : "";
    $dateofbirth = (isset($_POST["dateofbirth"])) ? $_POST["dateofbirth"] : "";
    $address = (isset($_POST["address"])) ? $_POST["address"] : "";
    $password = (isset($_POST["password"])) ? $_POST["password"] : "";

   if(isset($_POST["submit_Sua"])){
         $update = "UPDATE taikhoan set gmail = '$gmail', fullname = '$fullname', gender='$gender',
        dateofbirth='$dateofbirth', address='$address', password='$password' WHERE id_TaiKhoan="
        .$_SESSION["info"]["id_TaiKhoan"];
        mysqli_query($conn,$update);    
  }

    $data = "SELECT * FROM taikhoan WHERE id_TaiKhoan=".$_SESSION["info"]["id_TaiKhoan"];
    $layData = mysqli_fetch_assoc(mysqli_query($conn, $data));

    $checkedNAM = ($layData["gender"] == "Male")? "checked" : "";
    $checkedNU = ($layData["gender"] == "Female")? "checked" : "";
    mysqli_close($conn);
  
 ?>
<body class="form_dangky">
	<form class="container p-5 mt-5 mb-5 rounded col-5" action="" method="post">
		<h3>Sửa tài khoản</h3>
    <div class="form-group">
      <label for="exampleInputEmail1">Email</label>
      <input type="email" name="gmail" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required value="<?php echo $layData["gmail"]; ?>"> 
    </div>

    <div class="form-group">
      <label for="exampleInputPassword1">Họ tên</label>
      <input type="text" name="fullname" class="form-control" id="exampleInputName1" value="<?php echo $layData["fullname"]; ?>" required>
    </div>


    <div class="form-group mb-2">
      <label for="male" class="mr-5 ">Giới tính</label> <br>	
      <input type="radio" name="gender" id="male" value="Male" <?php echo $checkedNAM; ?>>
      <label for="male" class="mr-5 mb-0">Nam</label> 
      <input type="radio" name="gender" id="female" value="Female" <?php echo $checkedNU; ?>>
      <label for="female">Nữ</label><br>
    </div>


    <div class="form-group">
     <label for="birth">Ngày sinh</label><br>
     <input id="birth" type="date" name="dateofbirth" class="p-1" value="<?php echo $layData["dateofbirth"]; ?>" required>
   </div>


   <div class="form-group">
     <label for="address">Địa chỉ</label><br> 
     <textarea name="address" id="address" class="p-2" placeholder="Nhập địa chỉ..." required>
      <?php echo $layData["address"]; ?></textarea>
   </div>


   <div class="form-group">
     <label for="pass">Password</label><br>
     <input type="password" name="password" class="form-control" id="pass" placeholder="" 
     value="<?php echo $layData["password"]; ?>" required>
   </div>


   <button type="submit" class="btn btn-outline-primary px-4 mt-5" name="submit_Sua">Xác nhận</button><br>
 </form>

 <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
 <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

</body>
</html>