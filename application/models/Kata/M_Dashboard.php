<?php defined('BASEPATH') OR exit('No direct script access allowed');
class M_Dashboard extends CI_Model {

	protected $kata = "ak_data_thesis_kata";
	
	public function get_list_data() {
		return $this->db->where(
			$this->kata.'.deleted',false
		)->get($this->kata)->result();
	}

	public function get_data() {
		return $this->db->where(
			'kata_id',$this->input->post('kata_id')
		)->get($this->kata)->row();
	}

	public function get_id() {
		$res = $this->db->get($this->kata)->num_rows();
		return "WORD".date('ymd').str_pad($res+1, 4, "0", STR_PAD_LEFT);
	}

	public function simpan($data) { return $this->db->insert($this->kata,$data); }

	public function edit($data) {
		return $this->db->where(
			'kata_id', $this->input->post('kata_id')
		)->update($this->kata,$data);
	}

	public function hapus($data) {
		return $this->db->where(
			'kata_id', $this->input->post('kata_id')
		)->update($this->kata,$data);
	}

	public function options() {
		$res = $this->db->select(
			"kata_id as id,kata_id as value,kata_nama as text"
		)->where(
			'deleted', FALSE
		)->get($this->kata)->result();
		return $res;
	}

}