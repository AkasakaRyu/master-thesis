<?php defined('BASEPATH') OR exit('No direct script access allowed');
class M_Dashboard extends CI_Model {

	protected $thesis = "ak_data_thesis";
	protected $kata = "ak_data_thesis_kata";
	
	public function get_list_data() {
		return $this->db->where(
			$this->thesis.'.deleted',false
		)->get($this->thesis)->result();
	}

	public function get_data() {
		return $this->db->where(
			'thesis_id',$this->input->post('thesis_id')
		)->get($this->thesis)->row();
	}

	public function get_id() {
		$res = $this->db->get($this->thesis)->num_rows();
		return "THE".date('ymd').str_pad($res+1, 4, "0", STR_PAD_LEFT);
	}

	public function simpan($data) { return $this->db->insert($this->thesis,$data); }

	public function get_title_words() { 
		return $this->db->where(
			'kata_input','Judul'
		)->get($this->kata)->row(); 
	}

	public function get_summary_words() { 
		return $this->db->where(
			'kata_input','Rumusan'
		)->get($this->kata)->row(); 
	}

	public function get_theory_words() { 
		return $this->db->where(
			'kata_input','Rumusan'
		)->get($this->kata)->row(); 
	}

	public function edit($data) {
		return $this->db->where(
			'thesis_id', $this->input->post('thesis_id')
		)->update($this->thesis,$data);
	}

	public function hapus($data) {
		return $this->db->where(
			'thesis_id', $this->input->post('thesis_id')
		)->update($this->thesis,$data);
	}

	public function options() {
		$res = $this->db->select(
			"thesis_id as id,thesis_id as value,thesis_nama as text"
		)->where(
			'deleted', FALSE
		)->get($this->thesis)->result();
		return $res;
	}

}