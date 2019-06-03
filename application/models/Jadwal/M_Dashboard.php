<?php defined('BASEPATH') OR exit('No direct script access allowed');
class M_Dashboard extends CI_Model {

	protected $jadwal = "ak_data_jadwal";
	protected $dosen = "ak_data_master_dosen";
	protected $mahasiswa = "ak_data_master_mahasiswa";
	
	public function get_list_data() {
		if($this->session->userdata('access')!="LVL19011700003") {
			return $this->db->where(
				$this->jadwal.'.deleted',false
			)->join(
				$this->dosen,
				$this->dosen.'.dosen_id='.
				$this->jadwal.'.dosen_id'
			)->join(
				$this->mahasiswa,
				$this->mahasiswa.'.user_id='.
				$this->jadwal.'.mahasiswa_id'
			)->get($this->jadwal)->result();
		} else {
			return $this->db->where(
				$this->jadwal.'.deleted',false
			)->join(
				$this->dosen,
				$this->dosen.'.dosen_id='.
				$this->jadwal.'.dosen_id'
			)->join(
				$this->mahasiswa,
				$this->mahasiswa.'.user_id='.
				$this->jadwal.'.mahasiswa_id'
			)->where(
				$this->mahasiswa.'.user_id',$this->session->userdata('id')
			)->get($this->jadwal)->result();
		}
	}

	public function get_data() {
		return $this->db->where(
			'jadwal_id',$this->input->post('jadwal_id')
		)->get($this->jadwal)->row();
	}

	public function get_id() {
		$res = $this->db->get($this->jadwal)->num_rows();
		return "JDW".date('ymd').str_pad($res+1, 4, "0", STR_PAD_LEFT);
	}

	public function simpan($data) { return $this->db->insert($this->jadwal,$data); }

	public function get_mahasiswa() {
		return $this->db->where(
			'user_id',$this->input->post('mahasiswa_id')
		)->get($this->mahasiswa)->row();
	}

	public function get_dosen() {
		return $this->db->where(
			'dosen_id',$this->input->post('dosen_id')
		)->get($this->dosen)->row();
	}

	public function edit($data) {
		return $this->db->where(
			'jadwal_id', $this->input->post('jadwal_id')
		)->update($this->jadwal,$data);
	}

	public function hapus($data) {
		return $this->db->where(
			'jadwal_id', $this->input->post('jadwal_id')
		)->update($this->jadwal,$data);
	}

	public function options() {
		$res = $this->db->select(
			"jadwal_id as id,jadwal_id as value,jadwal_nama as text"
		)->where(
			'deleted', FALSE
		)->get($this->jadwal)->result();
		return $res;
	}

}