<html>
<head>
	<title>IMPORT EXCEL CI 3</title>
</head>
<body>
	<h1>Data Absensi Detail</h1><hr>
	<a href="<?php echo base_url("index.php/absensi/form"); ?>">Import Data</a><br><br>

	<table border="1" cellpadding="8">
	<tr>
		<th>No.</th>
		<th>V2</th>
		<th>V3</th>
		<th>V4</th>
		<th>V5</th>
		<th>V6</th>
		<th>V7</th>
		<th>V8</th>
		<th>Status</th>
		<th>In / Out</th>
		<th>Date</th>
		<th>Time</th>
		<th>Durasi In</th>
		<th>Durasi Out</th>
		<th>Durasi Error</th>
	</tr>

	<?php
	function selisih($time1,$time2){
		$awal  = date_create($time1); //waktu awal
		$akhir = date_create($time2); //waktu akhir
		$diff  = date_diff($awal,$akhir);
		return $diff->format('%H:%I:%S');
	};
	if( ! empty($absensi)){ // Jika data pada database tidak sama dengan empty (alias ada datanya)

		$status_before = '';
		$time_before = '';
		$durasiIn = '';
		$durasiOut = '';
		$durasiError = '';
		foreach($absensi as $data){ // Lakukan looping pada variabel siswa dari controller
			
			if ($data->in_out_status == $status_before) {
				$status = 'Error';
			}else{
				$status = 'Balance';
			};
			// echo strpos($data->in_out_status, 'In');
			if (strpos($data->in_out_status, 'In') > 0 && $status == 'Balance') {
				$rowColor = 'style="background-color: #57eaf2;"';
				$waktuIn = $data->time;
				$waktuOut = '';
				$durasiIn = selisih($time_before,$waktuIn);
				$durasiOut = '';
				$durasiError = '';
			}elseif (strpos($data->in_out_status, 'Out') > 0 && $status == 'Balance'){
				$rowColor = 'style="background-color: #57f290;"';
				$waktuIn = '';
				$waktuOut = $data->time;
				$durasiIn = '';
				$durasiOut = selisih($time_before,$waktuOut);
				$durasiError = '';
			}else{
				$rowColor = 'style="background-color: #d44631;"';
				$durasiIn = '';
				$durasiOut = '';
				$durasiError = selisih($time_before,$data->time);
			}

			echo "<tr ".$rowColor.">";
			echo "<td>".$data->personnel_id."</td>";
			echo "<td>".$data->first_name."</td>";
			echo "<td>".$data->last_name."</td>";
			echo "<td>".$data->card_number."</td>";
			echo "<td>".$data->device_name."</td>";
			echo "<td>".$data->event_point."</td>";
			echo "<td>".$data->verify_type."</td>";
			echo "<td>".$data->event_desc."</td>";
			echo "<td>".$status."</td>";
			echo "<td>".$data->in_out_status."</td>";
			echo "<td>".$data->date."</td>";
			echo "<td>".$data->time."</td>";
			echo "<td>".$durasiIn."</td>";
			echo "<td>".$durasiOut."</td>";
			echo "<td>".$durasiError."</td>";
			echo "</tr>";
			$status_before = $data->in_out_status;
			$time_before = $data->time;
		}
	}else{ // Jika data tidak ada
		echo "<tr><td colspan='4'>Data tidak ada</td></tr>";
	}
	?>
	</table>
</body>
</html>
