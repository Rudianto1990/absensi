<?php
Class User extends CI_Controller{

    function __construct() {
        parent::__construct();
        $this->load->model('User_model');

        if ($this->session->userdata('status')<>'login') {
               redirect(site_url('login'));
           }
    }

    public function index(){
    	$user = $this->User_model->get_all();

        $data = array(
            'user_data' => $user
        );

		$this->template->load('template','user/user_list',$data);
	}

	public function read($id)
    {
        $row = $this->User_model->get_by_id($id);
        if ($row) {
            $data = array(
		'username' => $row->username,
		'nama_user' => $row->nama_user
	    );
            $this->load->view('user_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('user'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Tambah',
            'action' => site_url('user/create_action'),
        'username' => set_value('username'),
        'password' => set_value('password'),
        'nama_user' => set_value('nama_user')
    );
       $this->template->load('template','user/user_form', $data);
    }

    public function create_action()
    {
        $password = md5($this->input->post('password',TRUE));

        $data = array(
        'username' => $this->input->post('username',TRUE),
        'password' => $password,
        'nama_user' => $this->input->post('nama_user',TRUE)
        );

        $db_debug = $this->db->db_debug; //save setting
	      $this->db->db_debug = FALSE; //disable debugging for queries

        $this->User_model->insert($data);
        $error = $this->db->error();

        if ($error['code'] == 0) {
					$this->session->set_flashdata('message', '
					<div class="alert alert-success alert-dismissable" id="success-alert">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h4><strong>Sukses</strong></h4>
							<p>Data berhasil ditambah!</p>
					</div>');
					redirect(site_url('user'));
				}
				elseif ($error['code'] == 1062) {
						$this->session->set_flashdata('message', '
						<div class="alert alert-danger alert-dismissable" id="success-alert">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<h4><strong>Error</strong></h4>
								<p>Data Gagal Disimpan. ID sudah ada!</p>
						</div>');
						redirect($_SERVER['HTTP_REFERER']);
				}
				else {
						$this->session->set_flashdata('message', '
						<div class="alert alert-danger alert-dismissable" id="success-alert">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<h4><strong>Error</strong></h4>
								<p>Data Gagal Disimpan. '.$error['message'].'</p>
						</div>');
						redirect($_SERVER['HTTP_REFERER']);
				}
				$this->db->db_debug = $db_debug; //set it back
    }

    public function update($id)
    {
        $row = $this->User_model->get_by_id($id);

        if ($row) {
            $data = array(
            'button' => 'Edit',
            'action' => site_url('user/update_action'),
                'username' => set_value('username', $row->username),
                'password' => set_value('password'),
                'nama_user' => set_value('nama_user', $row->nama_user)
            );
            $this->template->load('template','user/user_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Data tidak ditemukan');
            redirect(site_url('user'));
        }
    }

    public function update_action()
    {
            $data = array(
                'username' => $this->input->post('username',TRUE),
                'password' => $this->input->post('password',TRUE),
                'nama_user' => $this->input->post('nama_user',TRUE)
                );

            $this->User_model->update($this->input->post('usernameedit', TRUE), $data);
            $this->session->set_flashdata('message', '
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4>    <i class="icon fa fa-check"></i> Sukses!</h4>Data Berhasil Dirubah
                </div>');
            redirect(site_url('user'));
    }

    public function delete($id)
    {
        $row = $this->User_model->get_by_id($id);

        if ($row) {
            $this->User_model->delete($id);
            $this->session->set_flashdata('message', '
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4>    <i class="icon fa fa-check"></i> Sukses!</h4>Data Berhasil Dihapus
                </div>');
            redirect(site_url('user'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('user'));
        }
    }
}
