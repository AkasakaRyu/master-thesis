<?php defined('BASEPATH') OR exit('No direct script access allowed');
class M_Dashboard extends CI_Model {

	protected $dosen = "ak_data_master_dosen";
	
	public function get_list_data() {
		return $this->db->where(
			$this->dosen.'.deleted',false
		)->get($this->dosen)->result();
	}

	public function get_data() {
		return $this->db->where(
			'dosen_id',$this->input->post('dosen_id')
		)->get($this->dosen)->row();
	}

	public function get_id() {
		$res = $this->db->get($this->dosen)->num_rows();
		return "DOS".date('ymd').str_pad($res+1, 4, "0", STR_PAD_LEFT);
	}

	public function simpan($data) { return $this->db->insert($this->dosen,$data); }

	public function edit($data) {
		return $this->db->where(
			'dosen_id', $this->input->post('dosen_id')
		)->update($this->dosen,$data);
	}

	public function hapus($data) {
		return $this->db->where(
			'dosen_id', $this->input->post('dosen_id')
		)->update($this->dosen,$data);
	}

	public function options() {
		$res = $this->db->select(
			"dosen_id as id,dosen_id as value,dosen_nama as text,dosen_kuota as kuota"
		)->where(
			'deleted', FALSE
		)->get($this->dosen)->result();
		return $res;
	}

}