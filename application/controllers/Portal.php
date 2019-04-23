<?php class portal extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$isLogin = $this->session->userdata('LoggedIn');
		if($isLogin) {
			redirect('user/dashboard');
		} else {
			$this->load->model('User/M_Portal','a');
		}
	}

	public function index() {
		$data['Title'] = "Portal";
		$data['Instansi'] = $this->a->get_instansi();
		$data['Info'] = $this->a->get_app_info();
		$this->load->view('user/v_portal',$data);
	}

	public function login_proses() {
		$rekam_kesempatan = $this->a->record_chance();
		$is_secure = $this->session->tempdata('penalty');
		if(!$is_secure) {
			$is_valid_account = $this->a->cek_validasi_akun();
			if($is_valid_account) {
				$is_valid_password = $this->a->cek_validasi_password();
				if($is_valid_password) {
					$data_akun = $this->a->get_akun();
					$data_sistem = $this->a->get_app_info();
					if($data_akun->last_login!="") {
						$last = $data_akun->last_login;
					} else {
						$last = "Baru Masuk";
					}
					$data_session = array(
						'id' => $data_akun->user_id,
						'level' => $data_akun->level_nama,
						'nama' => $data_akun->user_nama,
						'last_login' => $last,
						'created_date' => $data_akun->created_date,
						'sistem_name' => $data_sistem->app_info_name,
						'LoggedIn' => TRUE
					);
					$this->a->update_last_login($data_akun->user_id);
					$this->session->set_userdata($data_session);
					$pesan = array(
						'warning' => 'Akses Diterima!',
						'kode' => 'success',
						'pesan' => 'Berhasil masuk ke dalam sistem! Hallo, '.$this->session->userdata('nama')
					);
				} else {
					$pesan = array(
						'warning' => 'Akses Ditolak!',
						'kode' => 'error',
						'pesan' => 'Kata sandi tidak tepat!'
					);
					$rekam_kesempatan;
				}
			} else {
				$pesan = array(
					'warning' => 'Akses Ditolak!',
					'kode' => 'error',
					'pesan' => 'Akun tidak ditemukan!'
				);
				$rekam_kesempatan;
			}
		} else {
			$pesan = array(
				'warning' => 'Akses Ditolak!',
				'kode' => 'error',
				'pesan' => 'Terlalu banyak percobaan gagal! Akun anda terkunci sementara!'
			);
			$rekam_kesempatan;
		}
		echo json_encode($pesan);
	}

}