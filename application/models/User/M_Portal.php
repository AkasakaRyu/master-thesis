<?php class M_Portal extends CI_Model {

	protected $user = "ak_data_user";
	protected $level = "ak_data_user_level";
	protected $info = "ak_data_sistem_app_info";
	protected $instansi = "ak_data_sistem_instansi";

	protected function verify_password($password,$hash) {
		return password_verify($password,$hash);
	}

	public function get_instansi() {
		return $this->db->get($this->instansi)->row();
	}

	public function get_app_info() {
		return $this->db->get($this->info)->row();
	}

	public function record_chance() {
		$kesempatan = $this->session->userdata('kesempatan');
		$kesempatan++;
		$this->session->set_userdata('kesempatan',$kesempatan);
		if($kesempatan>=3) {
			$kesempatan = 0;
			$this->session->set_tempdata('penalty', true, 300);
			$this->session->set_userdata('kesempatan',$kesempatan);
		}
	}

	public function cek_validasi_akun() {
		return $this->db->where(
			'user_login',$this->input->post('user_login')
		)->where(
			'deleted',FALSE
		)->get($this->user)->num_rows();
	}

	public function cek_validasi_password() {
		$username = $this->input->post('user_login');
		$password = $this->input->post('user_pass');
		$hash = $this->db->where(
			'user_login',$username
		)->get($this->user)->row('user_pass');
		return $this->verify_password($password,$hash);
	}

	public function get_akun() {
		return $this->db->where(
			'user_login',$this->input->post('user_login')
		)->join(
			$this->level,
			$this->level.'.level_id='.
			$this->user.'.level_id'
		)->get($this->user)->row();
	}

	public function update_last_login($user) {
		$data = array(
			'last_login' => date('Y-m-d H:i:s')
		);
		return $this->db->where(
			'user_id',$user
		)->update($this->user,$data);
	}

}