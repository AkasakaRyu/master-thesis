<?php defined('BASEPATH') OR exit('No direct script access allowed');
class M_Dashboard extends CI_Model {

	protected $mahasiswa = "ak_data_master_mahasiswa";
	protected $user = "ak_data_user";
	
	public function get_list_data() {
		if($this->session->userdata('level')=="Mahasiswa") {
			return $this->db->where(
				$this->mahasiswa.'.deleted',false
			)->where(
				$this->mahasiswa.'.mahasiswa_id',$this->session->userdata('id')
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

	public function get_id() {
		$res = $this->db->get($this->mahasiswa)->num_rows();
		return "DOS".date('ymd').str_pad($res+1, 4, "0", STR_PAD_LEFT);
	}

	public function get_user_id() {
		$res = $this->db->get($this->user)->num_rows();
		return "USR".str_pad($res+1, 3, "0", STR_PAD_LEFT);
	}

	public function simpan($data) { return $this->db->insert($this->mahasiswa,$data); }

	public function simpan_user($data) { return $this->db->insert($this->user,$data); }

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
			"mahasiswa_id as id,mahasiswa_id as value,mahasiswa_nama as text"
		)->where(
			'deleted', FALSE
		)->get($this->mahasiswa)->result();
		return $res;
	}

}