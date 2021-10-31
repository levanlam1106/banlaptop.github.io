<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="css/all.min.css">
	<link rel="stylesheet" href="suasanpham.css">
</head>
<body>
  <?php
 	$errorFile="";
 	//$tep="";
 	$chooseApple="";
 	$chooseDell="";
 	$chooseMSI="";
 	$chooseAsus="";
 	$chooseHP="";
 	$chooseAcer="";
 	$chooseLenovo="";
 	$chooseMastel="";
 	$chooseHaier="";
	require 'connect.php';
	$sua = (isset($_GET["sua"])) ? $_GET["sua"] : "";
	$showSanPham='SELECT id_SanPham, hinhAnh, hang, tenSanpham, gia, manHinh, CPU, Ram, VGA, HDH, nang, namSanXuat FROM sanpham WHERE id_SanPham='.$sua;
				$result = mysqli_query($conn, $showSanPham);
				$row = mysqli_fetch_assoc($result);
					// sua sản phẩm 
	 
	$hinhAnh = $row["hinhAnh"];
	$Hang = (isset($_POST["hang"]))? $_POST["hang"] : "";
	$tenSanPham = (isset($_POST["tenSanPham"]))? $_POST["tenSanPham"] : "";
	$Gia = (isset($_POST["gia"]))? $_POST["gia"] : "";
	$manHinh = (isset($_POST["manHinh"]))? $_POST["manHinh"] : "";
	$CPU = (isset($_POST["cpu"]))? $_POST["cpu"] : "";
	$RAM = (isset($_POST["ram"]))? $_POST["ram"] : "";
	$VGA = (isset($_POST["vga"]))? $_POST["vga"] : "";
	$HDH = (isset($_POST["hdh"]))? $_POST["hdh"] : "";
	$Nang = (isset($_POST["nang"]))? $_POST["nang"] : "";
	$namSanXuat = (isset($_POST["namSanXuat"]))? $_POST["namSanXuat"] : "";

	// upload file
	if(isset($_POST["submitSua"])){
		$target_dir = "upload/sanpham/";
		$target_file = $target_dir .$_FILES["hinhAnh"]["name"];
		$uploadOk = 1;

		if (file_exists($target_file)) {
		  // echo "Sorry, file already exists.";
		  $uploadOk = 0;
		  $errorFile="file đã tồn tại";
		}

		$up_hinhAnh="";
		if($uploadOk==1 && isset($_POST["submitSua"])) {
		  	move_uploaded_file($_FILES["hinhAnh"]["tmp_name"], $target_file) ;
			$up_hinhAnh=$target_file;
		  }
		if($sua !="" && ($uploadOk == 0 || $_FILES["hinhAnh"]["name"] == "")){
			$mysql="UPDATE sanpham SET hang='$Hang', tenSanPham='$tenSanPham', gia='$Gia', manHinh='$manHinh', 
					CPU='$CPU', Ram='$RAM', VGA='$VGA', HDH='$HDH', nang='$Nang', namSanXuat='$namSanXuat' WHERE id_SanPham=".$sua;
			mysqli_query($conn,$mysql);

			$showSanPham='SELECT id_SanPham, hinhAnh, hang, tenSanpham, gia, manHinh, CPU, Ram, VGA, HDH, nang, namSanXuat FROM sanpham WHERE id_SanPham='.$sua;
				$result = mysqli_query($conn, $showSanPham);
				$row = mysqli_fetch_assoc($result);
		} 
		if($sua !="" && $uploadOk==1 && $_FILES["hinhAnh"]["name"] != ""){
			unlink($hinhAnh);
			$mysql="UPDATE sanpham SET hinhAnh='$up_hinhAnh', hang='$Hang', tenSanPham='$tenSanPham', gia='$Gia', manHinh='$manHinh', 
					CPU='$CPU', Ram='$RAM', VGA='$VGA', HDH='$HDH', nang='$Nang', namSanXuat='$namSanXuat' WHERE id_SanPham=".$sua;
			mysqli_query($conn,$mysql);

			$showSanPham='SELECT id_SanPham, hinhAnh, hang, tenSanpham, gia, manHinh, CPU, Ram, VGA, HDH, nang, namSanXuat FROM sanpham WHERE id_SanPham='.$sua;
				$result = mysqli_query($conn, $showSanPham);
				$row = mysqli_fetch_assoc($result);
		} 

				mysqli_close($conn);
		}

	$chooseApple = ($row["hang"] == "Apple")? "selected" : "";
	$chooseDell = ($row["hang"]  == "Dell")? "selected" : "";
	$chooseMSI = ($row["hang"]  == "MSI")? "selected" : "";
	$chooseAsus = ($row["hang"]  == "Asus")? "selected" : "";
	$chooseHP = ($row["hang"]  == "HP")? "selected" : "";
	$chooseAcer = ($row["hang"]  == "Acer")? "selected" : "";
	$chooseLenovo = ($row["hang"]   == "Lenovo")? "selected" : "";
	$chooseMastel = ($row["hang"]  == "Masstel")? "selected" : "";
	$chooseHaier = ($row["hang"]  == "Haier")? "selected" : "";
 ?>
	<div class="admin">
		<div class="menu">
			<div>
				 <a href=""><i class="fas fa-list-ul"></i>Administrator</a>
			</div>
			<div style="border-right: 1px solid grey; height: 40px"></div>
			<div><a href="trangchu.php"><i class="fas fa-arrow-circle-left"></i>Vào trang website</a></div>
			<div style="border-right: 1px solid grey; height: 40px"></div>

			<div>Xin chào: admin</div>
		</div>
		<div class="content">
			<div class="content_trai">
				<ul>
					<li><a href="admimistrator.php"><i class="fas fa-house-damage"></i>Trang chủ Admin</a></li>
					<li><a href="hienthiAdmin.php"><i class="fas fa-cart-plus"></i>Quản lý sản Phẩm</a></li>
					<li><a href="xuLyGioHang.php"><i class="fab fa-odnoklassniki"></i>Quản lý đơn hàng</a></li>
					<li><a href="xoauser.php"><i class="fas fa-user"></i>Quản lý tài khoản</a></li>
				</ul>
			</div>
			 <div class="content_phai">
			  <div class="addSanPham">
			  	<form action="" method="post" enctype="multipart/form-data">
			  		<span>Sửa sản phẩm</span>
			  		<hr style="width: 99%; position: absolute; margin-bottom: 20px;">
			  		<table>
			  			<tr style="height: 100px;">
			  				<td class="hinhanh">Hình ảnh:</td>
			  				<td class="hinhanh"><input type="file" name="hinhAnh">
			  					<?php echo '<img style="width:80px; height: 80px; position:absolute;" src="'.$row["hinhAnh"].'">'; ?>
								<span><?php echo $errorFile; ?></span>
			  				</td>
			  				 
			  			</tr>
			  			<tr>
			  				<td colspan="2" class="phancach"><hr style="width: 99%; position: absolute;"></td>
			  			</tr>
			  			<tr>
			  				<td>Hãng:</td>
			  				<td class="column2">
			  					<select name="hang" style="padding: 7px 0; border-radius: 5px; width: 100px;">
			  						<option value="Apple" <?php echo $chooseApple; ?>>Apple</option>
			  						<option value="Dell" <?php echo $chooseDell; ?>>Dell</option>
			  						<option value="MSI" <?php echo $chooseMSI; ?>>MSI</option>
			  						<option value="Asus"<?php echo $chooseAsus; ?>>Asus</option>
			  						<option value="HP" <?php  echo $chooseHP; ?>>HP</option>
			  						<option value="Acer" <?php echo $chooseAcer; ?>>Acer</option>
			  						<option value="Lenovo" <?php echo $chooseLenovo; ?>>Lenovo</option>
			  						<option value="Haier" <?php echo $chooseHaier; ?>>Haier</option>
			  					</select>
			  				</td>
			  			</tr>
			  				<tr>
			  				<td colspan="2" class="phancach"><hr style="width: 99%; position: absolute;"></td>
			  			</tr>
			  			<tr>
			  				<td>Tên sản phẩm:</td>
			  				<td class="column2"><input type="text" name="tenSanPham" 
			  					value="<?php echo $row["tenSanpham"]; ?>"></td>
			  			</tr>
			  				<tr>
			  				<td colspan="2" class="phancach"><hr style="width: 99%; position: absolute;"></td>
			  			</tr>
			  			<tr>
			  				<td>Giá:</td>
			  				<td class="column2"><input type="text" name="gia" value="<?php echo $row["gia"]; ?>"></td>
			  			</tr>
			  				<tr>
			  				<td colspan="2" class="phancach"><hr style="width: 99%; position: absolute;"></td>
			  			</tr>
			  			<tr>
			  				<td>Màn hình:</td>
			  				<td class="column2"><input type="text" name="manHinh" value="<?php echo $row["manHinh"]; ?>"></td>
			  			</tr>
			  				<tr>
			  				<td colspan="2" class="phancach"><hr style="width: 99%; position: absolute;"></td>
			  			</tr>
			  			<tr>
			  				<td>CPU</td>
			  				<td class="column2"><input type="text" name="cpu" value="<?php echo $row["CPU"]; ?>"></td>
			  			</tr>
			  				<tr>
			  				<td colspan="2" class="phancach"><hr style="width: 99%; position: absolute;"></td>
			  			</tr>
			  			<tr>
			  				<td>Ram:</td>
			  				<td class="column2"><input type="text" name="ram" value="<?php  echo $row["Ram"]; ?>"></td>
			  			</tr>
			  				<tr>
			  				<td colspan="2" class="phancach"><hr style="width: 99%; position: absolute;"></td>
			  			</tr>
			  			<tr>
			  				<td>VGA:</td>
			  				<td class="column2"><input type="text" name="vga" value="<?php echo $row["VGA"]; ?>"></td>
			  			</tr>
			  				<tr>
			  				<td colspan="2" class="phancach"><hr style="width: 99%; position: absolute;"></td>
			  			</tr>
			  			<tr>
			  				<td>HĐH</td>
			  				<td class="column2"><input type="text" name="hdh" value="<?php  echo $row["HDH"]; ?>"></td>
			  			</tr>
			  				<tr>
			  				<td colspan="2" class="phancach"><hr style="width: 99%; position: absolute;"></td>
			  			</tr>
			  			<tr>
			  				<td>Nặng</td>
			  				<td class="column2"><input type="text" name="nang" value="<?php echo $row["nang"]; ?>"></td>
			  			</tr>
			  				<tr>
			  				<td colspan="2" class="phancach"><hr style="width: 99%; position: absolute;"></td>
			  			</tr>
			  			<tr>
			  				<td>Năm sản xuất</td>
			  				<td class="column2"><input type="text" name="namSanXuat" value="<?php echo $row["namSanXuat"]; ?>"></td>
			  			</tr>
			  				<tr>
			  				<td colspan="2" class="phancach"><hr style="width: 99%; position: absolute;"></td>
			  			</tr>
			  			<tr>
			  				<td style="padding-bottom: 20px;">
			  					<input type="submit" name="submitSua" value="Lưu">
								<input type="reset" name="reset" value="reset">
			  				</td>
			  				 
			  			</tr>
			  		</table>
			  	</form>
			  </div>
			  
			 <!-- hiển thị sản phẩm -->

			 <form method="post" action="" id="frm_hienthi" name="frm_hienthi">
			  <table class="hienthi_sanpham">
			  	<tr>
			  		<th>Mã sản phẩm</th>
			  		<th>Tên sản phẩm</th>
			  		<th>Giá</th>
			  		<th>Màn hình</th>
			  		<th>CPU</th>
			  		<th>RAM</th>
			  		<th>VGA</th>
			  		<th>HDH</th>
			  		<th>Nặng</th>
			  		<th>Năm sản xuất</th>
			  		<th>Hình ảnh</th>
			  	</tr>
				<tr>
					 <td class="cot" style="text-align: center;"><?php echo $row["id_SanPham"]; ?></td>
					 <td class="cot"><?php echo $row["tenSanpham"]; ?></td>
					 <td class="cot"><?php echo $row["gia"]; ?></td>
					 <td class="cot"><?php echo $row["manHinh"]; ?></td>
					 <td class="cot"><?php echo $row["CPU"]; ?></td>
					 <td class="cot"><?php echo $row["Ram"]; ?></td>
					 <td class="cot"><?php echo $row["VGA"]; ?></td>
					 <td class="cot"><?php echo $row["HDH"]; ?></td>
					 <td class="cot"><?php echo $row["nang"]; ?></td>
					 <td class="cot"><?php echo $row["namSanXuat"]; ?></td>
					 <td class="cot"><img src="<?php echo $row["hinhAnh"]; ?>" alt=""></td>
				</tr>
			  </table>
			</form>
			 </div>
		</div>
	
	</div>
	<script src="admin1.js">
	</script>	

</body>
</html>