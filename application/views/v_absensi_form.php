<section class="content-header">
      <h1>
	  	Import Data Absensi
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-12">
			<?php 
				if (@$upload_error) { ?>
					<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-warning"></i> Upload Gagal</h4>
					Gagal mengupload data. Pesan: <?php echo @$upload_error ?>
					</div>
			<?php } ?>
			<div class="box">
            <div class="box-body">
				<form action="<?php echo site_url('absensi/form') ?>" enctype="multipart/form-data" method="post">
				<div class="form-group">
					<label>Pilih file excel absensi:</label>
					<input type="file" name="file" required/>
						<p class="help-block">Pilih file absensi yang akan diimport dengan format .xls</p>
				</div>
				<input type='submit' name="preview" value="Preview" class='btn btn-success btn-md'>
				</form>
          	</div>
          </div>
          </div>
					</div>
				
					<?php
						if(isset($_POST['preview']) && !isset($upload_error)){ // Jika user menekan tombol Preview pada form
							// if(isset($upload_error)){ // Jika proses upload gagal
							// echo "<div style='color: red;'>".$upload_error."</div>"; // Muncul pesan error upload
							// die; // stop skrip
							// }

							$numrow = 1;
							$kosong = 0;
					?>
				<form method='post' action='<?php echo base_url("absensi/import")?>'>
				<div class="row">
        <div class="col-lg-12">
					<div class="box">
					<div class="box-header">
						<h4>Preview Data</h4>
					</div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
							
              <table id="example1" class="table table-striped table-hover" width="120%">
				  <thead>
					<tr>
						<th>Date</th>
						<th>Time</th>
						<th>Personel ID</th>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Card Number</th>
						<th>Device Name</th>
						<th>Event Point</th>
						<th>Verify Type</th>
						<th>In/Out Status</th>
						<th>Event Description</th>
					</tr>
				  </thead>
				  <tbody>
				  <?php
				  // Lakukan perulangan dari data yang ada di excel
					// $sheet adalah variabel yang dikirim dari controller
						foreach($sheet as $row){
							// Ambil data pada excel sesuai Kolom
							$v1 = $row['A']; // Ambil data NIS
							$v2 = $row['B']; // Ambil data nama
							$v3 = $row['C']; // Ambil data jenis kelamin
							$v4 = $row['D']; // Ambil data alamat
							$v5 = $row['E']; // Ambil data alamat
							$v6 = $row['F']; // Ambil data alamat
							$v7 = $row['G']; // Ambil data alamat
							$v8 = $row['H']; // Ambil data alamat
							$v9 = $row['I']; // Ambil data alamat
							$v10 = $row['J']; // Ambil data alamat
						
							if($numrow > 1){
								$v1 = ( ! empty($v1))? $v1 : "-";
								$v2 = ( ! empty($v2))? $v2 : "-";
								$v3 = ( ! empty($v3))? $v3 : "-";
								$v4 = ( ! empty($v4))? $v4 : "-";
								$v5 = ( ! empty($v5))? $v5 : "-";
								$v6 = ( ! empty($v6))? $v6 : "-";
								$v7 = ( ! empty($v7))? $v7 : "-";
								$v8 = ( ! empty($v8))? $v8 : "-";
								$v9 = ( ! empty($v9))? $v9 : "-";
								$v10 = ( ! empty($v10))? $v10 : "-";
								
								$dateTime = date('Y-m-d H:i:s', strtotime($v1));
								$date = date('Y-m-d', strtotime($dateTime));
								$time = date('H:i:s', strtotime($dateTime));
								echo "<tr>";
								echo "<td>".$date."</td>";
								echo "<td>".$time."</td>";
								echo "<td>".$v2."</td>";
								echo "<td>".$v3."</td>";
								echo "<td>".$v4."</td>";
								echo "<td>".$v5."</td>";
								echo "<td>".$v6."</td>";
								echo "<td>".$v7."</td>";
								echo "<td>".$v8."</td>";
								echo "<td>".$v9."</td>";
								echo "<td>".$v10."</td>";
								echo "</tr>";
							}
				
							$numrow++; // Tambah 1 setiap kali looping
						}
					?>
				  </tbody>
				</table>
					<button type='submit' name='import' class='btn btn-success btn-md'>Import</button>
					<a href=<?php echo base_url("absensi") ?> type="button" class="btn btn-default">Cancel</a>
					</form>
					<?php } ?>
			</div>
		</div>
	</div>
</div>
    </section>
