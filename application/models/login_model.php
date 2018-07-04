<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function user_check()
	{
		$query = $this->db->join('posisi', 'posisi.id_posisi = user.id_posisi')
						  ->where('username', $this->input->post('username'))
						  ->where('password', $this->input->post('password'))
						  ->get('user');

		if($query->num_rows() == 1 ) {
			$data_user = $query->row();
			$session = array(
				'logged_in'		=> TRUE,
				'id_user'		=> $data_user->id_user,
				'nama'			=> $data_user->nama,	
				'id_posisi'		=> $data_user->id_posisi,
				'nama_posisi'	=> $data_user->nama_posisi,
			);

			$this->session->set_userdata($session);

			return TRUE;
		} else {
			return FALSE;
		}
	}

}

/* End of file login_model.php */
/* Location: ./application/models/login_model.php */