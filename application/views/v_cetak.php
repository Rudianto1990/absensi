<!DOCTYPE html>
<html>
  <script src="<?php echo base_url(); ?>assets/AdminLTE/bower_components/jquery/dist/jquery.min.js"></script>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Cetak Data Absensi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
	*{
		font-Family: Arial, sans-serif;
		color: #333;
    }

    .top-table tr td {
        width: 40%;
        /* border: solid 1px #9e9e9e; */
        /* border-collapse: collapse; */
        /* border-spacing: 0; */
        font: normal 13px Arial, sans-serif;
        padding: 10px;
        text-align: left;
    }

    .top-table tr td b {
        /* border: solid 1px #9e9e9e; */
        /* border-collapse: collapse; */
        /* border-spacing: 0; */
        font: normal 13px Arial, sans-serif;
    }


    .zui-table {
        width: 100%;
        border: solid 1px #9e9e9e;
        border-collapse: collapse;
        border-spacing: 0;
        font: normal 13px Arial, sans-serif;
    }
    .zui-table thead th {
        background-color: #dadfd9;
        border: solid 1px #9e9e9e;
        color: #333;
        padding: 10px;
        text-align: center;
        /* text-shadow: 1px 1px 1px #fff; */
    }
    .zui-table tbody td {
        border: solid 1px #9e9e9e;
        color: #333;
        padding: 10px;
        /* text-shadow: 1px 1px 1px #fff; */
    }
    .zui-table tr:nth-child(even) {background-color: #f2f2f2;}

    @media print {
        #printPage {
        display: none;
        }
    }
	</style>
</head>
<body>
    <?php 
        $status_before = '';
        $time_before = '';
        $durasiIn = '';
        $durasiOut = '';
        $durasiError = '';
        $totalDurasiIn= 0;
        $totalDurasiOut = 0;
        $totalDurasiError= 0;
        $timeBegin=null;
        $timeOver=null;

        foreach($absensi as $data){ // Lakukan looping pada variabel siswa dari controller
            if ($data->in_out_status == $status_before) {
                $status = 'Error';
            }else{
                $status = 'Balance';
            };
            // echo strpos($data->in_out_status, 'In');
            if (strpos($data->in_out_status, 'In') > 0 && $status == 'Balance') {
                $waktuIn = $data->time;
                $waktuOut = '';
                $durasiIn = $this->times->selisih($time_before,$waktuIn);
                $durasiOut = '';
                $durasiError = '';
            }elseif (strpos($data->in_out_status, 'Out') > 0 && $status == 'Balance'){
                $waktuIn = '';
                $waktuOut = $data->time;
                $durasiIn = '';
                $durasiOut = $this->times->selisih($time_before,$waktuOut);
                $durasiError = '';
            }else{
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
                $timeBegin = $data->time;
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
                $timeOver = $data->time;
                break;
            }
            $status_before = $data->in_out_status;
        }

        $DurIn  = gmdate("H:i:s", $totalDurasiIn); 
        $DurOut = gmdate("H:i:s", $totalDurasiOut); 
        $DurErr = gmdate("H:i:s", $totalDurasiError); 
        $totalDurasi = $totalDurasiError+$totalDurasiOut+$totalDurasiIn;
        $DurTot = gmdate("H:i:s", $totalDurasi);

        foreach($absensi as $data){ 
            $id = $data->personnel_id;
            $date = date("d-m-Y", strtotime($data->date));
            $name = $data->first_name.' '.$data->last_name; 
            $waktu_in = $data->personnel_id;
            $excelName = $data->first_name.''.$data->last_name.'_'.$date;
            break;
        }

        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=".$excelName.".xls");
    ?>

    <center><h3><b>REPORT ABSEN<?php //echo $id.' - '.$name; ?></b></h3></center>
    <table class="top-table">
        <tr>
            <td>Personal ID</td>
            <td>:&nbsp;&nbsp;<?php echo $id; ?></td>

            <td>Total In</td>
            <td>:&nbsp;&nbsp;<?php echo $DurIn; ?></b></td>
        </tr>
        <tr>
            <td>Nama</td>
            <td>:&nbsp;&nbsp;<?php echo $name; ?></td>

            <td>Total Out</td>
            <td>:&nbsp;&nbsp;<?php echo $DurOut; ?></b></td>
        </tr>
        <tr>
            <td>Waktu In</td>
            <td>:&nbsp;&nbsp;<?php echo $timeBegin ?></td>

            <td>Total Error</td>
            <td>:&nbsp;&nbsp;<?php echo $DurErr; ?></td>
        </tr>
        <tr>
            <td>Waktu Out</td>
            <td>:&nbsp;&nbsp;<?php echo $timeOver ?></td>

            <td>Total Worktime</td>
            <td>:&nbsp;&nbsp;<?php echo $DurTot; ?></td>
        </tr>
    </table>

        <table class="zui-table" width="100%">
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
                $timeBegin=null;
                $timeOver=null;

                foreach($absensi as $data){ // Lakukan looping pada variabel siswa dari controller
                    if ($data->in_out_status == $status_before) {
                        $status = 'Error';
                    }else{
                        $status = 'Balance';
                    };
                    // echo strpos($data->in_out_status, 'In');
                    if (strpos($data->in_out_status, 'In') > 0 && $status == 'Balance') {
                        $waktuIn = $data->time;
                        $waktuOut = '';
                        $durasiIn = $this->times->selisih($time_before,$waktuIn);
                        $durasiOut = '';
                        $durasiError = '';
                    }elseif (strpos($data->in_out_status, 'Out') > 0 && $status == 'Balance'){
                        $waktuIn = '';
                        $waktuOut = $data->time;
                        $durasiIn = '';
                        $durasiOut = $this->times->selisih($time_before,$waktuOut);
                        $durasiError = '';
                    }else{
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
                    echo "<tr>";
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
            ?>
        </tbody>
    </table>

    <script>
    $(document).ready(function() {
        //  alert();
                $("#id_in").text('<?php echo $DurIn ;?>');
                $("#id_out").text('<?php echo $DurOut ;?>');
                $("#id_err").text('<?php echo $DurErr ;?>');
                $("#id_total").text('<?php echo $DurTot ;?>');
                $("#id_timeBegin").text('<?php echo $timeBegin ;?>');
                $("#id_timeOver").text('<?php echo $timeOver ;?>');
        });
    </script>
</body>
</html>