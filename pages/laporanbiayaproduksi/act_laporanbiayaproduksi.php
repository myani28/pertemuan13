<?php
	session_start();
	include "../../lib/conn.php";
	
	if(!isset($_SESSION['login_user'])){
		header('location: ../../login.php'); // Mengarahkan ke Home Page
	}

	if(isset($_GET['page']) && isset($_GET['act']))
	{
		$mod = $_GET['page'];
		$act = $_GET['act'];
	}
	else
	{
		$mod = "";
		$act = "";
	}

	if($mod == "laporanbiayaproduksi" AND $act == "simpan")
	{
		//variable input
		
		$tgl_produksi= $_POST['tgl_produksi'];
		$bahanbaku_keluar= $_POST['bahanbaku_keluar'];
		$bahanpendukung_keluar= $_POST['bahanpendukung_keluar'];
		$hrg_bahanbaku= $_POST['hrg_bahanbaku'];
		$hrg_bahanpendukung= $_POST['hrg_bahanpendukung'];
		$total_bahanbaku= $_POST['total_bahanbaku'];
		$total_bahanpendukung= $_POST['total_bahanpendukung'];

		mysqli_query($conn, "INSERT INTO laporanbiayaproduksi(
										tgl_produksi, 
										bahanbaku_keluar, 
										bahanpendukung_keluar, 
										hrg_bahanbaku, 
										hrg_bahanpendukung, 
										total_bahanbaku, 
										total_bahanpendukung)
									VALUES (
										'$tgl_produksi', 
										'$bahanbaku_keluar', 
										'$bahanpendukung_keluar', 
										'$hrg_bahanbaku', 
										'$hrg_bahanpendukung', 
										'$total_bahanbaku', 
										'$total_bahanpendukung')") ;
		echo"<script>
			window.history.go(-2);
		</script>";
	}

	elseif ($mod == "laporanbiayaproduksi" AND $act == "edit") 
	{
		//variable input
		$id = trim($_POST['id']);
		$tgl_produksi= $_POST['tgl_produksi'];
		$bahanbaku_keluar= $_POST['bahanbaku_keluar'];
		$bahanpendukung_keluar= $_POST['bahanpendukung_keluar'];
		$hrg_bahanbaku= $_POST['hrg_bahanbaku'];
		$hrg_bahanpendukung= $_POST['hrg_bahanpendukung'];
		$total_bahanbaku= $_POST['total_bahanbaku'];
		$total_bahanpendukung= $_POST['total_bahanpendukung'];

		mysqli_query($conn, "UPDATE laporanbiayaproduksi SET 
										tgl_produksi= '$tgl_produksi', 
										bahanbaku_keluar= '$bahanbaku_keluar', 
										bahanpendukung_keluar= '$bahanpendukung_keluar', 
										hrg_bahanbaku= '$hrg_bahanbaku', 
										hrg_bahanpendukung= '$hrg_bahanpendukung', 
										total_bahanbaku= '$total_bahanbaku', 
										total_bahanpendukung= '$total_bahanpendukung' 
					WHERE id = '$_POST[id]'");

		echo"<script>
			window.history.go(-2);
		</script>";
	}

	elseif ($mod == "laporanbiayaproduksi" AND $act == "hapus") 
	{
		mysqli_query($conn, "DELETE FROM laporanbiayaproduksi WHERE id = '$_GET[id]'");
		echo"<script>
			window.history.back();
		</script>";	
	}

?>