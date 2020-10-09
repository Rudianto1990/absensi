<?php 

	// $arrPersonel[] = NULL;
	// $arrDurIn[]    = NULL;
	// $arrDurOut[]   = NULL;
	// $arrDurErr[]   = NULL;
	
	foreach ($absensi as $abs) {
		$id = $abs->personnel_id;
		$status_before = '';
		$time_before = '';
		$durasiIn = '';
		$durasiOut = '';
		$durasiError = '';
		$totalDurasiIn= 0;
		$totalDurasiOut = 0;
		$totalDurasiError= 0;
		$detail = $this->DashboardModel->detail($id);

		foreach ($detail as $det) {
			if ($det->in_out_status == $status_before) {
				$status = 'Error';
			}else{
				$status = 'Balance';
			};

			if (strpos($det->in_out_status, 'In') > 0 && $status == 'Balance') {
				$waktuIn = $det->time;
				$waktuOut = '';
				$durasiIn = $this->times->selisih($time_before,$waktuIn);
				$durasiOut = '';
				$durasiError = '';
			}elseif (strpos($det->in_out_status, 'Out') > 0 && $status == 'Balance'){
				$waktuIn = '';
				$waktuOut = $det->time;
				$durasiIn = '';
				$durasiOut = $this->times->selisih($time_before,$waktuOut);
				$durasiError = '';
			}else{
				$durasiIn = '';
				$durasiOut = '';
				$durasiError = $this->times->selisih($time_before,$det->time);
			}
			//cek looping apakah pertama?
			if ($det === reset($detail)) {
				$durasiOut = '';
				$durasiIn = '';
			};

			$status_before = $det->in_out_status;
			$time_before = $det->time;
			$totalDurasiIn += @$this->times->timeToSec($durasiIn);
			$totalDurasiOut += @$this->times->timeToSec($durasiOut);
			$totalDurasiError += @$this->times->timeToSec($durasiError);

		}
		$DurIn  = gmdate("H:i:s", $totalDurasiIn); 
		$DurOut = gmdate("H:i:s", $totalDurasiOut); 
		$DurErr = gmdate("H:i:s", $totalDurasiError); 
		$totalDurasi = $totalDurasiError+$totalDurasiOut+$totalDurasiIn;
		$DurTot = gmdate("H:i:s", $totalDurasi);

		// $arrPersonel[] = "'".$abs->first_name.' '.$abs->last_name."'";
		
		$arrPersonel[] = "'".'<botton href="../absensi/absensi" onclick="absensi();"></botton>'.$abs->first_name.' '.$abs->last_name."'";
		
		$arrDurIn[] = $totalDurasiIn/3600;
		$arrDurOut[] = $totalDurasiOut/3600;
		$arrDurErr[] = $totalDurasiError/3600;
	}
?>

<section class="content-header">
	<h1 class="pull-left">
	GRAFIK ACCESS DOOR TEKNIK DAN SI
	</h1>
	<button type='button' class='btn btn-primary btn-flat btn-md pull-right' data-toggle='modal' data-target='#myModal'><i class='fa fa-calendar'></i>  Pilih Tanggal</button>
<br><br>
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
        Pegawai tersebut kemungkinan tidak terdaftar atau tidak melakukan tap absensi acces door pada tanggal serta jam tersebut!!!
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
				<div class="box-body">
					<div style="height: 450px; overflow: auto">
							<div id="bar-chart" style="height: 2500px"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
