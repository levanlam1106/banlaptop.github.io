<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Trung tâm mua bán Laptop uy tín</title>
	<link rel="stylesheet" href="styleTrangchu.css">
	<link rel="stylesheet" href="css/all.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<div class="container">
		<div class="header"> <!-- header_navbar -->
				<div class="header_navbar">
					<div class="logo">
						<a href=""><img src="images/logo_transparent.png" alt="day la anh"></a> 
					</div>
					<div class="timkiem">
						<form action="timkiem.php" method="post">
							<input type="text" name="timKiem_trangChu" placeholder="Nhập tên sản phẩm, thương hiệu...">
							<button type="submit" name="submitTimKiem"><i class="fas fa-search"></i></button>
						</form>
					</div>
					<ul class="dangnhap1">
						<li><a href="dangnhap.php" style="color: black;"><i class="fas fa-sign-in-alt"></i><p>Đăng nhập</p></a></li>
						<li><a href="gioHang.php" style="color: black;"><i class="fas fa-shopping-cart"></i><p>Giỏ hàng</p></a></li>
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
			<div class="header_content"> 	<!-- header_content -->
				<div class="slideshow">
					<div class="slide fade">
						<a href=""><img src="images/asus.jpg" alt="đây là ảnh"></a>
					</div>
					<div class="slide fade">
						<a href=""><img src="images/ckeditor_1842302.jpg" alt="đây là ảnh"></a>
					</div>
					<div class="slide fade">
						<a href=""><img src="images/hp.jpg" alt="đây là ảnh"></a>
					</div>
					<div class="slide fade">
						<a href=""><img src="images/images.jpg" alt="đây là ảnh"></a>
					</div>
					<div class="slide fade">
						<a href=""><img src="images/macbook.jpg" alt="đây là ảnh"></a>
					</div>
				<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
		  		<a class="next" onclick="plusSlides(1)">&#10095;</a>
		  			<br>
						<div class="phude" style="text-align:center">
						  <a class="dot" onclick="currentSlide(1)">Mua online tiết kiệm 500 nghìn</a>
						  <a class="dot" onclick="currentSlide(2)">Trả góp 0%</a>
						  <a class="dot" onclick="currentSlide(3)">Mua HP 15s tiết kiệm 2 tr</a>
						  <a class="dot" onclick="currentSlide(4)">Tặng Chuột không dây Zadez M390</a>
						  <a class="dot" onclick="currentSlide(5)">Tặng PMH 600,000đ mua Microsoft 365 Personal</a>
						</div>
				</div>

				<div class="header_content_phai">
					<div class="anh_phai">
						<img src="images/mieng-dan.png" alt="">
						<br>
						<img src="images/anhphai.jpg" alt="">
						<div>
							<h4><a href="">Tin Công Nghệ</a></h4>
							<a href="">
								<img src="images/tincongnghe.jpg" alt="">
						 		<span>Cách tải nhanh video Facebook, Tiktok không cần phần mềm</span>
						 	</a>
						</div>
					</div>
				</div>
			</div> 	<!-- header_content -->
			<br>
			<div class="sub_content">	
				<br><!-- sub_content -->
				<div style="font-size: 25px; padding-left: 10px;">LAPTOP mới nhất</div>
				<?php 
						require 'connect.php';
						$luot = 0;
						$showSanPham="SELECT id_SanPham, hinhAnh, tenSanPham, gia, manHinh, CPU, Ram, VGA, HDH, nang FROM sanpham ORDER BY id_SanPham DESC";
						$result = mysqli_query($conn, $showSanPham);
						?>
						<div class="dienthoaibanchay">
						<?php
						while (($row = mysqli_fetch_assoc($result)) && $luot <= 2) {
								
								$luot++;
								 
							?>
								<div class="column column1">
								<a href="hienthi_chiTietSanPham.php?id=<?php echo $row["id_SanPham"]; ?>">
									<img src="<?php echo $row["hinhAnh"]; ?>" alt="day la anh">
								</a>
									<table>
										<tr>
											<td style="padding: 10px; height: 3.3em;" colspan="2"><?php echo $row["tenSanPham"]; ?></td>
										</tr>
										<tr>
											<td colspan="2"><?php echo number_format($row["gia"],0,'.','.')."₫"; ?></td>
										</tr>
										<tr><td style="border-bottom: 1px solid grey; opacity: 0.5; position: absolute; width: 25%;"></td></tr>
										<tr>
											<td style="padding: 10px;">Màn hình:</td>
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
								 if($luot <=2){
								 	$left=365;
								 	if($luot == 2){
								 		$left=365*$luot+35;
								 	}
								 ?>
								<div style="border-right: 15px solid #EEE; position: absolute; height: 500.950px; left: <?php echo $left."px"; ?>; "></div>
								<?php
							}
							?>
							<?php
						}
						?>
							</div>
						<?php
							mysqli_close($conn);
						?>
				<div style="border-bottom: 15px solid #EEE; position: absolute; width: 100%;"></div>
				<div style="font-size: 25px; padding-left: 10px; padding-top: 35px;">Các sản phẩm khác</div>
				<!-- <div style="border-bottom: 1px solid grey;opacity: 0.3; position: absolute; width: 100%;"></div> -->
				<!-- <div style="font-size: 25px; padding-left: 10px; padding-top: 35px;">Các sản phẩm khác</div> -->
				<?php 
						require 'connect.php';
						$luot = 0;
						$showSanPham="SELECT id_SanPham, hinhAnh, tenSanPham, gia, manHinh, CPU, Ram, VGA, HDH, nang FROM sanpham";
						$result = mysqli_query($conn, $showSanPham);
						?>
						<div class="dienthoaibanchay">
						<?php
						while (($row = mysqli_fetch_assoc($result)) && $luot <= 8) {
								
								$luot++;
								 
							?>
								<div class="column column1">
								<a href="hienthi_chiTietSanPham.php?id=<?php echo $row["id_SanPham"]; ?>">
									<img src="<?php echo $row["hinhAnh"]; ?>" alt="day la anh">
								</a>
									<table>
											<tr>
											<td style="padding-bottom: 10px;height: 3.3em;" colspan="2"><?php echo $row["tenSanPham"]; ?></td>
										</tr>
										<tr>
											<td colspan="2"><?php echo number_format($row["gia"],0,'.','.')."₫"; ?></td>
										</tr>
										<tr><td style="border-bottom: 1px solid grey; opacity: 0.5; position: absolute; width: 25%;"></td></tr>
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
									<div style="border-bottom: 15px solid #EEE; position: absolute; width: 33.333%; padding-top: 14.5px;"></div>
								</div>
								<?php
								if($luot <= 2){
								$chieuCao=420.950*3+50;
								$left=365;
								if($luot ==2){
								 	$left=365*2+35;	
								}
								 
								?>
								<div style="border-right: 15px solid #EEE; position: absolute; height:calc(100px + <?php echo $chieuCao."px"; ?>); left: <?php echo $left."px"; ?>; "></div>
								<?php
							}
							?>
							<?php

						}
						?>
							</div>
						<?php
							mysqli_close($conn);
						?>
			</div>	<!-- sub_content -->
			<div class="content_footer">  	<!-- content_footer -->
				

			</div> 	<!-- content_footer -->

		</div>
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
								<td>113</td>
							</tr>
							<tr>
								<td><a href="">kỹ thuật</a></td>
								<td>114</td>
							</tr>
							<tr>
								<td><a href="">Bảo hành</a></td>
								<td>115</td>
							</tr>

						</table>
					</div>
					<div class="column_footer" style="padding-top: 7px;">
						 <span style="font-size: 20px; padding-top: 7px;">Website tập đoàn</span>
						 <img src="images/logo_transparent.png" alt="">
					</div>
				</div>	<!-- footer -->
			 
	</div>
 
	<script src="111.js">
		document.write("hello javascript!");
	</script>
</body>
</html>