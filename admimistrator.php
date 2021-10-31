<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Admin</title>
	<link rel="stylesheet" href="css/all.min.css">
	<link rel="stylesheet" href="styleAdmin1.css">
</head>
<body>
 
 <?php
 	$errorFile="";
 	$tep="";
 	$chooseApple="";
 	$chooseDell="";
 	$chooseMSI="";
 	$chooseAsus="";
 	$chooseHP="";
 	$chooseAcer="";
 	$chooseLenovo="";
 	$chooseMastel="";
 	$chooseHaier="";
	if(isset($_POST["submit"])){ 
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
		$target_dir = "upload/sanpham/";
		$target_file = $target_dir .$_FILES["hinhAnh"]["name"];
		$uploadOk = 1;
		$tep=$_FILES["hinhAnh"]["name"];
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		// Check if file already exists
		 
		if (file_exists($target_file)) {
		  // echo "Sorry, file already exists.";
		  $uploadOk = 0;
		  $errorFile="file đã tồn tại";
		}
 
		$up_hinhAnh="";
		if($uploadOk==1 && isset($_POST["submit"])) {
		  	move_uploaded_file($_FILES["hinhAnh"]["tmp_name"], $target_file) ;
			$up_hinhAnh=$target_file;
		  }
		if(isset($_POST["submit"]) && $uploadOk==1){
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

			<div>Xin chào: Admin</div>
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
			 <img src="images/bando.jpg" alt="">
			 <div class="content_phai">
			 	<div class="box box1">
			 		<span>Tổng doanh thu</span>
			 		<i class="fas fa-coins fa-3x"></i><?php  
			 			require 'connect.php';
			 			$doanhthu = "SELECT SUM(soLuong*donGia) FROM hoadonban";
			 			$thanhTien = mysqli_fetch_array(mysqli_query($conn, $doanhthu));
			 			mysqli_close($conn);
			 			?>
			 		 <i class="thanhTien"><?php echo number_format($thanhTien[0],0,'.','.')."₫"; ?></i>
			 	</div>
			 	<div class="box box2">
			 		<span>Số lượng mặt hàng</span>
			 		<i class="fas fa-mountain fa-3x"></i><?php  
			 			require 'connect.php';
			 			$SL = "SELECT COUNT(id_SanPham) FROM sanpham";
			 			$soLuongMH =  mysqli_fetch_array(mysqli_query($conn,$SL));
			 			mysqli_close($conn);
			 		?>
			 		<i class="soLuongMH"><?php echo $soLuongMH[0]; ?></i>
			 	</div>
			 	<div class="box box3">
			 		<span>Sản phẩm bán chạy nhất</span>
			 		<i class="fas fa-hands fa-3x"></i><?php  
			 			require 'connect.php';
			 			$BC = "SELECT tenSanPham, MAX(soLuong) FROM hoadonban WHERE soLuong=(SELECT MAX(soLuong) FROM hoadonban)";
			 			$SPBC =  mysqli_fetch_array(mysqli_query($conn,$BC));
			 			mysqli_close($conn);
			 		?>
			 		<i class="SPBC"><?php echo $SPBC[0]."--Số Lượng: ".$SPBC[1]; ?></i>
			 	</div>
			 	<div class="box box4">
			 		<span>Khách hàng mua hàng nhiều nhất</span>
			 		<i class="fas fa-user fa-3x"></i><?php  
			 		require 'connect.php';
			 			$kh = "SELECT
							    donhang.id_TaiKhoan, taikhoan.fullname,
							   COUNT(donhang.id_TaiKhoan) as tk
							FROM
							    donhang,taikhoan
							    WHERE trangThai ='thành công' AND donhang.id_TaiKhoan=taikhoan.id_TaiKhoan
							GROUP BY donhang.id_TaiKhoan
							    HAVING COUNT(donhang.id_TaiKhoan) >= ALL (SELECT MAX(tk) FROM ( SELECT COUNT(donhang.id_TaiKhoan) AS tk FROM donhang,taikhoan  WHERE trangThai ='thành công' AND donhang.id_TaiKhoan=taikhoan.id_TaiKhoan GROUP BY donhang.id_TaiKhoan) tmp)";
						$khMN = mysqli_fetch_array(mysqli_query($conn,$kh));

			 		?>
			 		<i class="khMN"><?php echo $khMN[1]; ?></i>
			 	</div>
			 </div>
			 </div>
		
			 
		</div>
</body>
</html>
 