<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style>
		@media print  
		{
		a[href]:after {
		content: none !important;
		 }
		@page {
		margin-top: 0;
		margin-bottom: 0;
		}
		 body{
		padding-top: 72px;
		padding-bottom: 72px ;
		}
		}
	</style>
	<style type="text/css">
		.table-data{
			width: 100%;
			border-collapse: collapse;
		}
		.table-data tr th,
		.table-data tr td{
			border:1px solid black;
			font-size: 10pt;
			/*text-align: center;*/
		}
	</style>

	<!-- <h3>Laporan Asset Tahun <?php echo $tahun; ?></h3>	
	<hr><width="100" height="75"></hr>
	<h1><center><font size="5" face="arial">SMK NEGERI 1 KOTA BEKASI</font></center></h1>
	<center><b><font size="4" face="Courier New">TEKNIK KOMPUTER DAN JARINGAN</font></b></center><br>
	<center><b>Jl. Bintara 8 no. 2 Bekasi Barat - 17134<b></center><br>
	<hr><width="100" height="75"></hr> -->

	<div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-2">
        	<img src="<?php echo base_url().'assets/pdm.jpg'; ?>" height="100px" width="100px;">
        </div>
        <div class="col-md-6 text-center">
        	<font size="5" face="arial">PIMPINAN DAERAH MUHAMMADIYAH KABUPATEN PEKALONGAN</font>
        	<p>
        		<font face="arial">Jalan Pahlawan Telp/Fax (0285) 381178 Kajen Kab. Pekalongan 51161</font>
        	</p>
        </div>
        <div class="col-md-2">        	
        </div>
    </div>
    <!-- <hr><width="100" height="75"></hr> -->
     <hr color="#00000" size="10" width="100%">
    <br>
	<table class="table-data" cellpadding="10">
		<thead class="text-center" style="border: 4px;">
			<tr style="font-weight:bold">
				<th rowspan="2">No</th>
				<th rowspan="2">Nama PCM</th>
				<th rowspan="2">Alamat</th>			
				<th colspan="3">Asset</th>				
			</tr>
			<tr style="font-weight:bold">				
				<th>Nama</th>
				<th>Jenis</th>
				<th>Jumlah</th>				
			</tr>
		</thead>
		<tbody>
			<?php  
				$no = 1;
				foreach ($laporan as $l) { 
			?>
			<tr style="font-weight:bold" class="text-center">
				<td><?php echo $no++."."; ?></td>				
				<td><?php echo $l->nama; ?></td>
				<td><?php echo $l->alamat; ?></td>
				<td colspan="3"></td>				
			</tr>

				<?php  
					$nos = 1;
					$datas['laps'] = $this->m_crud->get_datas('laporan', date("Y", strtotime($l->tanggal)), $l->kode_daftar)->result();

                    foreach ($datas['laps'] as $ds) {
				?>

			<tr style="text-align: center;">				
				<td><?php echo $nos++; ?></td>
				<td colspan="2"></td>
				<td><?php echo $ds->nama_asset; ?></td>				
				<td>
					<?php 
						if ($ds->jenis_asset == 1) {
							echo "Bergerak";
						}else{
							echo "Tidak Bergerak";
						}
					?>					
				</td>
				<td><?php echo $ds->jml_asset; ?></td>				
			</tr>			
				<?php } ?>
				<tr>
				<td colspan="6"></td>
			</tr>		
			<?php } ?>
		</tbody>
	</table>

	<br><br>

	<div class="row">
		<div class="col-md-9">
        </div>
        <div class="col-md-3 text-center">
        	<p>Pekalongan, <?php  echo $this->m_crud->tgl_indo(date('Y-m-d')); ?></p>
        	<br><br>
        	<p><b><u>Soekarno</u></b></p>
        </div>
	</div>		
</body>
</html>