<?php 
	require 'connect.php';
	// xóa 1
	$xoaMot = (isset($_GET["xoaMot"])) ? $_GET["xoaMot"] : "";
	if($xoaMot != ""){
		$deleteMot = "DELETE FROM sanpham WHERE id_SanPham=".$xoaMot;
		mysqli_query($conn, $deleteMot);
	}
	if(isset($_POST["delete_nhieu"])){

		$xoaNhieu = (isset($_POST["choose"]))? $_POST["choose"] : ""; 
		foreach ($xoaNhieu as $key => $value) {
			$xoaNhieu_sql = "DELETE FROM sanpham WHERE id_SanPham=".$value;
			mysqli_query($conn, $xoaNhieu_sql);
		}
	}
	
	mysqli_close($conn);
 ?>

