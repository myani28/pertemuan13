<?php
	header("Access-Control-Allow-Origin: *");
	session_start();
	header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS");
    include "../../lib/conn.php";
    mysqli_set_charset($conn,'utf8');

    $method = isset($_POST['_METHOD']) ? $_POST['_METHOD'] : $_SERVER['REQUEST_METHOD'];

    $key = isset($_REQUEST['no_inventaris']) ? $_REQUEST['no_inventaris'] : '';
    
		$nm_inventaris= isset($_REQUEST['nm_inventaris']) ? $_REQUEST['nm_inventaris'] : '' ;
		$stok= isset($_REQUEST['stok']) ? $_REQUEST['stok'] : '' ;
		$harsat= isset($_REQUEST['harsat']) ? $_REQUEST['harsat'] : '' ;
    switch ($method) {
        case 'GET':
          $sql = "SELECT * FROM bahanbaku ".($key ?" WHERE no_inventaris =$key":''); 
        break;
        case 'PUT': $sql = "UPDATE bahanbaku SET 
										nm_inventaris= '$nm_inventaris', 
										stok= '$stok', 
										harsat= '$harsat' WHERE no_inventaris = $key ";
        break;
        case 'POST': $sql = "INSERT INTO bahanbaku( 
										nm_inventaris, 
										stok, 
										harsat) VALUES (
										'$nm_inventaris', 
										'$stok', 
										'$harsat')";
        break;
        case 'DELETE':
           $sql = "DELETE FROM bahanbaku WHERE no_inventaris = $key"; 
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