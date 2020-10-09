
<?php 

// $a = gmdate("H:i:s", $wk_in); 
// $b = gmdate("H:i:s", $wk_out); 

// $cetak1 = ($b-$a);
// $cetak2 = gmdate("H:i:s", $cetak1);
//$a = 0;
//$b = 0;

foreach ($absensi_waktu as $wkinout) {
/*
	$a = $wkinout->wk_in;
	$b = $wkinout->wk_out;

	$cetak1 = $b - $a;

	$cetak2 = date('H:i:s', $cetak1);
*/
} ?>
<section class="content-header">
      <h1>
	  	DATA ABSENSI ACESS DOOR
        <small>ACESS DOOR PEGAWAI</small>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
		<?php foreach($absensi as $data){ 
							$id = $data->personnel_id;
							$name = $data->first_name.' '.$data->last_name; 
							//$in = $data->wk_in;
						break;
					} 
				?>

<!-- Info boxes -->
	<div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-arrow-circle-o-down"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">WAKTU IN</span>
              <span class="info-box-number"><?php echo $wkinout->wk_in; ?><div></div></span>
            </div>
          </div>
        </div>
       
  <!-- /.col -->
     <div class="clearfix visible-sm-block"></div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-clock-o"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">DURASI IN</span>
              <span class="info-box-number"><div id="id_in"></div></span>
            </div>
          </div>
        </div>

     <!-- /.col -->
     <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-lime"><i class="fa fa-arrow-circle-o-up"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">WAKTU OUT</span>
              <span class="info-box-number"><?php echo $wkinout->wk_out; ?><div></div></span>
            </div>
          </div>
        </div>
      <!-- /.col -->
       <div class="clearfix visible-sm-block"></div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon" style="background-color: #D076FF"><i class="fa fa-clock-o" style="color: #FFFFFF;"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">DURASI OUT</span>
              <span class="info-box-number"><div id="id_out"></div></span>
            </div>
          </div>
        </div>
       <!-- /.col -->
       <!-- <div class="clearfix visible-sm-block"></div> -->
        <!-- <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-warning"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">DURASI EROR</span>
              <span class="info-box-number"><div id="id_err"></div></span>
            </div>
          </div>
        </div> -->

         <!-- ./col -->
        <div class="col-lg-6 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3 id="id_err"></h3>

              <p>DURASI EROR</p>
            </div>
            <div class="icon">
              <i class="fa fa-warning"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

     <!-- /.col -->
     <!--   <div class="clearfix visible-sm-block"></div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-blue"><i class="fa fa-clock-o"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">TOTAL DURASI</span>
              <span class="info-box-number"><?php echo $cetak2; ?><div></div></span>
            </div>
          </div>
        </div> -->

          <!-- /.col -->
       <!-- <div class="clearfix visible-sm-block"></div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-clock-o"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">TOTAL IN+OUT+EROR</span>
              <span class="info-box-number"><div id="id_total"></div></span>
            </div>
          </div>
        </div> -->

 <!-- ./col -->
      <div class="col-lg-6 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-lime">
            <div class="inner">
              <h3 id="id_total"></h3>

              <p>TOTAL DURASI</p>
            </div>
            <div class="icon">
              <i class="fa fa-clock-o"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <!-- /.col -->
        <!-- <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-clock-o"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">TOTAL DURASI</span>
              <span class="info-box-number"><div id="id_total"></div></span>
            </div>
          </div>
        </div>
        <!-- /.col -->
      <!-- </div> -->


