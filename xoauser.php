<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Quản Lý</title>
	<link rel="stylesheet" type="text/css" href="xoauser.css">
</head>
<body>
<th colspan="9"><h1>DANH SÁCH NGƯỜI DÙNG</h1></th>
<form action="xoauser.php" method="post">
<h4><input type="text" placeholder="Nhập để tìm..." name="txtTim"> 
	<input type="submit" value="Tìm" name="Tim"></h4></form>
		
	<table width="1000" border="2" cellpadding="5" align="center">
	<?php
	$btnTim=(isset($_POST["txtTim"]))? $_POST["txtTim"]: "";
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "labtop";
	$id=(isset($_GET['id']))?$_GET['id']:0;

	$conn = new mysqli($servername, $username, $password, $dbname);

	$sql_delete ="";
	if ($id > 0 && $id != "69") {
		$sql_delete = "delete from taikhoan where id_TaiKhoan =".$id;
		$conn->query($sql_delete);
	}else if ($id > 0 && $id == "69"){
		echo '<script>alert("Không thể xóa tài khoản admin")</script>';
	}
	if(isset($_POST["Tim"])){
	$sql = "SELECT * FROM taikhoan WHERE id_TaiKhoan LIKE '%".$btnTim."%' OR gmail LIKE '%".$btnTim."%' 
	OR fullname LIKE '%".$btnTim."%'";
	}else{
		$sql = "SELECT * FROM taikhoan";
	}
	 
	$result = $conn->query($sql);
	echo '<tr>
			<th>ID tài khoản</th>
			<th>Gmail</th>
			<th>Full name</th>
			<th>Ngày sinh</th>
			<th>Địa chỉ</th>
			<th>Password</th>
			<th>Xóa</th>
		';
		if(mysqli_num_rows($result) <= 0){
			echo '<h4>không tìm thấy tài khoản nào với từ khóa ("'.$btnTim.'")';
		}
	    while($row = $result->fetch_assoc()) {
	    	?>
	    	<tr>
	    		<td><?= $row["id_TaiKhoan"] ?></td>
	    		<td><?= $row["gmail"] ?></td>
	    		<td><?= $row["fullname"] ?></td>
	    		<td><?= $row["gender"] ?></td>
	    		<td><?= $row["dateofbirth"] ?></td>
	    		<td><?= $row["address"] ?></td>
	    		<td><?= $row["password"] ?></td>
	    		<td><img width="100px" src="<?= $row["avatar"] ?>" alt=""> </td>
	    		<td>
	    			<a href="xoauser.php?id=<?=  $row["id_TaiKhoan"] ?>" onclick="return confirm('Bạn có muốn xóa?')">Xóa</a></td>
	    	</tr>

	    	<?php
	        
	    }
	$conn->close();
	?>
	
	</table>

</body>
</html>