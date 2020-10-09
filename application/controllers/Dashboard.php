<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		if ($this->session->userdata('status')<>'login') {
			redirect(site_url('login'));
		}
		$this->load->model('DashboardModel');
	}
	
	public function index(){
		$data['absensi'] = $this->DashboardModel->view();
		$data['chart'] = null;
		$this->template->load('template','v_dashboard', $data);
		//echo '<pre>';
		//print_r($data);exit();
		//echo '</pre>';
	}

	public function detail($id){
		$data['detail'] = $this->DashboardModel->detail($id);
		$this->template->load('template','v_dashboard', $data);
	}

	public function read(){
		$date = DateTime::createFromFormat('d/m/Y',$_POST['tgl_absen']);
		$tgl = $date->format("Y-m-d");
		$data['absensi'] = $this->DashboardModel->detail_tgl($tgl);
		if ($data['absensi']==null) {
			$data['warning'] = 'error';
			$this->template->load('template','v_dashboard', $data);
			//print_r($data);exit();
		}
		else{
			$this->template->load('template','v_dashboard', $data);
		}
	}
}
