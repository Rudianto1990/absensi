<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Absensi extends CI_Controller {
	private $filename = "import_data_absensi"; // Kita tentukan nama filenya
	
	public function __construct(){
		parent::__construct();
		if ($this->session->userdata('status')<>'login') {
			redirect(site_url('login'));
		}
		$this->load->model('AbsensiModel');
	}
	
	public function index(){
		$data['absensi'] = $this->AbsensiModel->view();
		$this->template->load('template','v_absensi', $data);
		
	}
	
	public function read(){
		$id = $_POST['id'];
		$date = DateTime::createFromFormat('d/m/Y',$_POST['tgl_absen']);
		$tgl = $date->format("Y-m-d");
		$data['absensi_waktu'] = $this->AbsensiModel->view_wk_in_out($id,$tgl);
		$data['absensi'] = $this->AbsensiModel->detail($id,$tgl);
		if ($data['absensi']==null) {
			$data['warning'] = 'error';
			
			$data['absensi'] = $this->AbsensiModel->view();
			$this->template->load('template','v_absensi', $data);
		}
		else{
			// $data['warning'] = 1;
			$this->template->load('template','v_absensi_detail', $data);
			// echo '<pre>';
			// var_dump($data);die();
			// echo '</pre>';
		}
	}

	public function cetak(){
		$id  = $this->uri->segment(3);
		$tgl = $this->uri->segment(4);
		$data['absensi'] = $this->AbsensiModel->detail($id,$tgl);

		$this->load->view('v_cetak', $data);
	}

	public function form_import(){
		$this->template->load('template','v_absensi_form');
	}

	public function form(){
		$data = array(); // Buat variabel $data sebagai array
		
		if(isset($_POST['preview'])){ // Jika user menekan tombol Preview pada form
			// lakukan upload file dengan memanggil function upload yang ada di AbsensiModel.php
			$upload = $this->AbsensiModel->upload_file($this->filename);
			
			if($upload['result'] == "success"){ // Jika proses upload sukses
				// Load plugin PHPExcel nya
				include APPPATH.'third_party/PHPExcel/PHPExcel.php';
				
				$excelreader = new PHPExcel_Reader_Excel5();
				$loadexcel = $excelreader->load('excel/'.$this->filename.'.xls'); // Load file yang tadi diupload ke folder excel
				$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
				
				// Masukan variabel $sheet ke dalam array data yang nantinya akan di kirim ke file form.php
				// Variabel $sheet tersebut berisi data-data yang sudah diinput di dalam excel yang sudha di upload sebelumnya
				$data['sheet'] = $sheet; 
			}else{ // Jika proses upload gagal
				$data['upload_error'] = $upload['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan
				$this->template->load('template','v_absensi_form', $data);
			}
		}
		$this->template->load('template','v_absensi_form', $data);
	}
	
	public function import(){
		// Load plugin PHPExcel nya
		include APPPATH.'third_party/PHPExcel/PHPExcel.php';
		
		$excelreader = new PHPExcel_Reader_Excel5();
		$loadexcel = $excelreader->load('excel/'.$this->filename.'.xls'); // Load file yang telah diupload ke folder excel
		$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
		
		// Buat sebuah variabel array untuk menampung array data yg akan kita insert ke database
		$data = array();
		
		$numrow = 1;
		foreach($sheet as $row){
			// Cek $numrow apakah lebih dari 1
			// Artinya karena baris pertama adalah nama-nama kolom
			// Jadi dilewat saja, tidak usah diimport
			if($numrow > 1){
				// Kita push (add) array data ke variabel data
				$dateTime = date('Y-m-d H:i:s', strtotime($row['A']));
				$date = date('Y-m-d', strtotime($dateTime));
				$time = date('H:i:s', strtotime($dateTime));

				array_push($data, array(
					'date'=>$date, 
					'time'=>$time, 
					'personnel_id'=>$row['B'], 
					'first_name'=>$row['C'], 
					'last_name'=>$row['D'], 
					'card_number'=>$row['E'], 
					'device_name'=>$row['F'], 
					'event_point'=>$row['G'], 
					'verify_type'=>$row['H'], 
					'in_out_status'=>$row['I'], 
					'event_desc'=>$row['J'] 
				));
			}
			$numrow++; // Tambah 1 setiap kali looping
		}

		// Panggil fungsi insert_multiple yg telah kita buat sebelumnya di model
		$this->AbsensiModel->insert_multiple($data);
		$data['absensi'] = $this->AbsensiModel->view();
		$data['warning'] = 'success';
		$this->template->load('template','v_absensi', $data);
	}
	public function delete_all($id){

		$row = $this->AbsensiModel->mytruncate($id);
        // $row = $this->AbsensiModel->get_by_id($id);

        if ($row) {
            $this->AbsensiModel->mytruncate($id);
            $this->session->set_flashdata('message', '
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4>    <i class="icon fa fa-check"></i> Sukses!</h4>Data Berhasil Dihapus
                </div>');
            redirect(site_url('absensi'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('absensi'));
        }
    }

	
}
