<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Admin</title>
	<link rel="stylesheet" href="css/all.min.css">
	<link rel="stylesheet" href="stylehienthiAdmin11.css">
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
	// $hinhAnh = (isset($_POST["hinhAnh"]))? $_POST["hinhAnh"] : "";
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
	$hinhAnh = (isset($_POST["hinhAnh"]))? $_POST["hinhAnh"] : "";
	$chooseApple = ($Hang == "Apple")? "selected" : "";
	$chooseDell = ($Hang == "Dell")? "selected" : "";
	$chooseMSI = ($Hang == "MSI")? "selected" : "";
	$chooseAsus = ($Hang == "Asus")? "selected" : "";
	$chooseHP = ($Hang == "HP")? "selected" : "";
	$chooseAcer = ($Hang == "Acer")? "selected" : "";
	$chooseLenovo = ($Hang == "Lenovo")? "selected" : "";
	$chooseMastel = ($Hang == "Masstel")? "selected" : "";
	$chooseHaier = ($Hang == "Haier")? "selected" : "";

	// upload file
		if(isset($_POST["submitThem"])){
		$target_dir = "upload/sanpham/";
		$target_file = $target_dir .$_FILES["hinhAnh"]["name"];
		$uploadOk = 1;
		//$tep=$_FILES["hinhAnh"]["name"];
		//$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		// Check if file already exists
		 
		if (file_exists($target_file)) {
		  // echo "Sorry, file already exists.";
		  $uploadOk = 0;
		  $errorFile="file đã tồn tại";
		}
 
		$up_hinhAnh="";
		if($uploadOk==1 && isset($_POST["submitThem"])) {
		  	move_uploaded_file($_FILES["hinhAnh"]["tmp_name"], $target_file) ;
			$up_hinhAnh=$target_file;
		  }
		if(isset($_POST["submitThem"]) && $uploadOk==1){
			$mysql="INSERT INTO sanpham(hinhAnh, hang, tenSanPham, gia, manHinh, 
					CPU, Ram, VGA, HDH, nang, namSanXuat)
					VALUES('$up_hinhAnh', '$Hang', '$tenSanPham', '$Gia', 
					'$manHinh', '$CPU', '$RAM', '$VGA', '$HDH', '$Nang', '$namSanXuat')";
			mysqli_query($conn,$mysql);
		} 
	mysqli_close($conn);
}
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
			 	<div class="header">
			 		<a href="hienthiAdmin.php?tenHang=All">Xem tất cả</a>
			 		<form action="" class="form_hang" method="post" name="frm_hang">
			 			<select name="hang" id="" onChange="frm_hang.submit();">
			 				<option value="Apple" <?php echo $chooseApple; ?>>Apple</option>
		  						<option value="Dell" <?php echo $chooseDell; ?>>Dell</option>
		  						<option value="MSI" <?php echo $chooseMSI; ?>>MSI</option>
		  						<option value="Asus"<?php echo $chooseAsus; ?>>Asus</option>
		  						<option value="HP" <?php  echo $chooseHP; ?>>HP</option>
		  						<option value="Acer" <?php echo $chooseAcer; ?>>Acer</option>
		  						<option value="Lenovo" <?php echo $chooseLenovo; ?>>Lenovo</option>
		  						<option value="Haier" <?php echo $chooseHaier; ?>>Haier</option>
			 			</select>
			 		</form>
			 			<div class="timkiem">
						<form action="" method="post">
							<input type="text" name="timKiem_trangChu" placeholder="Tìm hãng, sản phẩm, đơn hàng...">
							<button type="submit" name="submitTimKiem"><i class="fas fa-search"></i></button>
						</form>
					</div>
					<div class="them"><a href="#" class ="themSanPham" role="button"><i class="fas fa-plus-square"></i>Thêm sản phẩm</a></div>
			 	</div>
			  <div class="addSanPham">
			  	<span class="close">&times;</span>
			  	<form action="" method="post" enctype="multipart/form-data">
			  		<span>Thêm sản phẩm</span>
			  		<hr style="width: 99%; position: absolute; margin-bottom: 20px;">
			  		<table>
			  			<tr style="height: 100px;">
			  				<td class="hinhanh">Hình ảnh:</td>
			  				<td class="hinhanh"><input type="file" name="hinhAnh">
			  					<?php if(isset($_POST['submitThem']) && $uploadOk == 1) echo '<img style="width:80px; height: 80px; position:absolute;" src="'.$up_hinhAnh.'">'; ?>
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
			  						<option value="Apple">Apple</option>
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
			  					value="<?php if(isset($_POST["submitThem"])) echo $tenSanPham; ?>"></td>
			  			</tr>
			  				<tr>
			  				<td colspan="2" class="phancach"><hr style="width: 99%; position: absolute;"></td>
			  			</tr>
			  			<tr>
			  				<td>Giá:</td>
			  				<td class="column2"><input type="text" name="gia" value="<?php if(isset($_POST["submitThem"])) echo number_format($Gia,0,'.','.'); ?>"></td>
			  			</tr>
			  				<tr>
			  				<td colspan="2" class="phancach"><hr style="width: 99%; position: absolute;"></td>
			  			</tr>
			  			<tr>
			  				<td>Màn hình:</td>
			  				<td class="column2"><input type="text" name="manHinh" value="<?php if(isset($_POST["submitThem"])) echo $manHinh; ?>"></td>
			  			</tr>
			  				<tr>
			  				<td colspan="2" class="phancach"><hr style="width: 99%; position: absolute;"></td>
			  			</tr>
			  			<tr>
			  				<td>CPU</td>
			  				<td class="column2"><input type="text" name="cpu" value="<?php if(isset($_POST["submitThem"])) echo $CPU; ?>"></td>
			  			</tr>
			  				<tr>
			  				<td colspan="2" class="phancach"><hr style="width: 99%; position: absolute;"></td>
			  			</tr>
			  			<tr>
			  				<td>Ram:</td>
			  				<td class="column2"><input type="text" name="ram" value="<?php if(isset($_POST["submitThem"])) echo $RAM; ?>"></td>
			  			</tr>
			  				<tr>
			  				<td colspan="2" class="phancach"><hr style="width: 99%; position: absolute;"></td>
			  			</tr>
			  			<tr>
			  				<td>VGA:</td>
			  				<td class="column2"><input type="text" name="vga" value="<?php if(isset($_POST["submitThem"])) echo $VGA; ?>"></td>
			  			</tr>
			  				<tr>
			  				<td colspan="2" class="phancach"><hr style="width: 99%; position: absolute;"></td>
			  			</tr>
			  			<tr>
			  				<td>HĐH</td>
			  				<td class="column2"><input type="text" name="hdh" value="<?php if(isset($_POST["submitThem"])) echo $HDH; ?>"></td>
			  			</tr>
			  				<tr>
			  				<td colspan="2" class="phancach"><hr style="width: 99%; position: absolute;"></td>
			  			</tr>
			  			<tr>
			  				<td>Nặng</td>
			  				<td class="column2"><input type="text" name="nang" value="<?php if(isset($_POST["submitThem"])) echo $Nang; ?>"></td>
			  			</tr>
			  				<tr>
			  				<td colspan="2" class="phancach"><hr style="width: 99%; position: absolute;"></td>
			  			</tr>
			  			<tr>
			  				<td>Năm sản xuất</td>
			  				<td class="column2"><input type="text" name="namSanXuat" value="<?php if(isset($_POST["submitThem"])) echo $namSanXuat; ?>"></td>
			  			</tr>
			  				<tr>
			  				<td colspan="2" class="phancach"><hr style="width: 99%; position: absolute;"></td>
			  			</tr>
			  			<tr>
			  				<td style="padding-bottom: 20px;"><input type="submit" name="submitThem" value="Lưu">
								<input type="reset" name="reset" value="reset">
			  				</td>
			  				 
			  			</tr>
			  		</table>
			  	</form>
			  </div>
			  <!-- xóa sản phẩm -->
			   <?php 
			   		if((isset($_GET["xoaMot"]) || (isset($_POST["delete_nhieu"])) && isset($_POST["choose"]) != "")){
			   				require 'delete.php';
			   		}
			 		 
			  ?>
			

			 <!-- hiển thị san phẩm -->
			<?php 
				// $tenHang = (isset($_GET["tenHang"]))? $_GET["tenHang"] : "";
				$checked="";
				$checked = (isset($_POST["choose1"]))? "checked" : "";
				require 'connect.php';
							 
						if($Hang != ""){
							$showSanPham='SELECT id_SanPham, hinhAnh, tenSanpham, gia, manHinh, CPU, Ram, VGA, HDH, nang, namSanXuat FROM sanpham WHERE hang="'.$Hang.'" ORDER BY gia ASC';
							 
						}else{
							$showSanPham='SELECT id_SanPham, hinhAnh, tenSanpham, gia, manHinh, CPU, Ram, VGA, HDH, nang, namSanXuat FROM sanpham ORDER BY gia ';
						}
						if(isset($_POST["submitTimKiem"])){
							$data = isset($_POST["timKiem_trangChu"])? $_POST["timKiem_trangChu"] : "";
							$showSanPham="SELECT * FROM sanpham WHERE tenSanpham LIKE '%".$data."%'
							OR hang LIKE '%".$data."%'"; 
						}
						$result = mysqli_query($conn, $showSanPham);
						if(isset($_POST["submitTimKiem"])){
						if(mysqli_num_rows($result) <= 0){
							echo '<h4 style="padding-left: 15px;">không tìm thấy sản phẩm với từ khóa "'.$data.'"</h4>';
						}else{
							echo '<h4 style="padding-left: 15px;">tìm thấy ("'.mysqli_num_rows($result).'") sản phẩm với từ khóa "'.$data.'"</h4>';
						}
					}
					mysqli_close($conn);
			 ?>
			 <form method="post" action="" id="frm_hienthi" name="frm_hienthi">
			  <table class="hienthi_sanpham">
			  	<tr>
			  		<th><input type="checkbox" name="choose1" onChange="frm_hienthi.submit();" <?php echo $checked; ?>></th>
			  		<th>ID</th>
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
			  		<th>Tác vụ</th>
			  	</tr>
			  		<?php
			  			while ($row = mysqli_fetch_assoc($result)) {
			  				?>
								<tr>
									 <td class="cot"><input type="checkbox" name="choose[]" value="<?php echo $row["id_SanPham"]; ?>" <?php echo $checked; ?>></td>
									 <td class="cot id_SanPham"><?php echo $row["id_SanPham"]; ?></td>
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
									 <td class="cot">
									 	<a href="suasanpham.php?sua=<?php echo $row["id_SanPham"]; ?>"><i class="fas fa-edit"></i></a>
									 	<a href="hienthiAdmin.php?xoaMot=<?php echo $row["id_SanPham"]; ?>"><i class="fas fa-trash-alt"></i></a>
									 </td>
								</tr>
			  				<?php
			  			}
			  		?>
			  </table>
			  <input class="delete_nhieu" type="submit" name="delete_nhieu" value="DELETE" onclick="return confirm('Bạn có chắc muốn xóa không?');">
			</form>
			 </div>
		</div>
	
	</div>
	<script src="admin1.js">
	</script>
</body>
</html>