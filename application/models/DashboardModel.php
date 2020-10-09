<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DashboardModel extends CI_Model {

	public function view() {
		// $this->db->select('*');
		// $this->db->group_by('personnel_id');
		// $this->db->where('personnel_id !=','');
		// $this->db->where('date =','SELECT max(date) from data_absensi');
		// $this->db->order_by('first_name','ASC');
		// return $this->db->get('data_absensi')->result(); // Tampilkan semua data yang ada di tabel siswa
		
		$sql = "select * from data_absensi where personnel_id != '' and date = (SELECT max(date) from data_absensi) group by personnel_id order by first_name ASC";
		return $this->db->query($sql)->result();
	}

	public function detail($id){
		$sql = "select * from data_absensi where personnel_id = '$id' and date = (SELECT max(date) from data_absensi)";
		return $this->db->query($sql)->result(); // Tampilkan semua data yang ada di tabel siswa
	}

	public function detail_tgl($tgl){
		$this->db->select('*');
		$this->db->where('personnel_id !=','');
		$this->db->where('date',$tgl);
		$this->db->group_by('personnel_id');
		$this->db->order_by('first_name', 'ASC');
		return $this->db->get('data_absensi')->result(); // Tampilkan semua data yang ada di tabel siswa
	}

}