<!-- USERS LIST -->
 <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Karyawan Telat Datang</h3>
                  <div class="box-tools pull-right">
                    <span class="label label-danger">8 New Members</span>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                  </div>
                </div>
                <!-- /.box-header -->
                <marquee><div class="box-body no-padding">
                  <ul class="users-list clearfix">
                    <li>
                      <marque><img src="<?php echo base_url(); ?>assets/AdminLTE/dist/img/user1-128x128.jpg" alt="User Image">
                      <a class="users-list-name" href="#">Alexander Pierce</a>
                      
                      <span class="users-list-date">Today</span>
                    </li>
                    <li>
                      <img src="<?php echo base_url(); ?>assets/AdminLTE/dist/img/user8-128x128.jpg" alt="User Image">
                      <a class="users-list-name" href="#">Norman</a>
                      <span class="users-list-date">Yesterday</span>
                    </li>
                    <li>
                      <img src="<?php echo base_url(); ?>assets/AdminLTE/dist/img/user7-128x128.jpg" alt="User Image">
                      <a class="users-list-name" href="#">Jane</a>
                      <span class="users-list-date">12 Jan</span>
                    </li>
                    <li>
                      <img src="<?php echo base_url(); ?>assets/AdminLTE/dist/img/user6-128x128.jpg" alt="User Image">
                      <a class="users-list-name" href="#">John</a>
                      <span class="users-list-date">12 Jan</span>
                    </li>
                    <li>
                      <img src="<?php echo base_url(); ?>assets/AdminLTE/dist/img/user2-160x160.jpg" alt="User Image">
                      <a class="users-list-name" href="#">Alexander</a>
                      <span class="users-list-date">13 Jan</span>
                    </li>
                    <li>
                      <img src="<?php echo base_url(); ?>assets/AdminLTE/dist/img/user5-128x128.jpg" alt="User Image">
                      <a class="users-list-name" href="#">Sarah</a>
                      <span class="users-list-date">14 Jan</span>
                    </li>
                    <li>
                      <img src="<?php echo base_url(); ?>assets/AdminLTE/dist/img/user4-128x128.jpg" alt="User Image">
                      <a class="users-list-name" href="#">Nora</a>
                      <span class="users-list-date">15 Jan</span>
                    </li>
                    <li>
                      <img src="<?php echo base_url(); ?>assets/AdminLTE/dist/img/user3-128x128.jpg" alt="User Image">
                      <a class="users-list-name" href="#">Nadia</a>
                      <span class="users-list-date">15 Jan</span>
                    </li>
                  </ul>
                  <!-- /.users-list -->
                </div></marquee>
                <!-- /.box-body -->
                <div class="box-footer text-center">
                  <a href="javascript:void(0)" class="uppercase"></a>
                </div>
                <!-- /.box-footer -->
              </div>
              <!--/.box -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
</section>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">GRAFIK ACCESS DOOR TEKHNIK & SI</h4>
      </div>
      <div class="modal-body">
         <!-- Date -->
				 <div class="form-group">
					 <form action="<?php echo site_url('dashboard/read') ?>" method="post">
					<label>Pilih Tanggal Absensi:</label>
					<div class="input-group date">
						<div class="input-group-addon">
							<i class="fa fa-calendar"></i>
						</div>
						<input type="text" placeholder="dd/mm/yyyy" name="tgl_absen" class="form-control" id="datepicker" data-date-format="dd/mm/yyyy" autocomplete="off"/>
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
<!-- <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script> -->
<!-- <script src="http://code.highcharts.com/highcharts.js"></script> -->
<script type="text/javascript">
	Highcharts.chart('bar-chart', {
    chart: {
				type: 'bar',
				height: 2500
    },
    title: {
        text: 'GRAFIK ACCESS DOOR TEKHNIK & SI - TANGGAL : <?php echo $this->times->tgl_indo($abs->date) ?>'
    },
    xAxis: {
        categories: [<?php echo join($arrPersonel, ',') ?>],
				crosshair: true,
				title: {
            text: 'Nama Karyawan'
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Lama Durasi (Jam)'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f} Jam</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
			borderWidth: 0,
			pointWidth: 25
        }
    },
    series: [
				{
        name: 'Durasi In',
        color: '#84cdee',
        data: [<?php echo join($arrDurIn, ',') ?>]
				},
				{
        name: 'Durasi Out',
        color: '#aff093',
        data: [<?php echo join($arrDurOut, ',') ?>]
				},
				{
        name: 'Durasi Error',
        color: '#ff7373',
        data: [<?php echo join($arrDurErr, ',') ?>]
				}
			]
});
</script>