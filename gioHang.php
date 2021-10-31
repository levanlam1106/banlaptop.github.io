<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Labtop</title>
	<link rel="stylesheet" href="gioHang111.css">
	<link rel="stylesheet" href="css/all.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<style>
		.container .content{
			min-height: 900px !important;
		}
	</style>
</head>
<body class="body">
	<?php
		session_start();
		$id_gioHang = (isset($_GET["id_gioHang"]))? $_GET["id_gioHang"] : "";
		$soLuong = isset($_POST["soLuong"])? $_POST["soLuong"] : "";
		$id_SoLuong = isset($_POST["id_SoLuong"])? $_POST["id_SoLuong"] : "";


		// xóa sản phẩm trong giỏ hàng
		$delete = (isset($_GET["xoa"]))? $_GET["xoa"] : "";
		unset($_SESSION['cart'][$delete]);
		if(!isset($_POST["soLuong"])){ 
			$soLuong=1;
			if($id_gioHang !=""){
			$_SESSION["cart"][$id_gioHang]=$soLuong;
		 	 
			}
		}
		if(isset($_POST["soLuong"])){
			$soLuong=isset($_POST["soLuong"])?$_POST["soLuong"] : "";
			foreach ($_SESSION["cart"] as $key => $value) {
				if ($id_SoLuong == $key) {
					 $_SESSION["cart"][$key] = $soLuong;
				}else{
					 $_SESSION["cart"][$key] = 1;
				}
			} 
		}
			if(isset($_POST["id_SoLuong"])){
					foreach ($_SESSION["cart"] as $key => $value) {
						if ($id_SoLuong == $key) {
								$soLuong_1 = ($soLuong == 1) ? "selected" : "";
								$soLuong_2 = ($soLuong == 2) ? "selected" : "";
								$soLuong_3 = ($soLuong == 3) ? "selected" : "";
								$soLuong_4 = ($soLuong == 4) ? "selected" : "";
								$soLuong_5 = ($soLuong == 5) ? "selected" : "";
								$soLuong_6 = ($soLuong == 6) ? "selected" : "";
								$soLuong_7 = ($soLuong == 7) ? "selected" : "";
								$soLuong_8 = ($soLuong == 8) ? "selected" : "";
								$soLuong_9 = ($soLuong == 9) ? "selected" : "";
								$soLuong_10 = ($soLuong == 10) ? "selected" : "";
							}
		 
					}
			}
			 

			$tinhID = (isset($_POST["tinh"]))? $_POST["tinh"] : "";
			$huyenID = (isset($_POST["huyen"]))? $_POST["huyen"] : "";

			$xaID = (isset($_POST["xa"]))? $_POST["xa"] : "";
		
		// truy van gio hang
			$hoTen="";
			$SDT="";
			$diaChi="";
			 
			$id_TK = (isset($_POST["id_TK"]))? $_POST["id_TK"] : "";
			$id_SP = (isset($_POST["id_SP"]))? $_POST["id_SP"] : "";
			$soLuongMua = (isset($_POST["soLuongMua"]))? $_POST["soLuongMua"] : "";
			$hoTen = (isset($_POST["hoTen"]))? $_POST["hoTen"] : "";
			$SDT = (isset($_POST["SDT"]))? $_POST["SDT"] : "";
			$tinh = (isset($_POST["tinh"]))? $_POST["tinh"] : "";
			$huyen = (isset($_POST["huyen"]))? $_POST["huyen"] : "";
			$xa = (isset($_POST["xa"]))? $_POST["xa"] : "";
			$diaChi = (isset($_POST["diaChi"]))? $_POST["diaChi"] : "";
			date_default_timezone_set('Asia/Ho_Chi_Minh');

			$time = getdate();

			$ngayDat = $time["mday"]."-".$time["mon"]."-".$time["year"]." ".$time["hours"].":".$time["minutes"].":".$time["seconds"];
			if(isset($_POST["datHang"])){
			require 'connect.php';
			$diaChiNhan = "SELECT devvn_tinhthanhpho.name, devvn_quanhuyen.name, devvn_xaphuongthitran.name
							FROM devvn_tinhthanhpho, devvn_quanhuyen, devvn_xaphuongthitran
							WHERE devvn_tinhthanhpho.matp = '".$tinh."' AND devvn_quanhuyen.maqh = '".$huyen."'AND devvn_xaphuongthitran.xaid = '".$xa."'
			";
			$NoiNhan = mysqli_fetch_array(mysqli_query($conn, $diaChiNhan)) ;

			$kqNoiNhan = $diaChi." - ".$NoiNhan[2]." - ".$NoiNhan[1]." - ".$NoiNhan[0];
			$insertKQ = "INSERT INTO donhang (id_TaiKhoan, id_SanPham, soLuong, ngayDat, nguoiNhan, SDT, noiNhan, trangThai)
				VALUES('$id_TK', '$id_SP', '$soLuongMua', '$ngayDat', '$hoTen', '$SDT', '$kqNoiNhan', 'chưa xử lý')
			";
			 
			mysqli_query($conn, $insertKQ);
			echo '<script>alert("Cảm ơn bạn đã đặt hàng")</script>'; 
			mysqli_close($conn);
		} 
	?>

	<div class="container">
		<div class="header"> <!-- header_navbar -->
				<div class="header_navbar">
					<div class="logo">
						<a href="trangchu.php"><img src="images/logo_transparent.png" alt="day la anh"></a> 
					</div>
					<div class="timkiem">
						<form action="timkiem.php" method="post">
							<input type="text" name="timKiem_trangChu" placeholder="Nhập tên sản phẩm, thương hiệu...">
							<button type="submit" name="submitTimKiem"><i class="fas fa-search"></i></button>
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
		<br>
		<span style="padding-left: 178px;">Giỏ Hàng (<?php if(isset($_SESSION["cart"]) ) echo count($_SESSION["cart"])." sản phẩm"; else{echo "0 sản phẩm";} ?>) </span>
		<div class="content">	<!--  content -->
				<?php 
					require 'connect.php';
						$frm_id=0;
						if(isset($_SESSION["cart"])){
						foreach ($_SESSION["cart"] as $key => $value) {
							$frm_id++;
							$data = "SELECT id_SanPham, hinhAnh, tenSanpham, gia FROM sanpham WHERE id_SanPham=".$key;
							$result = mysqli_query($conn, $data);
							 
							$row = mysqli_fetch_assoc($result)
								  ?>
									<div class="oMua">
										<div class="trai">
										<div class="img">
											<img src="<?php echo $row["hinhAnh"]; ?>" alt="">
										</div>
										<span class="tenSanpham"><?php echo $row["tenSanpham"]; ?>
											<a href="gioHang.php?xoa=<?php echo $row["id_SanPham"]; ?>">Xóa</a>
										</span>
										<span class="gia"><?php echo number_format($row["gia"],0,'.','.')."₫"; ?></span>
										<div class="so">
										<span>Số Lượng:
										 <?php
										  if($key == $id_SoLuong) echo $soLuong;
										  else if ($key != $id_SoLuong) {
										   	echo 1;
										   } 
										  ?>
										  	
										  </span>
										<form action="gioHang.php" method="post" name="frm_<?php echo $key; ?>">
											<select name="soLuong" id="soLuong" onChange="frm_<?php echo $key; ?>.submit();">
												<option value="1"
												<?php if ($id_SoLuong == $key) echo $soLuong_1; ?>>1
												</option>
												<option value="2" 
												<?php if($id_SoLuong == $key) echo $soLuong_2; ?>>2
												</option>
												<option value="3" 
												<?php if($id_SoLuong == $key) echo $soLuong_3; ?>>3
												</option>
												<option value="4"
												 <?php if($id_SoLuong == $key) echo $soLuong_4; ?>>4
												</option>
												<option value="5"
												 <?php if($id_SoLuong == $key) echo $soLuong_5; ?>>5
												</option>
												<option value="6"
												 <?php if($id_SoLuong == $key) echo $soLuong_6; ?>>6
												</option>
												<option value="7"
												 <?php if($id_SoLuong == $key) echo $soLuong_7; ?>>7
												</option>
												<option value="8"
												 <?php if($id_SoLuong == $key) echo $soLuong_8; ?>>8
												</option>
												<option value="9"
												 <?php if($id_SoLuong == $key) echo $soLuong_9; ?>>9
												</option>
												<option value="10"
												 <?php if($id_SoLuong == $key) echo $soLuong_10; ?>>10
												</option>
											</select>
											<input type="hidden" value="<?php echo $key; ?>" name="id_SoLuong">
										</form>
									</div>
								</div>
									<div class="muahang">
										<p>
											<span>Tạm tính:</span>
											<?php 
											echo number_format($row["gia"]*$value,0,'.','.')."₫";
										
											?>
										
										</p>
										<a class="tienHanhDatHang" href="gioHang.php?id_mua=<?php echo $row["id_SanPham"]; ?>&id_frm=<?php echo $frm_id; ?>">Tiến Hành Đặt Hàng</a>
									</div>
								</div>
								  <?php

							
						}
					}

						mysqli_close($conn);
				 ?>
			<div class="frm_dathang">
				<div  class="close"><i>&times;</i></div> 

				 
				<?php 
					$id_mua = (isset($_GET["id_mua"]))? $_GET["id_mua"] : "";

					$id_frm = (isset($_GET["id_frm"]))? $_GET["id_frm"] : 0;
				 	$id_frm=(integer)$id_frm;

				 	$checkDN = (isset($_SESSION["check"]))? $_SESSION["check"] : 2;
				 ?>
				<h3>Địa chỉ giao hàng</h3>

				<form action="" method="post" name="THX">
					<table>
						<tr>
							<td><input type="text" name="id_TK" hidden value="<?php echo $_SESSION["info"]["id_TaiKhoan"]; ?>"></td>
							<td>
								<input type="text" name="id_SP" hidden value="<?php echo $id_mua; ?>"> 
							</td>
							<td>
								<input type="text" name="soLuongMua" hidden value="<?php echo $_SESSION["cart"][$id_mua]; ?>"> 
							</td>
						</tr>
						<tr>
							<td>Họ Tên</td>
							<td>
								<input type="text" name="hoTen" id="id_ten" required placeholder="Nhập họ tên" value="<?php  echo $hoTen; ?>">
							</td>
						</tr>
						<tr>
							<td>Số Điện Thoại</td>
							<td><input type="text" name="SDT" id="id_SDT" required placeholder="Nhập số điện thoại" value="<?php echo $SDT; ?>">
							</td>
						</tr>
						<tr>
							<td>Tỉnh/Thành Phố</td>
							<td>
								<select name="tinh" id="" onChange="THX.submit();">
									<?php
											require 'connect.php';
											$sql = "SELECT matp, name FROM devvn_tinhthanhpho";
											$kq= mysqli_query($conn, $sql);

											while ($row=mysqli_fetch_assoc($kq)) {
												if($row["matp"] == $tinhID){
													echo "<option value=".$row["matp"]." selected>".$row["name"]."</option>";
												}else{
													echo "<option value=".$row["matp"].">".$row["name"]."</option>";

												}
												 
											}
									 ?>
								</select>
							</td>
						</tr>
						<tr>
							<td>Quận Huyện</td>
							<td>
								<select name="huyen" id="" onChange="THX.submit();">
									<?php 
										if($tinhID == ""){
											$sql = "SELECT maqh, name FROM devvn_quanhuyen";

										}else{
											$sql = "SELECT maqh, name FROM devvn_quanhuyen WHERE matp=".$tinhID;

										}
											 
											$kq= mysqli_query($conn, $sql);

											while ($row=mysqli_fetch_assoc($kq)) {
												if($row["maqh"] == $huyenID){
													echo "<option value=".$row["maqh"]." selected>".$row["name"]."</option>";
												}else{
													echo "<option value=".$row["maqh"].">".$row["name"]."</option>";
												}
												 
											}
									 ?>
								</select>
							</td>
						</tr>
						<tr>
							<td>Xã, Phường</td>
							<td>
								<select name="xa" id="">
									<?php 
										if($huyenID ==""){
											$sql = "SELECT xaid, name FROM devvn_xaphuongthitran";
										}else{
											$sql = "SELECT xaid, name FROM devvn_xaphuongthitran WHERE maqh=".$huyenID;

										}
											 
											$kq= mysqli_query($conn, $sql);

											while ($row=mysqli_fetch_assoc($kq)) {
												echo "<option value=".$row["xaid"].">".$row["name"]."</option>";
											}

											mysqli_close($conn);
									 ?>
								</select>
							</td>
						</tr>
						<tr>
							<td>Địa Chỉ</td>
							<td>
								<textarea name="diaChi" required cols="20" rows="5" placeholder="VD: số nhà 9, ngõ 147, Triều Khúc"><?php echo $diaChi; ?></textarea>
								 
							</td>
						</tr>
						<tr>
							<td>
								<input class="submit_huybo" type="reset" name="huyBO" value="reset">
								<input class="submit_dathang" type="submit" name="datHang" value="Giao đến địa chỉ này"></td>
						</tr>
					</table>
					 
				</form>
			</div>
			<?php 
				if (!isset($_SESSION["check"]) && $id_frm != "") {
					?>
						<div class="DN">
							<div class="chuaDN">
								<div class="thoatDN"><i>&times;</i><br></div>
								 
								<p>Bạn hãy đăng nhập để sử dụng tính năng này</p>
								 
								<a href="dangnhap.php">Đăng nhập</a>
							</div>

						</div>
					 
					<?php
				}
					 
			 ?>
							 

		</div>	<!-- sub_content -->
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
	<script language="javascript">

		var body= document.getElementsByClassName("body");
		var close = document.getElementsByClassName("close")[0];
		var frm_dathang = document.getElementsByClassName("frm_dathang")[0];
		var id_frm= <?php echo $id_frm; ?>;
		var checkDN = <?php echo $checkDN; ?>;
		document.write(checkDN);
		if(id_frm !=0 && checkDN == true){
		 frm_dathang.style.display="block";
		} 
		if(id_frm !=0 && checkDN == 2){
		 	body[0].className+=" active";
		} 
		close.onclick=function(){
			frm_dathang.style.display="none";
		}
	 	 var thoatDN = document.getElementsByClassName("thoatDN")[0];
		var dn = document.getElementsByClassName("DN")[0];
		thoatDN.onclick=function(){
			dn.style.display="none";
			body[0].className=body[0].className.replace(" active","") ;
		}
	</script>
</body>
</html>

