<?php defined('BASEPATH') OR exit('No direct script access allowed');
class M_Registrasi extends CI_Model {

	protected $mahasiswa = "ak_data_master_mahasiswa";
	protected $user = "ak_data_user";

	public function get_id($format = 'u', $utimestamp = null) {
		if (is_null($utimestamp)) {
			$utimestamp = microtime(true);  
		}
		$timestamp = floor($utimestamp);
		$milliseconds = round(($utimestamp - $timestamp) * 1000000);
		return date(preg_replace('`(?<!\\\\)u`', $milliseconds, $format),$timestamp);
	}

	public function cek_nim() {
		return $this->db->where(
			'mahasiswa_nim',$this->input->post('mahasiswa_nim')
		)->get($this->mahasiswa)->num_rows();
	}

	public function cek_email() {
		return $this->db->where(
			'user_login',$this->input->post('user_login')
		)->get($this->user)->num_rows();
	}

	public function update_mahasiswa($data) {
		return $this->db->where(
			'mahasiswa_nim',$this->input->post('mahasiswa_nim')
		)->update($this->mahasiswa,$data);
	}

	public function simpan_user($data) { return $this->db->insert($this->user,$data); }

}