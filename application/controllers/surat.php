 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surat extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('surat_model');
	}

	public function index()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			if($this->session->userdata('nama_posisi') == 'Admin') {

			$data['main_view'] = 'dashboard';
			$data['data_dashboard'] = $this->surat_model->get_datadashboard();
			$this->load->view('template_view', $data);

			} else {
				$data['main_view'] = 'disposisi_masuk_view';
				$data['data_disposisi'] = $this->surat_model->get_all_disposisi_masuk($this->session->userdata('id_user'));
				$this->load->view('template_view', $data);
			}
		} else {
			redirect('login');
		}
	}

	// public function dashboard_disposisi()
	// {
	// 	if ($this->session->userdata('logged_in') == TRUE) {
	// 		// if($this->session->userdata('nama_posisi') == 'Admin') {

	// 		$data['main_view'] = 'dashboard_user';
	// 		$data['data_dashboard'] = $this->surat_model->get_datadashboard();
	// 		$this->load->view('template_view', $data);

	// 		} else {
	// 			redirect('dashboard_user');
	// 		}
	// 	// } else {
	// 	// 	redirect('login');
	// 	// }
	// }

	public function suratmasuk()
	{
		if($this->session->userdata('logged_in') == TRUE) {
			if($this->session->userdata('nama_posisi') == 'Admin') {
				$data['main_view'] = 'suratmasuk_view';
				$data['data_suratmasuk'] = $this->surat_model->get_suratmasuk();

				$this->load->view('template_view', $data);
			} else {

			}
		} else {
			redirect('login');
		}
		
	}


	public function suratkeluar()
	{
		if($this->session->userdata('logged_in') == TRUE) {
			if($this->session->userdata('nama_posisi') == 'Admin') {
				$data['main_view'] = 'suratkeluar_view';
				$data['data_suratkeluar'] = $this->surat_model->get_suratkeluar();

				$this->load->view('template_view', $data);
			} else {

			}
		} else {
			redirect('login');
		}
		
	}

	public function tambah_suratmasuk()
	{
		if($this->session->userdata('logged_in') == TRUE) {
			if($this->session->userdata('nama_posisi') == 'Admin') {
				// $this->form_validation->set_rules('fieldname', 'fieldlabel', 'trim|required|min_length[5]|max_length[12]');
				$this->form_validation->set_rules('nomor_surat', 'nomor_surat', 'trim|required');
				$this->form_validation->set_rules('tgl_kirim', 'tgl_kirim', 'trim|required');
				$this->form_validation->set_rules('tgl_terima', 'tgl_terima', 'trim|required');
				$this->form_validation->set_rules('pengirim', 'pengirim', 'trim|required');
				$this->form_validation->set_rules('penerima', 'penerima', 'trim|required');
				$this->form_validation->set_rules('perihal', 'perihal', 'trim|required');

				if ($this->form_validation->run() == TRUE ) {
					$config['upload_path'] = './uploads/';
					$config['allowed_types'] = 'pdf|jpg|png';
					// $config['allowed_types'] = 'pdf|jpg|png';
					$config['max_size']  = 2000;
					
					$this->load->library('upload', $config);
					
					if ($this->upload->do_upload('file_surat')){

						if($this->surat_model->tambah_suratmasuk($this->upload->data()) == TRUE) {
							$this->session->flashdata('notif', 'Tambah Surat Berhasil');
							redirect('surat/suratmasuk');
						} else {
							$this->session->set_flashdata('notif', 'Tambah Surat Gagal');
							redirect('surat/suratmasuk');
						}
						
					} else{
						$this->session->set_flashdata('notif', $this->upload->display_errors());
						redirect('surat/suratmasuk');
					}
				} else {
					$this->session->set_flashdata('notif', validation_errors());
					redirect('surat/suratmasuk');
				}
			}
		} else {
			redirect('login');
		}
	}

		public function tambah_suratkeluar()
	{
		if($this->session->userdata('logged_in') == TRUE) {
			if($this->session->userdata('nama_posisi') == 'Admin') {
				// $this->form_validation->set_rules('fieldname', 'fieldlabel', 'trim|required|min_length[5]|max_length[12]');
				$this->form_validation->set_rules('nomor_surat', 'nomor_surat', 'trim|required');
				$this->form_validation->set_rules('tgl_kirim', 'tgl_kirim', 'trim|required');
				$this->form_validation->set_rules('penerima', 'penerima', 'trim|required');
				$this->form_validation->set_rules('perihal', 'perihal', 'trim|required');

				if ($this->form_validation->run() == TRUE ) {
					$config['upload_path'] = './uploads/';
					$config['allowed_types'] = 'pdf|jpg|png';
					// $config['allowed_types'] = 'pdf|jpg|png';
					$config['max_size']  = 2000;
					
					$this->load->library('upload', $config);
					
					if ($this->upload->do_upload('file_surat')){

						if($this->surat_model->tambah_suratkeluar($this->upload->data()) == TRUE) {
							$this->session->flashdata('notif', 'Tambah Surat Berhasil');
							redirect('surat/suratkeluar');
						} else {
							$this->session->set_flashdata('notif', 'Tambah Surat Gagal');
							redirect('surat/suratkeluar');
						}
						
					} else{
						$this->session->set_flashdata('notif', $this->upload->display_errors());
						redirect('surat/suratkeluar');
					}
				} else {
					$this->session->set_flashdata('notif', validation_errors());
					redirect('surat/suratkeluar');
				}
			}
		} else {
			redirect('login');
		}
	}


	public function get_suratmasuk_byid($id_surat)
	{
		if($this->session->userdata('logged_in') == TRUE) {

			if($this->session->userdata('nama_posisi') == 'Admin') {

				$data_suratmasuk_byid = $this->surat_model->get_suratmasuk_byid($id_surat);

				echo json_encode($data_suratmasuk_byid);
			}
		} else {
			redirect('login');
		}
	}

	public function ubah_suratmasuk()
	{
		if($this->session->userdata('logged_in') == TRUE) {
			if($this->session->userdata('nama_posisi') == 'Admin') {
				$this->form_validation->set_rules('edit_nomor_surat', 'nomor_surat', 'trim|required');
				$this->form_validation->set_rules('edit_tgl_kirim', 'tgl_kirim', 'trim|required');
				$this->form_validation->set_rules('edit_tgl_terima', 'tgl_terima', 'trim|required');
				$this->form_validation->set_rules('edit_pengirim', 'pengirim', 'trim|required');
				$this->form_validation->set_rules('edit_penerima', 'penerima', 'trim|required');
				$this->form_validation->set_rules('edit_perihal', 'perihal', 'trim|required');

				if ($this->form_validation->run() == TRUE) {
					if($this->surat_model->ubah_suratmasuk() == TRUE) {
						$this->session->set_flashdata('notif', 'Ubah Surat Berhasil');
						redirect('surat/suratmasuk');
					} else {
						$this->session->set_flashdata('notif', 'Ubah Surat Gagal');
						redirect('surat/suratmasuk');
					}
				} else {
					$this->session->set_flashdata('notif', validation_errors());
					redirect('surat/suratmasuk');
				}
			}
		} else {
			redirect('login');
		}
	}

	public function ubah_file_suratmasuk()
	{
		if($this->session->userdata('logged_in') == TRUE) {
			if($this->session->userdata('nama_posisi') == 'Admin') {
				$config['upload_path'] = './uploads/';
				$config['allowed_types'] = 'pdf|jpg|png';
				$config['max_size']  = 2000;
				
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if ($this->upload->do_upload('edit_file_surat')){
					
					if($this->surat_model->ubah_file_suratmasuk($this->upload->data()) == TRUE) {
						$this->session->set_flashdata('notif', 'Ubah File Surat Berhasil');
						redirect('surat/suratmasuk');
					} else {
						$this->session->set_flashdata('notif', 'Ubah File Surat Gagal');
						redirect('surat/suratmasuk');
					}
				} else{
					$this->session->set_flashdata('notif', $this->upload->display_errors());
					redirect('surat/suratmasuk');
				}
			}
		} else {
			redirect('login');
		}
	}

	public function hapus_suratmasuk($id_surat)
	{
		if($this->session->userdata('logged_in') == TRUE) {
			$this->uri->segment(3);
			if($this->session->userdata('nama_posisi') == 'Admin') {
				if($this->surat_model->hapus_suratmasuk($id_surat) == TRUE) {
					$this->session->set_flashdata('notif', 'Hapus Surat Berhasil');
					redirect('surat/suratmasuk');
				} else {
					$this->session->set_flashdata('notif', 'Hapus Surat Gagal');
					redirect('surat/suratmasuk');
				}
			} else {

			}
		} else {
			redirect('login');
		}
	}

	public function hapus_suratkeluar($id_surat)
	{
		if($this->session->userdata('logged_in') == TRUE) {
			$this->uri->segment(3);
			if($this->session->userdata('nama_posisi') == 'Admin') {
				if($this->surat_model->hapus_suratkeluar($id_surat) == TRUE) {
					$this->session->set_flashdata('notif', 'Hapus Surat Berhasil');
					redirect('surat/suratkeluar');
				} else {
					$this->session->set_flashdata('notif', 'Hapus Surat Gagal');
					redirect('surat/suratkeluar');
				}
			} else {

			}
		} else {
			redirect('login');
		}
	}

	//DISPOSISI

	public function disposisi($id_surat)
	{
		if($this->session->userdata('logged_in') == TRUE){

			if($this->session->userdata('nama_posisi') == 'Admin'){

				//$data['main_view'] 			= 'admin/disposisi_sekretaris_view';
				$data['main_view'] 			= 'disposisi_admin_view';
				$data['data_surat']			= $this->surat_model->get_suratmasuk_byid($this->uri->segment(3));
				$data['drop_down_posisi']	= $this->surat_model->get_posisi();
				$data['data_disposisi']		= $this->surat_model->get_all_disposisi($id_surat);

				$this->load->view('template_view', $data);

			} else {
				//$data['main_view'] = 'pegawai/disposisi_masuk_view';
				$data['main_view'] 				= 'disposisi_masuk_view';
				$data['data_disposisi_masuk']		= $this->surat_model->get_all_disposisi_masuk($id_surat);
				$data['data_disposisi']		= $this->surat_model->get_all_disposisi($id_surat);
				$this->load->view('template_view', $data);
			}
		} else {
			redirect('login');
		}
	}

	public function tambah_disposisi()
	{
		if($this->session->userdata('logged_in') == TRUE){
			$this->form_validation->set_rules('tujuan_user', 'Tujuan Disposisi', 'trim|required');
			$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');

			if ($this->form_validation->run() == TRUE) {
				if($this->surat_model->tambah_disposisi($this->uri->segment(3)) == TRUE ){
					$this->session->set_flashdata('notif', 'Tambah Disposisi Berhasil');
					if($this->session->userdata('posisi') == 'Admin'){
						redirect('surat/disposisi/'.$this->uri->segment(3));
					} else {
						redirect('surat/disposisi/'.$this->uri->segment(3));
					}			
				} else {
					$this->session->set_flashdata('notif', 'Tambah Disposisi Gagal');
					if($this->session->userdata('posisi') == 'Admin'){
						redirect('surat/disposisi/'.$this->uri->segment(3));
					} else {
						redirect('surat/disposisi/'.$this->uri->segment(3));
					}		
				}
			} else {
				$this->session->set_flashdata('notif', validation_errors());
				if($this->session->userdata('posisi') == 'Admin'){
					redirect('surat/disposisi/'.$this->uri->segment(3));
				} else {
					redirect('surat/disposisi/'.$this->uri->segment(3));
				}			
			}
		} else {
			redirect('login');
		}
	}

	public function hapus_disposisi($id_surat,$id_disposisi)
	{
		if($this->session->userdata('logged_in') == TRUE){
			if($this->surat_model->hapus_disposisi($id_disposisi) == TRUE){
				$this->session->set_flashdata('notif', 'Hapus Disposisi Berhasil');
				redirect('surat/disposisi/'. $id_surat);
			} else {
				$this->session->set_flashdata('notif', 'Hapus Disposisi Gagal');
				redirect('surat/disposisi/'.$id_surat);
			}
		} else {
			redirect('login');
		}
	}

	public function hapus_disposisi_keluar($id_surat,$id_disposisi)
	{
		if($this->session->userdata('logged_in') == TRUE){
			if($this->surat_model->hapus_disposisi($id_disposisi) == TRUE){
				$this->session->set_flashdata('notif', 'Hapus Disposisi Berhasil');
				redirect('surat/disposisi_keluar/'. $id_surat);
			} else {
				$this->session->set_flashdata('notif', 'Hapus Disposisi Gagal');
				redirect('surat/disposisi/'.$id_surat);
			}
		} else {
			redirect('login');
		}
	}

	// public function hapus_disposisi($id_surat,$id_disposisi)
	// {
	// 	if($this->session->userdata('logged_in')==TRUE){

	// 		if($this->session->userdata('posisi')=='Admin'){

	// 			if($this->surat_model->hapus_disposisi($id_disposisi)==TRUE){

	// 				$this->session->set_flashdata('notif', 'Hapus Surat Berhasil');
	// 				// $data['main_view'] = 'disposisi_view';
	// 				// $data['data_disposisi'] = $this->surat_model->get_all_disposisi($id_surat);

	// 				// $this->load->view('template_view', $data);
	// 				redirect('surat/disposisi','refresh');

	// 			} else{
	// 				$this->session->set_flashdata('notif', 'Hapus GAGAL');
	// 				redirect('surat/disposisi');
	// 			}
	// 		} else{

	// 		}
	// 	} else{
	// 		redirect('login');
	// 	}
	// }

	public function get_user_byposisi($id_posisi)
	{
		if($this->session->userdata('logged_in') == TRUE){
			$data_user = $this->surat_model->get_user_byposisi($id_posisi);

			echo json_encode($data_user);

		} else {
			redirect('login');
		}
	}

	public function get_disposisi_byid($id_disposisi)
	{
		if($this->session->userdata('logged_in') == TRUE){
			$data_disposisi = $this->surat_model->get_disposisi_byid($id_disposisi);

			echo json_encode($data_disposisi);

		} else {
			redirect('login');
		}
	}

	//DISPOSISI KELUAR 
	public function disposisi_keluar($id_surat)
	{
		if($this->session->userdata('logged_in') == TRUE){
			$data['data_disposisi']		= $this->surat_model->get_all_disposisi_keluar($this->session->userdata('id_user'));
			$data['data_surat']			= $this->surat_model->get_suratmasuk_byid($id_surat);
			$data['drop_down_posisi']	= $this->surat_model->get_posisi();
			$data['main_view']			= 'disposisi_keluar_view';
			$this->load->view('template_view', $data);
		} else {
			redirect('login');
		}
	}

	public function tambah_disposisi_keluar()
	{
		if($this->session->userdata('logged_in') == TRUE){
			$this->form_validation->set_rules('tujuan_user', 'Tujuan Disposisi', 'trim|required');
			$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');

			if ($this->form_validation->run() == TRUE) {
				if($this->surat_model->tambah_disposisi_keluar($this->uri->segment(3)) == TRUE ){
					$this->session->set_flashdata('notif', 'Tambah Disposisi Berhasil');
					if($this->session->userdata('posisi') == 'Admin'){
						redirect('surat/disposisi/'.$this->uri->segment(3));
					} else {
						redirect('surat/disposisi_keluar/'.$this->uri->segment(3));
					}			
				} else {
					$this->session->set_flashdata('notif', 'Tambah Disposisi Gagal');
					if($this->session->userdata('posisi') == 'Admin'){
						redirect('surat/disposisi/'.$this->uri->segment(3));
					} else {
						redirect('surat/disposisi_keluar/'.$this->uri->segment(3));
					}		
				}
			} else {
				$this->session->set_flashdata('notif', validation_errors());
				if($this->session->userdata('posisi') == 'Admin'){
					redirect('surat/disposisi/'.$this->uri->segment(3));
				} else {
					redirect('surat/disposisi_keluar/'.$this->uri->segment(3));
				}			
			}
		} else {
			redirect('login');
		}
	}

	// public function hapus_disposisi_keluar()
	// {
	// 	if($this->session->userdata('logged_in') == TRUE){
	// 		if($this->surat_model->hapus_disposisi_keluar($id_disposisi) == TRUE){
	// 			$this->session->set_flashdata('notif', 'Hapus Disposisi Berhasil');
	// 			redirect('surat/disposisi_keluar');
	// 		} else {
	// 			$this->session->set_flashdata('notif', 'Hapus Disposisi Gagal');
	// 			redirect('surat/disposisi_keluar');
	// 		}

	// 	} else {
	// 		redirect('login');
	// 	}
	// }


}

/* End of file surat.php */
/* Location: ./application/controllers/surat.php */