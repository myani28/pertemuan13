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

	if($mod == "bahanbaku" AND $act == "simpan")
	{
		//variable input
		
		$nm_inventaris= $_POST['nm_inventaris'];
		$stok= $_POST['stok'];
		$harsat= $_POST['harsat'];

		mysqli_query($conn, "INSERT INTO bahanbaku(
										nm_inventaris, 
										stok, 
										harsat)
									VALUES (
										'$nm_inventaris', 
										'$stok', 
										'$harsat')") ;
		echo"<script>
			window.history.go(-2);
		</script>";
	}

	elseif ($mod == "bahanbaku" AND $act == "edit") 
	{
		//variable input
		$no_inventaris = trim($_POST['id']);
		$nm_inventaris= $_POST['nm_inventaris'];
		$stok= $_POST['stok'];
		$harsat= $_POST['harsat'];

		mysqli_query($conn, "UPDATE bahanbaku SET 
										nm_inventaris= '$nm_inventaris', 
										stok= '$stok', 
										harsat= '$harsat' 
					WHERE no_inventaris = '$_POST[id]'");

		echo"<script>
			window.history.go(-2);
		</script>";
	}

	elseif ($mod == "bahanbaku" AND $act == "hapus") 
	{
		mysqli_query($conn, "DELETE FROM bahanbaku WHERE no_inventaris = '$_GET[id]'");
		echo"<script>
			window.history.back();
		</script>";	
	}

?>