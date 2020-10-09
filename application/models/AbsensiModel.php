<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AbsensiModel extends CI_Model {
	public function view(){
		$this->db->select('*');
		$this->db->group_by('personnel_id');
		$this->db->where('personnel_id !=','');
		$this->db->order_by('first_name','ASC');
		return $this->db->get('data_absensi')->result(); // Tampilkan semua data yang ada di tabel siswa
	}

	public function detail($id,$tgl){
		$this->db->select('*');
		//$this->db->join('tbl_usercategory','tbl_usercategory.usercategoryid=tbl_user.usercategoryid');
		$this->db->where('personnel_id',$id);
		$this->db->where('date',$tgl);
		return $this->db->get('data_absensi')->result(); // Tampilkan semua data yang ada di tabel
		

		/*$this->db->select('a.id_absensi,a.personnel_id,a.date,a.time,a.first_name,a.last_name,a.card_number,a.device_name,a.event_point,a.verify_type,a.in_out_status,a.event_desc,b.wk_in,b.wk_out');
		$this->db->from('data_absensi as a');
		$this->db->join('v_data_absensi as b','b.id_absensi=a.id_absensi');
		//$query=$this->db->get();
		//$data=$query->result_array(); //Joint 2 Tabel data_absensi dan tabel v_data_absensi
		$this->db->where('a.personnel_id',$id);
		$this->db->where('a.date',$tgl);
		return $this->db->get('a')->result();*/

		/*$this->db->select('data_absensi.id_absensi,data_absensi.personnel_id,data_absensi.date,data_absensi.time,data_absensi.first_name,data_absensi.last_name,data_absensi.card_number,data_absensi.device_name,data_absensi.event_point,data_absensi.verify_type,data_absensi.in_out_status,data_absensi.event_desc,v_data_absensi.wk_in,v_data_absensi.wk_out');
		$this->db->from('data_absensi');
		$this->db->join('v_data_absensi','v_data_absensi.id_absensi=data_absensi.id_absensi');
		$this->db->where('personnel_id',$id);
		$this->db->where('date',$tgl);
		$query=$this->db->get();
		$data= $query->result_array();
		*/


		/**$this->db->select('data_absensi.*, v_data_absensi.id_absensi AS id_absensi,v_data_absensi.personnel_id AS personnel_id,v_data_absensi.wk_in AS wk_in,v_data_absensi.wk_out AS wk_out');

		$this->db->from('data_absensi');
		$this->db->join('v_data_absensi','v_data_absensi.id_absensi=data_absensi.id_absensi');
		$this->db->where('data_absensi.personnel_id',$id);
		$this->db->where('data_absensi.date',$tgl);
		$query=$this->db->get();
		$data= $query->result_array(); **/
		// echo '<pre>';
		// var_dump($data);die();
		// echo '</pre>';
/*ini oke tapi blm sempurna
		$this->db->select('data_absensi.*');
        $this->db->select('v_data_absensi.wk_in AS wk_in','v_data_absensi.wk_out AS wk_out');
        $this->db->from('data_absensi','v_data_absensi');
        $this->db->where('data_absensi.personnel_id', $id);
        $this->db->where('data_absensi.date', $tgl);
        $this->db->join('v_data_absensi', 'v_data_absensi.id_absensi = data_absensi.id_absensi');

        $query = $this->db->get('data_absensi')->result_array();
      	return $query;
		*/
	}
	
	// Fungsi untuk melakukan proses upload file
	public function upload_file($filename){
		$this->load->library('upload'); // Load librari upload
		
		$config['upload_path'] = './excel/';
		$config['allowed_types'] = 'xls';
		$config['max_size']	= '2048';
		$config['overwrite'] = true;
		$config['file_name'] = $filename;
	
		$this->upload->initialize($config); // Load konfigurasi uploadnya
		if($this->upload->do_upload('file')){ // Lakukan upload dan Cek jika proses upload berhasil
			// Jika berhasil :
			$return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
			return $return;
		}else{
			// Jika gagal :
			$return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
			return $return;
		}
	}
	//Reporting Akses Door 14/07/2020
public function report_bulanan($from, $to){

	$this->db->select('*');
	//$this->db->group_by('personnel_id');
	//$this->db->from('data_absensi');
	//$this->db->where('date >=',$start); 
    //$this->db->where('date <=',$end);
    if($to !=null && $from!=null)$this->db->where("tgl_absen >=", $from);
    if($to !=null && $from !=null)$this->db->where("tgl_absen <=", $to); 
    $this->db->order_by('tgl_absen','ASC');

    return $this->db->get('v_data_absensi')->result();

    // echo '<pre>';
    // print_r($this);exit();
    // echo '</pre>';
		
}
	
	
	// Buat sebuah fungsi untuk melakukan insert lebih dari 1 data
	public function insert_multiple($data){
		$this->db->insert_batch('data_absensi', $data);
	}
	
	public function view_wk_in_out($id,$tgl){
		$this->db->select('*');
		$this->db->where('personnel_id',$id);
		$this->db->where('tgl_absen',$tgl);
		return $this->db->get('v_data_absensi')->result();
	}
	// Metode truncate adalah untuk menghapus data absensi semuanya dalam default no data
	public function mytruncate($data)
    {
        
        $this->db->empty_table('data_absensi', $data);//
    }
}
