<?php
	header("Access-Control-Allow-Origin: *");
	session_start();
	header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS");
    include "../../lib/conn.php";
    mysqli_set_charset($conn,'utf8');

    $method = isset($_POST['_METHOD']) ? $_POST['_METHOD'] : $_SERVER['REQUEST_METHOD'];

    $key = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';
    
		$tgl_produksi= isset($_REQUEST['tgl_produksi']) ? $_REQUEST['tgl_produksi'] : '' ;
		$bahanbaku_keluar= isset($_REQUEST['bahanbaku_keluar']) ? $_REQUEST['bahanbaku_keluar'] : '' ;
		$bahanpendukung_keluar= isset($_REQUEST['bahanpendukung_keluar']) ? $_REQUEST['bahanpendukung_keluar'] : '' ;
		$hrg_bahanbaku= isset($_REQUEST['hrg_bahanbaku']) ? $_REQUEST['hrg_bahanbaku'] : '' ;
		$hrg_bahanpendukung= isset($_REQUEST['hrg_bahanpendukung']) ? $_REQUEST['hrg_bahanpendukung'] : '' ;
		$total_bahanbaku= isset($_REQUEST['total_bahanbaku']) ? $_REQUEST['total_bahanbaku'] : '' ;
		$total_bahanpendukung= isset($_REQUEST['total_bahanpendukung']) ? $_REQUEST['total_bahanpendukung'] : '' ;
    switch ($method) {
        case 'GET':
          $sql = "SELECT * FROM laporanbiayaproduksi ".($key ?" WHERE id =$key":''); 
        break;
        case 'PUT': $sql = "UPDATE laporanbiayaproduksi SET 
										tgl_produksi= '$tgl_produksi', 
										bahanbaku_keluar= '$bahanbaku_keluar', 
										bahanpendukung_keluar= '$bahanpendukung_keluar', 
										hrg_bahanbaku= '$hrg_bahanbaku', 
										hrg_bahanpendukung= '$hrg_bahanpendukung', 
										total_bahanbaku= '$total_bahanbaku', 
										total_bahanpendukung= '$total_bahanpendukung' WHERE id = $key ";
        break;
        case 'POST': $sql = "INSERT INTO laporanbiayaproduksi( 
										tgl_produksi, 
										bahanbaku_keluar, 
										bahanpendukung_keluar, 
										hrg_bahanbaku, 
										hrg_bahanpendukung, 
										total_bahanbaku, 
										total_bahanpendukung) VALUES (
										'$tgl_produksi', 
										'$bahanbaku_keluar', 
										'$bahanpendukung_keluar', 
										'$hrg_bahanbaku', 
										'$hrg_bahanpendukung', 
										'$total_bahanbaku', 
										'$total_bahanpendukung')";
        break;
        case 'DELETE':
           $sql = "DELETE FROM laporanbiayaproduksi WHERE id = $key"; 
        break;
    }       
      // excecute SQL statement
      $result = mysqli_query($conn,$sql);
      
      // print results, insert id or affected row count
      if ($method == 'GET') {
		  $row = mysqli_num_rows($result);
          if ($row==0) {
              $data['status'] = 201;
              $data['msg'] = 'Data not found';
              echo json_encode($data);
          }else{
			$response = array();
			$response["data"] = array();
			while ($row = mysqli_fetch_assoc($result)) {
				$data = $row;
				array_push($response["data"], $data);
			}
			echo json_encode($response);			  
          }  
      } elseif ($method == 'POST') {
          if (!$result) {
              $data['status'] = 201;
              $data['msg'] = 'Insert failed';  
          }else{
              $data['status'] = 200;
              $data['msg'] = 'Insert successful';
          }
          echo json_encode($data);
      } elseif ($method == 'PUT') {
          if (!$result) {
              $data['status'] = 201;
              $data['msg'] = 'Update failed'; 
          }else{
              $data['status'] = 200;
              $data['msg'] = 'Update successful';
          }
          echo json_encode($data);
      } elseif ($method == 'DELETE') {
          if (!$result) {
              $data['status'] = 201;
              $data['msg'] = 'Delete failed';  
          }else{
              $data['status'] = 200;
              $data['msg'] = 'Delete successful';
          }
          echo json_encode($data);
      }
       
      // close mysql connection
      mysqli_close($conn);
?>