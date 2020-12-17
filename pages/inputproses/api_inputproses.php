<?php
	header("Access-Control-Allow-Origin: *");
	session_start();
	header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS");
    include "../../lib/conn.php";
    mysqli_set_charset($conn,'utf8');

    $method = isset($_POST['_METHOD']) ? $_POST['_METHOD'] : $_SERVER['REQUEST_METHOD'];

    $key = isset($_REQUEST['kd_produksi']) ? $_REQUEST['kd_produksi'] : '';
    
		$tgl_produksi= isset($_REQUEST['tgl_produksi']) ? $_REQUEST['tgl_produksi'] : '' ;
		$bhnbaku= isset($_REQUEST['bhnbaku']) ? $_REQUEST['bhnbaku'] : '' ;
		$bhnpendukung= isset($_REQUEST['bhnpendukung']) ? $_REQUEST['bhnpendukung'] : '' ;
		$waktu= isset($_REQUEST['waktu']) ? $_REQUEST['waktu'] : '' ;
    switch ($method) {
        case 'GET':
          $sql = "SELECT * FROM inputproses ".($key ?" WHERE kd_produksi =$key":''); 
        break;
        case 'PUT': $sql = "UPDATE inputproses SET 
										tgl_produksi= '$tgl_produksi', 
										bhnbaku= '$bhnbaku', 
										bhnpendukung= '$bhnpendukung', 
										waktu= '$waktu' WHERE kd_produksi = $key ";
        break;
        case 'POST': $sql = "INSERT INTO inputproses( 
										tgl_produksi, 
										bhnbaku, 
										bhnpendukung, 
										waktu) VALUES (
										'$tgl_produksi', 
										'$bhnbaku', 
										'$bhnpendukung', 
										'$waktu')";
        break;
        case 'DELETE':
           $sql = "DELETE FROM inputproses WHERE kd_produksi = $key"; 
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