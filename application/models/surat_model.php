<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surat_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function get_suratmasuk()
	{
		return $this->db->get('suratmasuk')
						->result();
	}

		public function get_suratkeluar()
	{
		return $this->db->get('suratkeluar')
						->result();
	}

	public function tambah_suratmasuk($file_surat)
	{
		$data = array(
			'nomor_surat'	=> $this->input->post('nomor_surat'),
			'tgl_kirim'		=> $this->input->post('tgl_kirim'),
			'tgl_terima'	=> $this->input->post('tgl_terima'),
			'pengirim'		=> $this->input->post('pengirim'),
			'penerima'		=> $this->input->post('penerima'),
			'perihal'		=> $this->input->post('perihal'),
			'file_surat'	=> $file_surat['file_name']
		);

		$this->db->insert('suratmasuk', $data);
		if($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function tambah_suratkeluar($file_surat)
	{
		$data = array(
			'nomor_surat'	=> $this->input->post('nomor_surat'),
			'tgl_kirim'		=> $this->input->post('tgl_kirim'),
			'penerima'		=> $this->input->post('penerima'),
			'perihal'		=> $this->input->post('perihal'),
			'file_surat'	=> $file_surat['file_name']
		);

		$this->db->insert('suratkeluar', $data);
		if($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function get_suratmasuk_byid($id_surat)
	{
		return $this->db->where('id_surat', $id_surat)
						->get('suratmasuk')
						->row();
	}

	public function ubah_suratmasuk()
	{
		$data = array(
			'nomor_surat'	=> $this->input->post('edit_nomor_surat'),
			'tgl_kirim'		=> $this->input->post('edit_tgl_kirim'),
			'tgl_terima'	=> $this->input->post('edit_tgl_terima'),
			'pengirim'		=> $this->input->post('edit_pengirim'),
			'penerima'		=> $this->input->post('edit_penerima'),
			'perihal'		=> $this->input->post('edit_perihal'),
		);

		$this->db->where('id_surat', $this->input->post('edit_id_surat'))
				 ->update('suratmasuk', $data);

		if($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function ubah_file_suratmasuk($file_surat)			
	{
		$data = array(
			'file_surat' => $file_surat['file_name']
		);

		$this->db->where('id_surat', $this->input->post('edit_id_surat'))
				 ->update('suratmasuk', $data);

		if($this->db->affected_rows() > 0){
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function hapus_suratmasuk($id_surat)
	{
		$this->db->where('id_surat', $id_surat)
				 ->delete('suratmasuk');

		if($this->db->affected_rows() > 0){
			return TRUE;
		} else {
			return FALSE;
		}
	}

		public function hapus_suratkeluar($id_surat)
	{
		$this->db->where('id_surat', $id_surat)
				 ->delete('suratkeluar');

		if($this->db->affected_rows() > 0){
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function get_datadashboard()
	{
		$suratmasuk = $this->db->select('count(*) as total_suratmasuk')
							   ->get('suratmasuk')
							   ->row();
		$suratkeluar = $this->db->select('count(*) as total_suratkeluar')
							   ->get('suratkeluar')
							   ->row();
		$disposisi = $this->db->select('count(*) as total_disposisi')
							   ->get('disposisi')
							   ->row();

		return array(
			'suratmasuk' => $suratmasuk->total_suratmasuk,
			'suratkeluar' => $suratkeluar->total_suratkeluar,
			'disposisi' => $disposisi->total_disposisi
			);
	}

	//DISPOSISI
	public function get_all_disposisi($id_surat)
	{
		return $this->db->join('disposisi', 'disposisi.id_surat = suratmasuk.id_surat')
						->join('posisi', 'disposisi.id_user_pengirim =posisi.id_posisi')
						->join('user', 'user.id_user = disposisi.id_user_penerima')
						->where('disposisi.id_surat', $id_surat)
						->get('suratmasuk')
						->result();
	}

	public function get_all_disposisi_masuk($id_user_penerima)
	{
		return $this->db->join('disposisi', 'disposisi.id_surat = suratmasuk.id_surat')
						->join('user', 'disposisi.id_user_pengirim = user.id_user')
						->join('posisi', 'posisi.id_posisi = user.id_posisi')
						->where('id_user_penerima', $id_user_penerima)
						->get('suratmasuk')
						->result();
	}

	public function get_all_disposisi_keluar($id_user_pengirim)
	{
		return $this->db->join('disposisi', 'disposisi.id_surat = suratmasuk.id_surat')
						->join('user', 'disposisi.id_user_penerima = user.id_user')
						->join('posisi', 'posisi.id_posisi = user.id_posisi')
						->where('disposisi.id_user_pengirim', $this->session->userdata('id_user'))
						->where('disposisi.id_surat', $this->uri->segment(3))
						->get('suratmasuk')
						->result();
	}

	public function get_posisi()
	{
		return $this->db->get('posisi')
						->result();
	}

	public function get_user_byposisi($id_posisi)
	{
		return $this->db->where('id_posisi', $id_posisi)
						->get('user')
						->result();
	}

	public function tambah_disposisi($id_surat)
	{
		$data = array(
			'id_surat'				=> $id_surat,
			'id_user_pengirim'		=> $this->session->userdata('id_user'),
			'id_user_penerima'		=> $this->input->post('tujuan_user'),
			'keterangan'			=> $this->input->post('keterangan')
		);

		$this->db->insert('disposisi', $data);

		if($this->db->affected_rows() > 0){
			return TRUE;
		} else {
			return FALSE;
		}	
	}

	public function tambah_disposisi_keluar($id_surat)
	{
		$data = array(
			'id_surat'				=> $id_surat,
			'id_user_pengirim'		=> $this->session->userdata('id_user'),
			'id_user_penerima'		=> $this->input->post('tujuan_user'),
			'keterangan'			=> $this->input->post('keterangan')
		);

		$this->db->insert('disposisi', $data);

		if($this->db->affected_rows() > 0){
			return TRUE;
		} else {
			return FALSE;
		}	
	}


	public function hapus_disposisi($id_disposisi)
	{
		$this->db->where('id_disposisi', $id_disposisi)
				 ->delete('disposisi');

		if($this->db->affected_rows() > 0){
			return TRUE;
		} else {
			return FALSE;
		}
	}



}

/* End of file surat_model.php */
/* Location: ./application/models/surat_model.php */