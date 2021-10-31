<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Hiển thị trang chủ</title>
	<link rel="stylesheet" href="hienthi_trangchu11.css">
	<link rel="stylesheet" href="css/all.css">
</head>
<body>
	<?php 
		$tenHang=(isset($_GET["tenHang"]))? $_GET["tenHang"] : "";
		$sapXep=(isset($_POST["sapXep"]))? $_POST["sapXep"] : "";
	 ?>
	<div class="container">
		<div class="header"> <!-- header_navbar -->
				<div class="header_navbar">
					<div class="logo">
						<a href="trangchu.php"><img src="images/logo_transparent.png" alt="day la anh"></a> 
					</div>
					<div class="timkiem">
						<form action="" method="post">
							<input type="text" name="timKiem_trangChu" placeholder="search...">
							<button type="submit" name="submitTimKiem"><i class="fas fa-search"></i></button>
						</form>
					</div>
					<ul class="dangnhap1">
						<li><a href="dangnhap.php"  style="color: black;"><i class="fas fa-sign-in-alt"></i>Đăng nhập</a></li>
						<li><a href="gioHang.php"  style="color: black;"><i class="fas fa-shopping-cart"></i>Giỏ hàng</a></li>
						<li class="dangxuat_"><i class="fas fa-caret-down fa-2x"></i>
							<div class="dangxuat">
								<a href="dangnhap.php">Đăng xuất</a>
								<a href="suataikhoan.php">Sửa tài khoản</a>
							</div>
						</li>
					</ul>
				</div><!-- header_navbar -->
			<div class="navbar"> <!--  navbar -->
				<a href="hienthi_trangchu.php?tenHang=Asus"><img src="images/n-logo-asus.svg" alt=""></a>
				<a href="hienthi_trangchu.php?tenHang=Apple"><img src="images/apple.png" alt=""></a>
				<a href="hienthi_trangchu.php?tenHang=Dell"> <img src="images/dell.png" alt=""></a>
				<a href="hienthi_trangchu.php?tenHang=HP"><img src="images/hp.png" alt=""></a>
				<a href="hienthi_trangchu.php?tenHang=MSI"> <img src="images/msi.png" alt=""></a>
				<a href="hienthi_trangchu.php?tenHang=Lenovo"> <img src="images/lenovo.png" alt=""></a>
				<a href="hienthi_trangchu.php?tenHang=Haier"> <img src="images/haier.png" alt=""></a>
				<a href="hienthi_trangchu.php?tenHang=Acer"> <img src="images/acer.png" alt=""></a>
			</div><!--  navbar -->
		</div>
		<h4></h4>
		<div class="content">	<!--  content -->
			<a href="hienthi_trangchu.php?tenHang=All">Xem tất cả</a>
			<div style="border-bottom: 1px solid #EEE; padding-left: -15px;"></div>
			<div class="sub_content">
				<?php 
						require 'connect.php';
						$luot = 0;
						if($sapXep == "giamdan"){
							$showSanPham='SELECT id, hinhAnh, tenSanpham, gia, manHinh, CPU, Ram, VGA, HDH, nang FROM sanpham WHERE hang="'.$tenHang.'" ORDER BY gia DESC';
						}else if($sapXep == "tangdan"){
							$showSanPham='SELECT id,hinhAnh, tenSanpham, gia, manHinh, CPU, Ram, VGA, HDH, nang FROM sanpham WHERE hang="'.$tenHang.'" ORDER BY gia ASC';
						}
						if($tenHang == "All"){
							$showSanPham='SELECT id, hinhAnh, tenSanpham, gia, manHinh, CPU, Ram, VGA, HDH, nang FROM sanpham ORDER BY gia '.$sortALL;
						}
						if(isset($_POST["submitTimKiem"])){
							$data = isset($_POST["timKiem_trangChu"])? $_POST["timKiem_trangChu"] : "";
							$showSanPham="SELECT * FROM sanpham WHERE tenSanpham LIKE '%".$data."%'
						OR hang LIKE '%".$data."%'"; 
						}
						$result = mysqli_query($conn, $showSanPham);
						if(mysqli_num_rows($result) <= 0){
							echo '<h4 style="padding-left: 15px;">không tìm thấy sản phẩm với từ khóa "'.$data.'"</h4>';
						}else{
							echo '<h4 style="padding-left: 15px;">tìm thấy ("'.mysqli_num_rows($result).'") sản phẩm với từ khóa "'.$data.'"</h4>';
						}
						?>
						<div class="dienthoaibanchay">
						<?php
						while ($row = mysqli_fetch_assoc($result)) {
								
								$luot++;
								 
							?>
								<div class="column column1">
								<a href="hienthi_chiTietSanPham.php?id=<?php echo $row["id_SanPham"]; ?>">
									<img src="<?php echo $row["hinhAnh"]; ?>" alt="day la anh">
								</a>
									<table style="margin-bottom: 25px;">
											<tr>
											<td style="padding-bottom: 10px;height: 3.3em;" colspan="2"><?php echo $row["tenSanpham"]; ?></td>
										</tr>
										<tr>
											<td colspan="2"><?php echo number_format($row["gia"],0,'.','.')."₫"; ?></td>
										</tr>
										<tr><td style="border-bottom: 1px solid grey;opacity: 0.5; position: absolute; width: 20%;"></td></tr>
										<tr>
											<td style="padding-top: 10px;">Màn hình:</td>
											<td class="cot2"><?php echo $row["manHinh"]; ?></td>
										</tr>
										<tr>
											<td>CPU:</td>
											<td class="cot2"><?php echo $row["CPU"]; ?></td>
										</tr>
										<tr>
											<td>Ram:</td>
											<td class="cot2"><?php echo $row["Ram"]; ?></td>
										</tr>
										<tr>
											<td>VGA:</td>
											<td class="cot2"><?php echo $row["VGA"]; ?></td>
										</tr>
										<tr>
											<td>HDH:</td>
											<td class="cot2"><?php echo $row["HDH"]; ?></td>
										</tr>
										<tr>
											<td>Nặng:</td>
											<td class="cot2"><?php echo $row["nang"]." KG"; ?></td>
										</tr>
										 
									</table>
									
								 </div>
								 
								<?php
							}

						?>
							</div>
						<?php
							mysqli_close($conn);
						?>
			</div>
			</div> 	<!--content -->
			<div class="content_footer">  	<!-- content_footer -->
				

			</div> 	<!-- content_footer -->

			<div class="footer" >	<!-- footer -->
		
					<div class="column_footer">
						<ul>
							<li><a style="font-size: 20px;" href="">Thông tin cửa hàng</a></li>
							<li><a href="">Hệ thống 1035 siêu thị (8:00 - 22:00)</a></li>
							<li><a href="">nội quy cửa hàng</a></li>
							<li><a href="">Bán hàng doanh nghiệp</a></li>
							<li><a href="">In hóa đơn điện tử</a></li>
							<li><a href="">Liên hệ góp ý</a></li>
						</ul>
					</div>
					<div class="column_footer">
						<ul>
							<li><a style="font-size: 20px;" href="">Hỗ trợ khách hàng</a></li>
							<li><a href="">Tìm hiểu về mua trả góp</a></li>
							<li><a href="">Giao hàng - lắp đặt</a></li>
							<li><a href="">Vệ sinh máy</a></li>
							<li><a href="">Trung tâm bảo hành</a></li>
						</ul>
					</div>
					<div class="column_footer">
						<table>
							<tr>
								<td><a href="">Tổng đài hỗ trợ</a></td>
							</tr>
							<tr>
								<td><a href="">Mua hàng</a></td>
								<td>000000</td>
							</tr>
							<tr>
								<td><a href="">kỹ thuật</a></td>
								<td>000000</td>
							</tr>
							<tr>
								<td><a href="">Bảo hành</a></td>
								<td>000000</td>
							</tr>
							<tr>
								<td><a href="">khiếu nại</a></td>
								<td>000000</td>
							</tr>
						</table>
					</div>
					<div class="column_footer" style="padding-top: 7px;">
						 <span style="font-size: 20px; padding-top: 7px;">Website tập đoàn</span>
						 <img src="images/logo_transparent.png" alt="">
					</div>
				</div>	<!-- footer -->
			 
	</div>

	<script src="javascript.js"></script>
</body>
</html>

