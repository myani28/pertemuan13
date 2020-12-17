<?php
	if(!isset($_SESSION['login_user'])){
		header('location: ../../login.php'); // Mengarahkan ke Home Page
	}

	//link buat paging
	$linkaksi = 'index.php?page=laporanbiayaproduksi';

	if(isset($_GET['act']))
	{
		$act = $_GET['act'];
		$linkaksi .= '&act=$act';
	}
	else
	{
		$act = '';
	}

	$aksi = 'pages/laporanbiayaproduksi/act_laporanbiayaproduksi.php';

	switch ($act) {
		case 'form':
			if(!empty($_GET['id']))
			{
				$act = "$aksi?page=laporanbiayaproduksi&act=edit";
				$query = mysqli_query($conn, "SELECT * FROM laporanbiayaproduksi WHERE id = '$_GET[id]'");
				$temukan = mysqli_num_rows($query);
				if($temukan > 0)
				{
					$c = mysqli_fetch_assoc($query);
				}
				else
				{
					header("location:index.php?page=laporanbiayaproduksi");
				}

			}
			else
			{
				$act = "$aksi?page=laporanbiayaproduksi&act=simpan";
			}

		echo"<div class='col-md-12'>
          <div class='box box-primary'>
            <div class='box-header with-border'>
              <h3 class='box-title'> Laporan Biaya Produksi Per Periode</h3>
			</div>";
			
            echo"<form role='form'  method='POST' action='$act' enctype='multipart/form-data' >
              <div class='box-body'>
                <div class='form-group'>
                  
                  <input type='hidden' class='form-control' name='id' value='"?><?php echo isset($c['id']) ? $c['id'] : '';?><?php echo"'"?> <?php echo isset($c['id']) ? ' readonly' : ' ';?><?php echo" >
								</div>
					<div class='form-group'><label >TANGGAL PRODUKSI</label>
					<input type='text' class='form-control' placeholder='Tanggal Produksi' name='tgl_produksi' value='"?><?php echo isset($c['tgl_produksi']) ? $c['tgl_produksi'] : '';?><?php echo"'"?> <?php echo isset($c['tgl_produksi']) ? ' ' : ' ';?><?php echo" >
										</div>
					<div class='form-group'><label >BAHAN BAKU KELUAR</label>
					<input type='text' class='form-control' placeholder='Bahan Baku Keluar' name='bahanbaku_keluar' value='"?><?php echo isset($c['bahanbaku_keluar']) ? $c['bahanbaku_keluar'] : '';?><?php echo"'"?> <?php echo isset($c['bahanbaku_keluar']) ? ' ' : ' ';?><?php echo" >
										</div>
					<div class='form-group'><label >BAHAN PENDUKUNG KELUAR</label>
					<input type='text' class='form-control' placeholder='Bahan Pendukung Keluar' name='bahanpendukung_keluar' value='"?><?php echo isset($c['bahanpendukung_keluar']) ? $c['bahanpendukung_keluar'] : '';?><?php echo"'"?> <?php echo isset($c['bahanpendukung_keluar']) ? ' ' : ' ';?><?php echo" >
										</div>
					<div class='form-group'><label >HARGA BAHAN BAKU</label>
					<input type='text' class='form-control' placeholder='Harga Bahan Baku' name='hrg_bahanbaku' value='"?><?php echo isset($c['hrg_bahanbaku']) ? $c['hrg_bahanbaku'] : '';?><?php echo"'"?> <?php echo isset($c['hrg_bahanbaku']) ? ' ' : ' ';?><?php echo" >
										</div>
					<div class='form-group'><label >HARGA BAHAN PENDUKUNG</label>
					<input type='text' class='form-control' placeholder='Harga Bahan Pendukung' name='hrg_bahanpendukung' value='"?><?php echo isset($c['hrg_bahanpendukung']) ? $c['hrg_bahanpendukung'] : '';?><?php echo"'"?> <?php echo isset($c['hrg_bahanpendukung']) ? ' ' : ' ';?><?php echo" >
										</div>
					<div class='form-group'><label >TOTAL BAHAN BAKU</label>
					<input type='text' class='form-control' placeholder='Total Bahan Baku' name='total_bahanbaku' value='"?><?php echo isset($c['total_bahanbaku']) ? $c['total_bahanbaku'] : '';?><?php echo"'"?> <?php echo isset($c['total_bahanbaku']) ? ' ' : ' ';?><?php echo" >
										</div>
					<div class='form-group'><label >TOTAL BAHAN PENDUKUNG</label>
					<input type='text' class='form-control' placeholder='Total Bahan Pendukung' name='total_bahanpendukung' value='"?><?php echo isset($c['total_bahanpendukung']) ? $c['total_bahanpendukung'] : '';?><?php echo"'"?> <?php echo isset($c['total_bahanpendukung']) ? ' ' : ' ';?><?php echo" >
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
              <h3 class='box-title'>Laporan Biaya Produksi Per Periode</h3><br/>
			  <small>Laporan Biaya Produksi</small><br/><br/>
			  <a href='index.php?page=laporanbiayaproduksi&act=form' class='w3-btn w3-big w3-blue' style='font-size:16px'><i class='fa fa-file'></i> ADD DATA</a>
            </div>
            <div class='box-body'>
              <table id='example1' class='table table-bordered table-striped'>
                <thead>
                <tr>
					<th>No</th>
						<th>TANGGAL PRODUKSI</th>
						<th>BAHAN BAKU KELUAR</th>
						<th>BAHAN PENDUKUNG KELUAR</th>
						<th>HARGA BAHAN BAKU</th>
						<th>HARGA BAHANPENDUKUNG</th>
						<th>TOTAL BAHAN BAKU</th>
						<th>TOTAL BAHAN PENDUKUNG</th>
						<th>Action</th>
                </tr>
                </thead>
                <tbody>";
				$query = "SELECT * FROM laporanbiayaproduksi ";
				$sql_kul = mysqli_query($conn, $query);
				$fd_kul = mysqli_num_rows($sql_kul);
				
				if($fd_kul > 0)
				{
					$no =  1;
					while ($m = mysqli_fetch_assoc($sql_kul)) {
						echo"<tr>
						
							<td>$no</td>
							<td>$m[tgl_produksi]</td>
							<td>$m[bahanbaku_keluar]</td>
							<td>$m[bahanpendukung_keluar]</td>
							<td>$m[hrg_bahanbaku]</td>
							<td>$m[hrg_bahanpendukung]</td>
							<td>$m[total_bahanbaku]</td>
							<td>$m[total_bahanpendukung]</td>
							<td><a href='index.php?page=laporanbiayaproduksi&act=form&id=$m[id]'><i class='fa fa-pencil-square w3-large w3-text-blue'></i></a> 
							<a href='$aksi?page=laporanbiayaproduksi&act=hapus&id=$m[id]' onclick=\"return confirm('Are You sure want to delete?');\"><i class='fa fa-trash w3-large w3-text-red'></i></a></td>
						
						</tr>";
						$no++;
					}
				}
				else
				{
					echo"<tr>
						<td colspan='9'><div class='w3-center'><i>Data Laporan Biaya Produksi Per Periode Not Found.</i></div></td>
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