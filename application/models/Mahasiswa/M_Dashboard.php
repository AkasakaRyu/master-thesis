<?php defined('BASEPATH') OR exit('No direct script access allowed');
class M_Dashboard extends CI_Model {

	protected $mahasiswa = "ak_data_master_mahasiswa";
	protected $user = "ak_data_user";
	
	public function get_list_data() {
		if($this->session->userdata('access')=="LVL19011700003") {
			return $this->db->where(
				$this->mahasiswa.'.deleted',false
			)->where(
				$this->mahasiswa.'.user_id',$this->session->userdata('id')
			)->get($this->mahasiswa)->result();
		} else {
			return $this->db->where(
				$this->mahasiswa.'.deleted',false
			)->get($this->mahasiswa)->result();
		}
	}

	public function get_data() {
		return $this->db->where(
			'mahasiswa_id',$this->input->post('mahasiswa_id')
		)->get($this->mahasiswa)->row();
	}

	public function get_mahasiswa() {
		return $this->db->where(
			'user_id',$this->input->post('user_id')
		)->get($this->mahasiswa)->row();
	}

	public function get_id() {
		$res = $this->db->get($this->mahasiswa)->num_rows();
		return "MHS".date('ymd').str_pad($res+1, 4, "0", STR_PAD_LEFT);
	}

	public function simpan($data) { return $this->db->insert($this->mahasiswa,$data); }

	public function ganti_password($data) {
		return $this->db->where(
			'user_id', $this->input->post('user_id')
		)->update($this->user,$data);
	}

	public function edit($data) {
		return $this->db->where(
			'mahasiswa_id', $this->input->post('mahasiswa_id')
		)->update($this->mahasiswa,$data);
	}

	public function hapus($data) {
		return $this->db->where(
			'mahasiswa_id', $this->input->post('mahasiswa_id')
		)->update($this->mahasiswa,$data);
	}

	public function options() {
		$res = $this->db->select(
			"user_id as id,user_id as value,mahasiswa_nama as text"
		)->where(
			'deleted', FALSE
		)->get($this->mahasiswa)->result();
		return $res;
	}

}