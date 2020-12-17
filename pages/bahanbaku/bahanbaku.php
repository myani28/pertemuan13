<?php
	if(!isset($_SESSION['login_user'])){
		header('location: ../../login.php'); // Mengarahkan ke Home Page
	}

	//link buat paging
	$linkaksi = 'index.php?page=bahanbaku';

	if(isset($_GET['act']))
	{
		$act = $_GET['act'];
		$linkaksi .= '&act=$act';
	}
	else
	{
		$act = '';
	}

	$aksi = 'pages/bahanbaku/act_bahanbaku.php';

	switch ($act) {
		case 'form':
			if(!empty($_GET['id']))
			{
				$act = "$aksi?page=bahanbaku&act=edit";
				$query = mysqli_query($conn, "SELECT * FROM bahanbaku WHERE no_inventaris = '$_GET[id]'");
				$temukan = mysqli_num_rows($query);
				if($temukan > 0)
				{
					$c = mysqli_fetch_assoc($query);
				}
				else
				{
					header("location:index.php?page=bahanbaku");
				}

			}
			else
			{
				$act = "$aksi?page=bahanbaku&act=simpan";
			}

		echo"<div class='col-md-12'>
          <div class='box box-primary'>
            <div class='box-header with-border'>
              <h3 class='box-title'> BAHAN BAKU</h3>
			</div>";
			
            echo"<form role='form'  method='POST' action='$act' enctype='multipart/form-data' >
              <div class='box-body'>
                <div class='form-group'>
                  
                  <input type='hidden' class='form-control' name='id' value='"?><?php echo isset($c['no_inventaris']) ? $c['no_inventaris'] : '';?><?php echo"'"?> <?php echo isset($c['no_inventaris']) ? ' readonly' : ' ';?><?php echo" >
								</div>
					<div class='form-group'><label >NAMA BAHAN BAKU</label>
					<input type='text' class='form-control' placeholder='Bahan Baku' name='nm_inventaris' value='"?><?php echo isset($c['nm_inventaris']) ? $c['nm_inventaris'] : '';?><?php echo"'"?> <?php echo isset($c['nm_inventaris']) ? ' ' : ' ';?><?php echo" >
										</div>
					<div class='form-group'><label >STOK</label>
					<input type='text' class='form-control' placeholder='Stok' name='stok' value='"?><?php echo isset($c['stok']) ? $c['stok'] : '';?><?php echo"'"?> <?php echo isset($c['stok']) ? ' ' : ' ';?><?php echo" >
										</div>
					<div class='form-group'><label >HARGA SATUAN</label>
					<input type='text' class='form-control' placeholder='Harga' name='harsat' value='"?><?php echo isset($c['harsat']) ? $c['harsat'] : '';?><?php echo"'"?> <?php echo isset($c['harsat']) ? ' ' : ' ';?><?php echo" >
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
              <h3 class='box-title'>BAHAN BAKU</h3><br/>
			  <small>Input Data Bahan Baku</small><br/><br/>
			  <a href='index.php?page=bahanbaku&act=form' class='w3-btn w3-big w3-blue' style='font-size:16px'><i class='fa fa-file'></i> ADD DATA</a>
            </div>
            <div class='box-body'>
              <table id='example1' class='table table-bordered table-striped'>
                <thead>
                <tr>
					<th>No</th>
						<th>NAMA BAHAN BAKU</th>
						<th>STOK</th>
						<th>HARGA SATUAN</th>
						<th>Action</th>
                </tr>
                </thead>
                <tbody>";
				$query = "SELECT * FROM bahanbaku ";
				$sql_kul = mysqli_query($conn, $query);
				$fd_kul = mysqli_num_rows($sql_kul);
				
				if($fd_kul > 0)
				{
					$no =  1;
					while ($m = mysqli_fetch_assoc($sql_kul)) {
						echo"<tr>
						
							<td>$no</td>
							<td>$m[nm_inventaris]</td>
							<td>$m[stok]</td>
							<td>$m[harsat]</td>
							<td><a href='index.php?page=bahanbaku&act=form&id=$m[no_inventaris]'><i class='fa fa-pencil-square w3-large w3-text-blue'></i></a> 
							<a href='$aksi?page=bahanbaku&act=hapus&id=$m[no_inventaris]' onclick=\"return confirm('Are You sure want to delete?');\"><i class='fa fa-trash w3-large w3-text-red'></i></a></td>
						
						</tr>";
						$no++;
					}
				}
				else
				{
					echo"<tr>
						<td colspan='5'><div class='w3-center'><i>Data BAHAN BAKU Not Found.</i></div></td>
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