<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('login_model');
	}

	public function index()
	{
		if($this->session->userdata('logged_in') == TRUE) {

			redirect('surat');

		} else {
			$this->load->view('login_view');
		}
	}

	public function do_login()
	{
		if($this->session->userdata('logged_in') == TRUE) {

			redirect('surat');

		} else {
			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');

			if ($this->form_validation->run() == TRUE) {
				if($this->login_model->user_check() == TRUE) {
					$this->session->set_flashdata('notif', 'Login Berhasil');
					redirect('surat');
				} else { 
					$this->session->set_flashdata('notif', 'Username atau Password Salah!');
					redirect('login');
				}
			} else {
				$this->session->set_flashdata('notif', validation_errors());
				redirect('login');
			}
		}
	}

	public function logout()
	{
		// if($this->session->userdata('logged_in') == TRUE) {
			$this->session->sess_destroy();
			redirect('login');
		// }
	}

}

/* End of file login.php */
/* Location: ./application/controllers/login.php */