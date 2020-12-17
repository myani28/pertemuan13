<?php
	if(!isset($_SESSION['login_user'])){
		header('location: ../../login.php'); // Mengarahkan ke Home Page
	}

	//link buat paging
	$linkaksi = 'index.php?page=inputproses';

	if(isset($_GET['act']))
	{
		$act = $_GET['act'];
		$linkaksi .= '&act=$act';
	}
	else
	{
		$act = '';
	}

	$aksi = 'pages/inputproses/act_inputproses.php';

	switch ($act) {
		case 'form':
			if(!empty($_GET['id']))
			{
				$act = "$aksi?page=inputproses&act=edit";
				$query = mysqli_query($conn, "SELECT * FROM inputproses WHERE kd_produksi = '$_GET[id]'");
				$temukan = mysqli_num_rows($query);
				if($temukan > 0)
				{
					$c = mysqli_fetch_assoc($query);
				}
				else
				{
					header("location:index.php?page=inputproses");
				}

			}
			else
			{
				$act = "$aksi?page=inputproses&act=simpan";
			}

		echo"<div class='col-md-12'>
          <div class='box box-primary'>
            <div class='box-header with-border'>
              <h3 class='box-title'> PEMROSESAN BAHAN BAKU</h3>
			</div>";
			
            echo"<form role='form'  method='POST' action='$act' enctype='multipart/form-data' >
              <div class='box-body'>
                <div class='form-group'>
                  
                  <input type='hidden' class='form-control' name='id' value='"?><?php echo isset($c['kd_produksi']) ? $c['kd_produksi'] : '';?><?php echo"'"?> <?php echo isset($c['kd_produksi']) ? ' readonly' : ' ';?><?php echo" >
								</div>
					<div class='form-group'><label >TANGGAL PRODUKSI</label>
					<input type='text' class='form-control' placeholder='Tanggal Produksi' name='tgl_produksi' value='"?><?php echo isset($c['tgl_produksi']) ? $c['tgl_produksi'] : '';?><?php echo"'"?> <?php echo isset($c['tgl_produksi']) ? ' ' : ' ';?><?php echo" >
										</div>
					<div class='form-group'><label >BAHAN BAKU</label>
					<input type='text' class='form-control' placeholder='Bahan Baku' name='bhnbaku' value='"?><?php echo isset($c['bhnbaku']) ? $c['bhnbaku'] : '';?><?php echo"'"?> <?php echo isset($c['bhnbaku']) ? ' ' : ' ';?><?php echo" >
										</div>
					<div class='form-group'><label >BAHAN PENDUKUNG</label>
					<input type='text' class='form-control' placeholder='Bahan Pendukung' name='bhnpendukung' value='"?><?php echo isset($c['bhnpendukung']) ? $c['bhnpendukung'] : '';?><?php echo"'"?> <?php echo isset($c['bhnpendukung']) ? ' ' : ' ';?><?php echo" >
										</div>
					<div class='form-group'><label >WAKTU</label>
					<input type='text' class='form-control' placeholder='Waktu' name='waktu' value='"?><?php echo isset($c['waktu']) ? $c['waktu'] : '';?><?php echo"'"?> <?php echo isset($c['waktu']) ? ' ' : ' ';?><?php echo" >
										</div><div class='box-footer'>
					<button type='submit' class='btn btn-primary'>Submit</button> <button type='button' class='btn btn-primary' onclick='history.back()'><i class='fa fa-rotate-left'></i> Kembali</button>
				</div>
			  </div>			
            </form>
          </div>
        </div>
		";
		break;

		default :
		echo"
		<div class='col-xs-12'>
         <div class='box'>
            <div class='box-header'>
              <h3 class='box-title'>PEMROSESAN BAHAN BAKU</h3><br/>
			  <small>Input Data Pemrosesan Bahan Baku</small><br/><br/>
			  <a href='index.php?page=inputproses&act=form' class='w3-btn w3-big w3-blue' style='font-size:16px'><i class='fa fa-file'></i> ADD DATA</a>
            </div>
            <div class='box-body'>
              <table id='example1' class='table table-bordered table-striped'>
                <thead>
                <tr>
					<th>No</th>
						<th>TANGGAL PRODUKSI</th>
						<th>BAHAN BAKU</th>
						<th>BAHAN PENDUKUNG</th>
						<th>WAKTU</th>
						<th>Action</th>
                </tr>
                </thead>
                <tbody>";
				$query = "SELECT * FROM inputproses ";
				$sql_kul = mysqli_query($conn, $query);
				$fd_kul = mysqli_num_rows($sql_kul);
				
				if($fd_kul > 0)
				{
					$no =  1;
					while ($m = mysqli_fetch_assoc($sql_kul)) {
						echo"<tr>
						
							<td>$no</td>
							<td>$m[tgl_produksi]</td>
							<td>$m[bhnbaku]</td>
							<td>$m[bhnpendukung]</td>
							<td>$m[waktu]</td>
							<td><a href='index.php?page=inputproses&act=form&id=$m[kd_produksi]'><i class='fa fa-pencil-square w3-large w3-text-blue'></i></a> 
							<a href='$aksi?page=inputproses&act=hapus&id=$m[kd_produksi]' onclick=\"return confirm('Are You sure want to delete?');\"><i class='fa fa-trash w3-large w3-text-red'></i></a></td>
						
						</tr>";
						$no++;
					}
				}
				else
				{
					echo"<tr>
						<td colspan='6'><div class='w3-center'><i>Data PEMROSESAN BAHAN BAKU Not Found.</i></div></td>
					</tr>";
				}
				
				
                echo "</tbody>
                <tfoot>
                </tfoot>
              </table>
            </div>
          </div>
        </div>";

		break;
	}

	
?>