<!-- /.row -->
      <div class="row">
        <div class="col-lg-12">
					<div class="box">
					<div class="box-header">
						<a class='btn btn-flat btn-md btn-primary' type='button' href='<?php echo site_url("absensi") ?>'>Kembali</a>
						<a class='btn btn-flat btn-md btn-success' type='button' target="_blank" href='<?php echo site_url("absensi/cetak/".$id."/".$data->date) ?>'>Print</a>
						<div class="text-center">
							<h3 class="box-title"><b><?php echo $id.' - '.$name; ?></b></h3>
						</div>
					</div>
            <div class="box-body table-responsive">
              <table id="example1" class="table table-striped table-hover" width="120%">
				  <thead>
					<tr>
						<th>No.</th>
						<th>Card Number</th>
						<th>Device Name</th>
						<th>Event Point</th>
						<th>Verify Type</th>
						<th>Event Desc.</th>
						<th>Status</th>
						<th>In / Out</th>
						<th>Date</th>
						<th>Time</th>
						<th>Durasi In</th>
						<th>Durasi Out</th>
						<th>Durasi Error</th>
					</tr>
				  </thead>
				  <tbody>
				  <?php
							$no=1;
							$status_before = '';
							$time_before = '';
							$durasiIn = '';
							$durasiOut = '';
							$durasiError = '';
							$totalDurasiIn= 0;
							$totalDurasiOut = 0;
							$totalDurasiError= 0;
							$timeMin=null;
        					$timeMax=null;

							foreach($absensi as $data){ // Lakukan looping pada variabel siswa dari controller
								if ($data->in_out_status == $status_before) {
									$status = 'Error';
								}else{
									$status = 'Balance';
								};
								// echo strpos($data->in_out_status, 'In');
								if (strpos($data->in_out_status, 'In') > 0 && $status == 'Balance') {
									$rowColor = 'style="background-color: #84cdee;"';
									$waktuIn = $data->time;
									$waktuOut = '';
									$durasiIn = $this->times->selisih($time_before,$waktuIn);
									$durasiOut = '';
									$durasiError = '';
								}elseif (strpos($data->in_out_status, 'Out') > 0 && $status == 'Balance'){
									$rowColor = 'style="background-color: #aff093;"';
									$waktuIn = '';
									$waktuOut = $data->time;
									$durasiIn = '';
									$durasiOut = $this->times->selisih($time_before,$waktuOut);
									$durasiError = '';
								}else{
									$rowColor = 'style="background-color: #ff7373;"';
									$durasiIn = '';
									$durasiOut = '';
									$durasiError = $this->times->selisih($time_before,$data->time);
								}
								//cek looping apakah pertama?
								if ($data === reset($absensi)) {
									$durasiOut = '';
									$durasiIn = '';
								}
								$date = date("d-m-Y", strtotime($data->date));
								echo "<tr ".$rowColor.">";
								echo "<td>".$no++."</td>";
								echo "<td>".$data->card_number."</td>";
								echo "<td>".$data->device_name."</td>";
								echo "<td>".$data->event_point."</td>";
								echo "<td>".$data->verify_type."</td>";
								echo "<td>".$data->event_desc."</td>";
								echo "<td>".$status."</td>";
								echo "<td>".$data->in_out_status."</td>";
								echo "<td>".$date."</td>";
								echo "<td>".$data->time."</td>";
								echo "<td>".$durasiIn."</td>";
								echo "<td>".$durasiOut."</td>";
								echo "<td>".$durasiError."</td>";
								echo "</tr>";
								$status_before = $data->in_out_status;
								$time_before = $data->time;
								$totalDurasiIn += @$this->times->timeToSec($durasiIn);
								$totalDurasiOut += @$this->times->timeToSec($durasiOut);
								$totalDurasiError += @$this->times->timeToSec($durasiError);
							}
							   // mencari waktu in
       							 foreach($absensi as $data){
							            if ($data->in_out_status == $status_before) {
							                $status = 'Error';
							            }else{
							                $status = 'Balance';
							            };
							            if (strpos($data->in_out_status, 'In') > 0 && $status == 'Balance') {
							                $timeMin = $data->time;
							            }
							            $status_before = $data->in_out_status;
							        }
							        // mencari waktu out
							        foreach($absensi as $data){
							            if ($data->in_out_status == $status_before) {
							                $status = 'Error';
							            }else{
							                $status = 'Balance';
							            };
							            if (strpos($data->in_out_status, 'Out') > 0 && $status == 'Balance') {
							                $timeMax = $data->time;
							                break;
							            }
							            $status_before = $data->in_out_status;
							        }
						?>
				  </tbody>
				</table>
				<?php 
						$DurIn  = gmdate("H:i:s", $totalDurasiIn); 
						$DurOut = gmdate("H:i:s", $totalDurasiOut); 
						$DurErr = gmdate("H:i:s", $totalDurasiError); 
						$totalDurasi = $totalDurasiError+$totalDurasiOut+$totalDurasiIn;
						$DurTot = gmdate("H:i:s", $totalDurasi);
					?>
			</div>
		</div>
	</div>
</div>
		</section>
		

<script>
 $(document).ready(function() {
	//  alert();
			$("#id_in").text('<?php echo $DurIn ;?>');
			$("#id_out").text('<?php echo $DurOut ;?>');
			$("#id_err").text('<?php echo $DurErr ;?>');
			$("#id_total").text('<?php echo $DurTot ;?>');
			$("#id_timeMin").text('<?php echo $timeMin ;?>');
            $("#id_timeMax").text('<?php echo $timeMax ;?>');
	});
</script>


