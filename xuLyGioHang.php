<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Admin</title>
	<link rel="stylesheet" href="css/all.min.css">
	<link rel="stylesheet" href="xuLyGioHang11.css">
</head>
<body>
	<?php 
		require 'connect.php';
		date_default_timezone_set('Asia/Ho_Chi_Minh');
		$time = getdate();
		$ngayBan = $time["mday"]."-".$time["mon"]."-".$time["year"]." ".$time["hours"].":".$time["minutes"].":".$time["seconds"];
		$xuLy = (isset($_POST["xuLy"]))? $_POST["xuLy"] : "";
		parse_str($xuLy);
		if(isset($trangthai)){
			$update = "UPDATE donhang set trangThai='".$trangthai."' WHERE id_DonHang=".$id;
			mysqli_query($conn, $update);
			if($trangthai == "thành công"){
				$data = "SELECT id_DonHang, sanpham.tenSanpham, soLuong, sanpham.gia, nguoiNhan, SDT, noiNhan, sanpham.gia*soLuong FROM donhang JOIN sanpham ON sanpham.id_SanPham=donhang.id_SanPham WHERE donhang.id_DonHang='".$id."'";
				$layDATA = mysqli_fetch_array(mysqli_query($conn, $data));
				$insertHDB = "INSERT INTO hoadonban(id_DonHang, tenKhachHang, SDT, tenSanPham, soLuong, 									donGia, tongTien, ngayBan, noiNhan)
							 VALUES ('".$layDATA[0]."', '".$layDATA[4]."', '".$layDATA[5]."', '".$layDATA[1]."',
							 '".$layDATA[2]."', '".$layDATA[3]."', '".$layDATA[7]."', '".$ngayBan."', '".$layDATA[6]."')";
				mysqli_query($conn, $insertHDB);
			}else{
				$delete = "DELETE FROM hoadonban WHERE id_DonHang=".$id;
				mysqli_query($conn, $delete);
			}

		}
		$donhang = (isset($_GET["donhang"])) ? $_GET["donhang"] : "";
		$trangThai = (isset($_POST["trangThai"])) ? $_POST["trangThai"] : "";
		$thatbai =($trangThai == "thất bại")? "selected" : "";
		$thanhcong =($trangThai == "thành công")? "selected" : "";
		$chuaxuly =($trangThai == "chưa xử lý")? "selected" : "";
		mysqli_close($conn);
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
			 		<a href="xuLyGioHang.php?donhang=All">Xem tất cả đơn hàng</a>
			 			<div class="timkiem">
						<form action="" method="post">
							<input type="text" name="timKiem_trangChu" placeholder="Tìm đơn hàng theo ID đơn hàng, ID sản phẩm...">
							<button type="submit" name="submitTimKiem"><i class="fas fa-search"></i></button>
						</form>
					</div>
					<form action="xuLyGioHang.php" class="form_xuLy" method="post" name="frm_xuLy">
			 			<select name="trangThai" onChange="frm_xuLy.submit();">
		  						<option value="thành công" <?php echo $thanhcong; ?>>Các đơn hàng thành công</option>
		  						<option value="thất bại" <?php echo $thatbai; ?>>Các đơn hàng thất bại</option>
		  						<option value="chưa xử lý" <?php echo $chuaxuly; ?>>Các đơn hàng chưa xử lý</option>
			 			</select>
			 		</form>
			 	</div>
			 	
			 	<!-- hiển thị các đơn hàng -->
			 	<div class="hienthi">
			 		<?php 

			 			require 'connect.php';
			 			if(isset($_GET["xoaMot"]) ){
			 				$xoaMot = (isset($_GET["xoaMot"])) ? $_GET["xoaMot"] : "";
			 				$layTT = "SELECT trangThai FROM donhang WHERE id_DonHang=".$xoaMot;
			 				$kqLayTT = mysqli_fetch_array(mysqli_query($conn, $layTT));
			 			if($kqLayTT["trangThai"] != "thành công"){
			 				 
							$deleteMot = "DELETE FROM donhang WHERE id_DonHang=".$xoaMot;
							 
						}else if( $kqLayTT["trangThai"] == "thành công"){
							$deleteMot = "DELETE FROM hoadonban WHERE id_DonHang=".$xoaMot;
							mysqli_query($conn, $deleteMot);
							$deleteMot = "DELETE FROM donhang WHERE donhang.id_DonHang=".$xoaMot;
						}
			 			mysqli_query($conn, $deleteMot);
			 		}
			 			if($trangThai != ""){
			 				$data = "SELECT id_DonHang, donhang.id_TaiKhoan, donhang.id_SanPham, donhang.soLuong, sanpham.gia, ngayDat,nguoiNhan,donhang.SDT, donhang.noiNhan, donhang.trangThai, sanpham.gia*donhang.soLuong AS ThanhTien 
							FROM donhang JOIN sanpham on donhang.id_SanPham=sanpham.id_SanPham WHERE trangThai='".$trangThai."'";
			 			}else if($donhang == "All"){
			 				 
			 				$data = "SELECT id_DonHang, donhang.id_TaiKhoan, donhang.id_SanPham, donhang.soLuong, sanpham.gia, ngayDat,nguoiNhan,donhang.SDT, donhang.noiNhan, donhang.trangThai, sanpham.gia*donhang.soLuong AS ThanhTien 
							FROM donhang JOIN sanpham on donhang.id_SanPham=sanpham.id_SanPham";
			 			}else if($trangThai == "" && $donhang == ""){
			 			  
			 				$data = "SELECT id_DonHang, donhang.id_TaiKhoan, donhang.id_SanPham, donhang.soLuong, sanpham.gia, ngayDat,nguoiNhan,donhang.SDT, donhang.noiNhan, donhang.trangThai, sanpham.gia*donhang.soLuong AS ThanhTien 
							FROM donhang JOIN sanpham on donhang.id_SanPham=sanpham.id_SanPham";
			 			}
			 			if(isset($_POST["timKiem_trangChu"])){
			 				$data1 = isset($_POST["timKiem_trangChu"])? $_POST["timKiem_trangChu"] : "";
			 				$data = "SELECT id_DonHang, donhang.id_TaiKhoan, donhang.id_SanPham, donhang.soLuong, sanpham.gia, ngayDat,nguoiNhan,donhang.SDT, donhang.noiNhan, donhang.trangThai, sanpham.gia*donhang.soLuong AS ThanhTien 
							FROM donhang JOIN sanpham on donhang.id_SanPham=sanpham.id_SanPham 
							WHERE id_DonHang LIKE '%".$data1."%'
							OR sanpham.id_SanPham LIKE '%".$data1."%'";
			 			}
			 			 
						$kq = mysqli_query($conn, $data);

						if(isset($_POST["submitTimKiem"])){
						if(mysqli_num_rows($kq) <= 0){
							echo '<h4 style="padding-left: 15px;">không tìm thấy sản phẩm với từ khóa "'.$data1.'"</h4>';
						}else{
							echo '<h4 style="padding-left: 15px;">tìm thấy ("'.mysqli_num_rows($kq).'") sản phẩm với từ khóa "'.$data1.'"</h4>';
						}
					}
						echo "<table>";
						echo "<tr>
								
								<th>ID Đơn Hàng</th>
								<th>ID Tài Khoản</th>
								<th>ID Sản Phẩm</th>
								<th>Số Lượng</th>
								<th>Đơn Giá</th>
								<th>Tổng Tiền</th>
								<th>Ngày Đặt</th>
								<th>Người Nhận</th>
								<th>SDT</th>
								<th>Nơi Nhận</th>
								<th>Trạng Thái</th> 
								<th>Xử Lý</th>
								<th>Tác vụ</th>
							</tr>
							";
							 while ($row = mysqli_fetch_array($kq)){
								?>
									<tr>
										<td><?php echo $row[0]; ?></td>
										<td><?php echo $row[1]; ?></td>
										<td><?php echo $row[2]; ?></td>
										<td><?php echo $row[3]; ?></td>
										<td><?php echo number_format($row[4],0,',','.')."₫"; ?></td>
										<td><?php echo number_format($row[10],0,',','.')."₫"; ?></td>
										<td><?php echo $row[5]; ?></td>
										<td><?php echo $row[6]; ?></td>
										<td><?php echo $row[7]; ?></td>
										<td class="noiNhan"><?php echo $row[8]; ?></td>
										<td><?php echo $row[9]; ?></td>			 
										<td>
											<form action="" method="post" name="frm_<?php echo $row[0]; ?>">
												<input type="radio" name="xuLy" value="id=<?php echo $row[0]; ?>&trangthai=thành công" onChange="frm_<?php echo $row[0]; ?>.submit();">Y
												<input type="radio" name="xuLy" value="id=<?php echo $row[0]; ?>&trangthai=thất bại" onChange="frm_<?php echo $row[0]; ?>.submit();">N
											</form>
										</td>
										<td>
											<a href="xuLyGioHang.php?sua=<?php echo $row[0]; ?>"><i class="fas fa-edit"></i></a>
									 		<a href="xuLyGioHang.php?xoaMot=<?php echo $row[0]; ?>"><i class="fas fa-trash-alt"></i></a>
										</td>
									</tr>
								<?php
						 }
						echo "</table>";
						mysqli_close($conn);
			 		 ?>

			 	</div>
			 	<?php 
			 		require 'connect.php';


			 		if(isset($_GET["sua"])){
			 			 
			 			$sua = (isset($_GET["sua"]))? $_GET["sua"] : "";
			 			if($sua !=""){
				 				$dataSua = "SELECT id_SanPham, soLuong, ngayDat, nguoiNhan, SDT, noiNhan, trangThai 
										FROM donhang WHERE id_DonHang='".$sua."'
				 			";
				 			$layDataSua = mysqli_fetch_array(mysqli_query($conn, $dataSua));
				 			$dataTTTC = ($layDataSua["trangThai"] == "thành công")? "selected" : ""; 
				 			$dataTTTB = ($layDataSua["trangThai"] == "thất bại")? "selected" : ""; 
				 			$dataTTCXL = ($layDataSua["trangThai"] == "chưa xử lý")? "selected" : ""; 
				 			$dataNN = explode(" - ", $layDataSua[5]); 
			 			}

			 			$SuaID = (isset($_POST["SuaID"])) ? $_POST["SuaID"] : "";
			 			$SuaSL = (isset($_POST["SuaSL"])) ? $_POST["SuaSL"] : "";
			 			$SuaNN = (isset($_POST["SuaNN"])) ? $_POST["SuaNN"] : "";
			 			$SuaSDT = (isset($_POST["SuaSDT"])) ? $_POST["SuaSDT"] : "";
			 			$tinhID = (isset($_POST["tinh"]))? $_POST["tinh"] : "";
			 			$huyenID = (isset($_POST["huyen"]))? $_POST["huyen"] : "";
			 			$xaID = (isset($_POST["xa"]))? $_POST["xa"] : "";
			 			$diaChi = (isset($_POST["diaChi"]))? $_POST["diaChi"] : "";
			 			$SuaTT = (isset($_POST["SuaTT"]))? $_POST["SuaTT"] : "";
 
			 			 
			 			if(isset($_POST["suaDonHang"])){

			 				date_default_timezone_set('Asia/Ho_Chi_Minh');

						$time = getdate();

						$ngayDat = $time["mday"]."-".$time["mon"]."-".$time["year"]." ".$time["hours"].":".$time["minutes"].":".$time["seconds"];

			 			$diaChiNhan = "SELECT devvn_tinhthanhpho.name, devvn_quanhuyen.name, devvn_xaphuongthitran.name
							FROM devvn_tinhthanhpho, devvn_quanhuyen, devvn_xaphuongthitran
							WHERE devvn_tinhthanhpho.matp = '".$tinhID."' AND devvn_quanhuyen.maqh = '".$huyenID."'AND devvn_xaphuongthitran.xaid = '".$xaID."'
							";

						$NoiNhan = mysqli_fetch_array(mysqli_query($conn, $diaChiNhan)) ;

						$kqNoiNhan = $diaChi." - ".$NoiNhan[2]." - ".$NoiNhan[1]." - ".$NoiNhan[0];


			 				$updateDH = "UPDATE donhang set id_SanPham='$SuaID', soLuong='$SuaSL', 
										ngayDat='$ngayDat', nguoiNhan='$SuaNN', SDT='$SuaSDT', 
										noiNhan='$kqNoiNhan', trangThai='$SuaTT' WHERE id_DonHang='".$sua."'

			 					";
			 					mysqli_query($conn, $updateDH);

			 				$dataMoi = "SELECT id_DonHang, sanpham.tenSanpham, soLuong, sanpham.gia, ngayDat, nguoiNhan, SDT,
			 				 noiNhan, trangThai, sanpham.gia*soLuong  FROM donhang JOIN sanpham on donhang.id_SanPham=sanpham.id_SanPham WHERE donhang.id_DonHang=".$sua;
			 				 $layDataMoi =mysqli_fetch_array(mysqli_query($conn, $dataMoi)) ;
			 				 
			 				 if($layDataMoi["trangThai"] == "thành công"){
			 				 	 $layDataHDB = "SELECT id_DonHang FROM hoadonban WHERE id_DonHang=".$sua;
			 				 	 if(mysqli_num_rows(mysqli_query($conn, $layDataHDB)) > 0){
			 				 	 	$dataHDBMoi = "UPDATE hoadonban set tenKhachHang='".$layDataMoi[5]."',
			 				 	 	SDT='".$layDataMoi[6]."', tenSanPham='".$layDataMoi[1]."', 
			 				 	 	soLuong='".$layDataMoi[2]."', donGia='".$layDataMoi[3]."', 
			 				 	 	tongTien='".$layDataMoi[9]."', ngayBan='$ngayDat',
			 				 	 	 noiNhan='".$layDataMoi[7]."' WHERE id_DonHang='".$sua."'";
			 				 	 }else{
			 				 	 	$dataHDBMoi = "INSERT INTO hoadonban(id_DonHang, tenKhachHang, SDT, tenSanPham, soLuong,donGia, tongTien, ngayBan, noiNhan)
							 VALUES ('".$layDATA[0]."', '".$layDATA[5]."', '".$layDATA[6]."', '".$layDATA[1]."',
							 '".$layDATA[2]."', '".$layDATA[3]."', '".$layDATA[9]."', '".$ngayDat."', '".$layDATA[7]."')";
			 				 	 }
			 				 	 mysqli_query($conn, $dataHDBMoi);
			 				 }else{
			 				 	$layDataHDB = "SELECT id_DonHang FROM hoadonban WHERE id_DonHang=".$sua;
			 				 	if(mysqli_num_rows(mysqli_query($conn, $layDataHDB)) > 0){
			 				 	$delete = "DELETE FROM hoadonban WHERE id_DonHang=".$sua;
								mysqli_query($conn, $delete);	

			 				 	}
			 				 }
			 				 $dataSua = "SELECT id_SanPham, soLuong, ngayDat, nguoiNhan, SDT, noiNhan, trangThai 
										FROM donhang WHERE id_DonHang='".$sua."'
				 			";
				 			$layDataSua = mysqli_fetch_array(mysqli_query($conn, $dataSua));
				 			$dataNN = explode(" - ", $layDataSua[5]); 
			 			}
	 					mysqli_close($conn);
			 			?>
			 			<form action="" method="post" name="THX" class="frm_sua">
			 				<div>
			 						<span>ID Sản Phẩm</span><br> 
									<input type="text" name="SuaID" 
									value="<?php echo $layDataSua[0]; ?>">
			 				</div>
			 				<div>
			 					<span>Số Lượng</span> <br>
			 					<input type="text" name="SuaSL"
									value="<?php echo $layDataSua[1]; ?>">
			 				</div>
							<div>
								<span>Người Nhận</span><br>
								<input type="text" name="SuaNN" 
									value="<?php echo $layDataSua[3]; ?>">
							</div>			 
							<div>
								<span>SDT</span><br>
								<input type="text" name="SuaSDT" 
									value="<?php echo $layDataSua[4]; ?>">
							</div>			 
							<div>
								<span>Nơi Nhận</span><br>
								<select name="tinh" id="" onChange="THX.submit();">
									<?php  
											require 'connect.php';
											$sql = "SELECT matp, name FROM devvn_tinhthanhpho";
											$kq= mysqli_query($conn, $sql);

											while ($row=mysqli_fetch_assoc($kq)) {
												if($row["matp"] == $tinhID){
													echo "<option value=".$row["matp"]." selected>".$row["name"]."</option>";
												}else if($row["name"] == $dataNN[3]){
													echo "<option value=".$row["matp"]." selected>".$row["name"]."</option>";

												}else{
													echo "<option value=".$row["matp"].">".$row["name"]."</option>";
												 
											}
												}
									 ?>
								</select>
							
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
												}else if ($row["name"] == $dataNN[2]){
													echo "<option value=".$row["maqh"]." selected>".$row["name"]."</option>";
												}else{

												 echo "<option value=".$row["maqh"].">".$row["name"]."</option>";
											}
												}
									 ?>
								</select>
							
								<select name="xa" id="">
									<?php 
										if($huyenID ==""){
											$sql = "SELECT xaid, name FROM devvn_xaphuongthitran";
										}else{
											$sql = "SELECT xaid, name FROM devvn_xaphuongthitran WHERE maqh=".$huyenID;

										}
											 
											$kq= mysqli_query($conn, $sql);

											while ($row=mysqli_fetch_assoc($kq)) {
												if($row["xaid"] == $xa){
													echo "<option value=".$row["xaid"]." selected>".$row["name"]."</option>";
												}else if($row["name"] == $dataNN[1]){
													echo "<option value=".$row["xaid"]." selected>".$row["name"]."</option>";
												 
											}else{
												echo "<option value=".$row["xaid"].">".$row["name"]."</option>";
											}

											mysqli_close($conn);
												}
									 ?>
								</select>
							</div>			 
						 	<div>
						 		<span>Địa Chỉ</span><br>
						 		<textarea name="diaChi" required cols="20" rows="5" placeholder="VD: số nhà 9, ngõ 147, triều khúc"><?php echo $dataNN[0]; ?></textarea>
						 	</div>
							<div>
								<span>Trạng Thái</span><br>
								<select name="SuaTT" class="SuaTT">
									<option value="chưa xử lý" <?php echo $dataTTCXL; ?>>chưa xử lý</option>
									<option value="thành công" <?php echo $dataTTTC; ?>>thành công</option>
									<option value="thất bại" <?php echo $dataTTTB; ?>>thất bại</option>
								</select>		 
							</div>
							<input  type="submit" name="suaDonHang" value="Xác Nhận">

						</form>
			 			<?php
			 		}


			 	 ?>
			 </div>
		</div>
	
	</div>
	<script src="admin1.js">
	</script>
</body>
</html>