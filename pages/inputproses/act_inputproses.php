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

	if($mod == "inputproses" AND $act == "simpan")
	{
		//variable input
		
		$tgl_produksi= $_POST['tgl_produksi'];
		$bhnbaku= $_POST['bhnbaku'];
		$bhnpendukung= $_POST['bhnpendukung'];
		$waktu= $_POST['waktu'];

		mysqli_query($conn, "INSERT INTO inputproses(
										tgl_produksi, 
										bhnbaku, 
										bhnpendukung, 
										waktu)
									VALUES (
										'$tgl_produksi', 
										'$bhnbaku', 
										'$bhnpendukung', 
										'$waktu')") ;
		echo"<script>
			window.history.go(-2);
		</script>";
	}

	elseif ($mod == "inputproses" AND $act == "edit") 
	{
		//variable input
		$kd_produksi = trim($_POST['id']);
		$tgl_produksi= $_POST['tgl_produksi'];
		$bhnbaku= $_POST['bhnbaku'];
		$bhnpendukung= $_POST['bhnpendukung'];
		$waktu= $_POST['waktu'];

		mysqli_query($conn, "UPDATE inputproses SET 
										tgl_produksi= '$tgl_produksi', 
										bhnbaku= '$bhnbaku', 
										bhnpendukung= '$bhnpendukung', 
										waktu= '$waktu' 
					WHERE kd_produksi = '$_POST[id]'");

		echo"<script>
			window.history.go(-2);
		</script>";
	}

	elseif ($mod == "inputproses" AND $act == "hapus") 
	{
		mysqli_query($conn, "DELETE FROM inputproses WHERE kd_produksi = '$_GET[id]'");
		echo"<script>
			window.history.back();
		</script>";	
	}

?>