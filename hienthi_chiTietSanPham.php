<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Chi tiết sản phẩm</title>
	<link rel="stylesheet" href="hienthi_chiTietSanPham.css">
	<link rel="stylesheet" href="css/all.css">
</head>
<body>
	 <?php 
	 	$takeData=$_GET["id"];
	 	require 'connect.php';
	 	$data = "SELECT * FROM sanpham WHERE id_SanPham =".$takeData;
	 	$result = mysqli_query($conn,$data);
	 	$row = mysqli_fetch_assoc($result);
	  ?>
	<div class="container">
		<div class="header"> <!-- header_navbar -->
				<div class="header_navbar">
					<div class="logo">
						<a href="trangchu.php"><img src="images/logo_transparent.png" alt="day la anh"></a> 
					</div>
					<div class="timkiem">
						<form action="">
							<input type="text" name="timkiem" placeholder="search...">
							<button type="submit" name="submit"><i class="fas fa-search"></i></button>
						</form>
					</div>
					<ul class="dangnhap1">
						<li><a href="dangnhap.php"  style="color: black;"><i class="fas fa-sign-in-alt"></i><p>Đăng nhập</p></a></li>
						<li><a href=""  style="color: black;"><i class="fas fa-shopping-cart"></i><p>Giỏ hàng</p></a></li>
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
			 <h3 style="padding-left: 15px;"><?php echo $row["tenSanpham"]; ?></h3>
				<div style="border-bottom: 1px solid #EEE; width: 100%;"></div>
				<br>
				<div class="sub_content">
					<div class="sub_content_trai">
								<a href="">
									<img src="<?php echo $row["hinhAnh"]; ?>" alt="day la anh">
								</a>
									<table>
										<tr>
											<td>Màn hình:</td>
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
										 <tr>
											<td>Năm sản xuất:</td>
											<td class="cot2"><?php echo $row["namSanXuat"]; ?></td>
										</tr>
									</table>
					</div>
					<div class="sub_content_giua">
						<h3><?php echo number_format($row["gia"],0,'.','.')."đ"; ?></h3>
						<div class="sub">
							<div style="background-color: green; width: 100%; color: white; padding-left: 7px; font-size: 16px; height: 30px; display: flex; align-items: center;">Khuyến mãi đặc biệt</div>
							<ul>
								<li>Tặng PMH Phụ Kiện 200,000đ</li>
								<li>Tặng Balo Laptop</li>
								<li>Mua kèm Laptop: Microsoft 365 Personal chỉ còn 690,000đ</li>
								<li>Giảm 20% Combo bảo vệ Laptop (Combo MDMH và Phần mềm Diệt virus Eset) khi mua kèm máy</li>
								<li>Tặng suất mua Đồng hồ thời trang giảm đến 40%</li>
							</ul>
						</div>
						<a href="gioHang.php?id_gioHang=<?php echo $takeData; ?>">MUA NGAY</a>
					</div>

					<div class="sub_content_phai">
						<h4></i>Trong hộp có</h4>
						<span><i class="fas fa-atom"></i>Hộp máy, bộ sạc, laptop và sách hướng dẫn sử dụng</span> 
						<span><i class="fas fa-bahai"></i>Hàng chính hãng</span>
						<span><i class="fas fa-check-double"></i>Bảo hành 24 Tháng chính hãng</span>
						<span><i class="fas fa-truck"></i>Giao hàng miễn phí toàn quốc trong 60 phút</span>

					</div>

				</div>
			 <div style="border-top: 25px solid #EEE; width: 100%;"></div>
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
	<?php 
		mysqli_close($conn);
	 ?>
	<script src="javascript.js"></script>
</body>
</html>

