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

	if($mod == "laporanbahanbaku" AND $act == "simpan")
	{
		//variable input
		
		$nm_bahanbaku= $_POST['nm_bahanbaku'];
		$tgl_produksi= $_POST['tgl_produksi'];
		$jmlh_produksi= $_POST['jmlh_produksi'];
		$harsat= $_POST['harsat'];
		$total= $_POST['total'];

		mysqli_query($conn, "INSERT INTO laporanbahanbaku(
										nm_bahanbaku, 
										tgl_produksi, 
										jmlh_produksi, 
										harsat, 
										total)
									VALUES (
										'$nm_bahanbaku', 
										'$tgl_produksi', 
										'$jmlh_produksi', 
										'$harsat', 
										'$total')") ;
		echo"<script>
			window.history.go(-2);
		</script>";
	}

	elseif ($mod == "laporanbahanbaku" AND $act == "edit") 
	{
		//variable input
		$id = trim($_POST['id']);
		$nm_bahanbaku= $_POST['nm_bahanbaku'];
		$tgl_produksi= $_POST['tgl_produksi'];
		$jmlh_produksi= $_POST['jmlh_produksi'];
		$harsat= $_POST['harsat'];
		$total= $_POST['total'];

		mysqli_query($conn, "UPDATE laporanbahanbaku SET 
										nm_bahanbaku= '$nm_bahanbaku', 
										tgl_produksi= '$tgl_produksi', 
										jmlh_produksi= '$jmlh_produksi', 
										harsat= '$harsat', 
										total= '$total' 
					WHERE id = '$_POST[id]'");

		echo"<script>
			window.history.go(-2);
		</script>";
	}

	elseif ($mod == "laporanbahanbaku" AND $act == "hapus") 
	{
		mysqli_query($conn, "DELETE FROM laporanbahanbaku WHERE id = '$_GET[id]'");
		echo"<script>
			window.history.back();
		</script>";	
	}

?>