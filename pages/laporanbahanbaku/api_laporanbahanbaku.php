<?php
	header("Access-Control-Allow-Origin: *");
	session_start();
	header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS");
    include "../../lib/conn.php";
    mysqli_set_charset($conn,'utf8');

    $method = isset($_POST['_METHOD']) ? $_POST['_METHOD'] : $_SERVER['REQUEST_METHOD'];

    $key = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';
    
		$nm_bahanbaku= isset($_REQUEST['nm_bahanbaku']) ? $_REQUEST['nm_bahanbaku'] : '' ;
		$tgl_produksi= isset($_REQUEST['tgl_produksi']) ? $_REQUEST['tgl_produksi'] : '' ;
		$jmlh_produksi= isset($_REQUEST['jmlh_produksi']) ? $_REQUEST['jmlh_produksi'] : '' ;
		$harsat= isset($_REQUEST['harsat']) ? $_REQUEST['harsat'] : '' ;
		$total= isset($_REQUEST['total']) ? $_REQUEST['total'] : '' ;
    switch ($method) {
        case 'GET':
          $sql = "SELECT * FROM laporanbahanbaku ".($key ?" WHERE id =$key":''); 
        break;
        case 'PUT': $sql = "UPDATE laporanbahanbaku SET 
										nm_bahanbaku= '$nm_bahanbaku', 
										tgl_produksi= '$tgl_produksi', 
										jmlh_produksi= '$jmlh_produksi', 
										harsat= '$harsat', 
										total= '$total' WHERE id = $key ";
        break;
        case 'POST': $sql = "INSERT INTO laporanbahanbaku( 
										nm_bahanbaku, 
										tgl_produksi, 
										jmlh_produksi, 
										harsat, 
										total) VALUES (
										'$nm_bahanbaku', 
										'$tgl_produksi', 
										'$jmlh_produksi', 
										'$harsat', 
										'$total')";
        break;
        case 'DELETE':
           $sql = "DELETE FROM laporanbahanbaku WHERE id = $key"; 
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