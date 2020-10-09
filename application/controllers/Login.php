<?php
Class Login extends CI_Controller{

    function __construct() {
        parent::__construct();
        $this->load->model('Login_model');
    }

    function index(){
        $this->load->view('login');
    }

    function aksi_login(){
		$username = $this->input->post('login-username');
		$password = $this->input->post('login-password');
		$where = array(
			'username' => $username,
			'password' => md5($password)
			);
		$cek = $this->Login_model->cek_login("user",$where)->num_rows();
		if($cek > 0){
      $data = $this->Login_model->get_by_id($username);
			$data_session = array(
				'nama' => $username,
  			'nama-user' => $data->nama_user,
				'status' => "login"
				);

			$this->session->set_userdata($data_session);

			redirect(site_url("dashboard"));

		}
    else{
      $this->session->set_flashdata('message', '
      <div class="alert alert-danger" id="success-alert">
          <p>Login Gagal. '.$error['message'].'</p>
      </div>');
      redirect($_SERVER['HTTP_REFERER']);
		}

	}

	function logout(){
		$this->session->sess_destroy();
		redirect(base_url('login'));
	}
}

?>
