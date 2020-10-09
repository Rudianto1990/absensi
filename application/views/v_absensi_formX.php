<html>
<head>
	<title>Form Import</title>

	<!-- Load File jquery.min.js yang ada difolder js -->
	<script src="<?php echo base_url('js/jquery.min.js'); ?>"></script>

	<script>
	$(document).ready(function(){
		// Sembunyikan alert validasi kosong
		$("#kosong").hide();
	});
	</script>
</head>
<body>
	<h3>Form Import</h3>
	<hr>

	<a href="<?php echo base_url("excel/format.xlsx"); ?>">Download Format</a>
	<br>
	<br>

	<!-- Buat sebuah tag form dan arahkan action nya ke controller ini lagi -->
	<form method="post" action="<?php echo base_url("index.php/absensi/form"); ?>" enctype="multipart/form-data">
		<!--
		-- Buat sebuah input type file
		-- class pull-left berfungsi agar file input berada di sebelah kiri
		-->
		<input type="file" name="file">

		<!--
		-- BUat sebuah tombol submit untuk melakukan preview terlebih dahulu data yang akan di import
		-->
		<input type="submit" name="preview" value="Preview">
	</form>

	<?php
	if(isset($_POST['preview'])){ // Jika user menekan tombol Preview pada form
		if(isset($upload_error)){ // Jika proses upload gagal
			echo "<div style='color: red;'>".$upload_error."</div>"; // Muncul pesan error upload
			die; // stop skrip
		}

		// Buat sebuah tag form untuk proses import data ke database
		echo "<form method='post' action='".base_url("index.php/absensi/import")."'>";

		// Buat sebuah div untuk alert validasi kosong
		echo "<div style='color: red;' id='kosong'>
		Semua data belum diisi, Ada <span id='jumlah_kosong'></span> data yang belum diisi.
		</div>";

		echo "<table border='1' cellpadding='8'>
		<tr>
			<th colspan='11'>Preview Data</th>
		</tr>
		<tr>
			<th>V1</th>
			<th>V2</th>
			<th>V3</th>
			<th>V4</th>
			<th>V5</th>
			<th>V6</th>
			<th>V7</th>
			<th>V8</th>
			<th>V9</th>
			<th>V10</th>
			<th>V11</th>
		</tr>";

		$numrow = 1;
		$kosong = 0;

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

			// Cek jika semua data tidak diisi
			// if($nis == "" && $nama == "" && $jenis_kelamin == "" && $alamat == "")
			// 	continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)

			// Cek $numrow apakah lebih dari 1
			// Artinya karena baris pertama adalah nama-nama kolom
			// Jadi dilewat saja, tidak usah diimport
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

		echo "</table>";

		// Cek apakah variabel kosong lebih dari 0
		// Jika lebih dari 0, berarti ada data yang masih kosong
		if($kosong > 0){
		?>
			<script>
			$(document).ready(function(){
				// Ubah isi dari tag span dengan id jumlah_kosong dengan isi dari variabel kosong
				$("#jumlah_kosong").html('<?php echo $kosong; ?>');

				$("#kosong").show(); // Munculkan alert validasi kosong
			});
			</script>
		<?php
		}else{ // Jika semua data sudah diisi
			echo "<hr>";

			// Buat sebuah tombol untuk mengimport data ke database
			echo "<button type='submit' name='import'>Import</button>";
			echo "<a href='".base_url("index.php/absensi")."'>Cancel</a>";
		}

		echo "</form>";
	}
	?>
</body>
</html>
