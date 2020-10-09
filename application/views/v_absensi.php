<section class="content-header">
      <h1>
	  	DATA ABSENSI ACCESS DOOR 
        <small>DATA ACCESS DOOR TEKNIK DAN SI</small>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-12">
					<?php 
					if (@$warning=='error') { ?>
						<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-warning"></i> Data Tidak Ditemukan</h4>
                Data yang anda minta tidak dapat ditampilkan. Pastikan data absensi pada tanggal yang anda pilih sudah diinput ke database.
                Pegawai tersebut kemungkinan tidak terdaftar atau tidak melakukan tap absensi acces door pada tanggal serta jam tersebut.
              </div>
				<?php	}
							elseif (@$warning=='success') { ?>
							<div class="alert alert-success alert-dismissible">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									<h4><i class="icon fa fa-check"></i> Data Berhasil Di Import</h4>
									Data berhasil ditambahkan ke database.
								</div>
				<?php	}
					?>
					<div class="box">
            <!-- /.box-header -->
            <div class="box-body table-responsive">
							<a type='button' class='btn btn-success btn-flat btn-md' href='<?php echo site_url("absensi/form_import") ?>'><i class='fa fa-plus'></i>      Import Data</a>
						
							<a data-toggle="tooltip" title="Hapus Absensi ALL"><a href="#modal-fade" data-toggle="modal" class="btn btn-effect-ripple btn-md btn-danger"><i class="fa fa-times"> Delete All</i></a>
<hr>
<div id="modal-fade" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h3 class="modal-title"><strong>Konfirmasi</strong></h3>
                                            </div>
                                            <div class="modal-body">
                                                Anda yakin akan menghapus data pegawai semua?
                                            </div>
                                            <div class="modal-footer">
                                                <a href="<?php echo site_url("absensi/delete_all") ?>" class="btn btn-effect-ripple btn-danger">Ya</a>
                                                <button type="button" class="btn btn-effect-ripple btn-info" data-dismiss="modal">Tidak</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
              <table id="example1" class="table table-striped table-hover" width="100%">
				  <thead>
					<tr>
						<th>No.</th>
						<th>Personal ID</th>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Detail</th>
					</tr>
				  </thead>
				  <tbody>
				  <?php
				  $no=1;
					if( ! empty($absensi)){ // Jika data pada database tidak sama dengan empty (alias ada datanya)
						foreach($absensi as $data){ // Lakukan looping pada variabel siswa dari controller
							echo "<tr>";
							echo "<td>".$no++."</td>";
							echo "<td>".$data->personnel_id."</td>";
							echo "<td>".$data->first_name."</td>";
							echo "<td>".$data->last_name."</td>";
							echo "<td><button type='button' class='btn btn-primary btn-flat btn-md' data-toggle='modal' data-target='#myModal".$data->personnel_id."'><i class='fa fa-book'></i></button></td>";
						
							echo "</tr>";
						}
					}else{ // Jika data tidak ada
						echo "<tr><td colspan='4'>Data tidak ada</td></tr>";
					}
					?>
				  </tbody>
			  </table>
			</div>
		</div>
	</div>
</div>
    </section>
<?php foreach($absensi as $data){ ?>
<!-- Modal -->
<div id="myModal<?php echo $data->personnel_id; ?>" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tanggal Absensi</h4>
      </div>
      <div class="modal-body">
         <!-- Date -->
				 <div class="form-group">
					 <form action="<?php echo site_url('absensi/read') ?>" method="post">
					<label>Pilih Tanggal Absensi:</label>
					<div class="input-group date">
						<div class="input-group-addon">
							<i class="fa fa-calendar"></i>
						</div>
						<input type="hidden" name="id" value="<?php echo $data->personnel_id ?>"/>
						<input type="text" placeholder="dd/mm/yyyy" name="tgl_absen" class="form-control" id="datepicker<?php echo $data->personnel_id ?>" data-date-format="dd/mm/yyyy" autocomplete="off"/>
					</div>
					</div>
      </div>
      <div class="modal-footer">
				<button type='submit' class='btn btn-success btn-md'>Tampil</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</form>
      </div>
    </div>

  </div>
</div>

<script>
	 //Date picker
	 $('#datepicker<?php echo $data->personnel_id ?>').datepicker({
      autoclose: true
    })
</script>
<?php } ?>