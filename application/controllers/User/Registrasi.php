<?php class Registrasi extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$isLogin = $this->session->userdata('LoggedIn');
		if($isLogin) {
			redirect('user/dashboard');
		} else {
			$this->load->model('User/M_Portal','a');
			$this->load->model('User/M_Registrasi','m');
		}
	}

	public function index() {
		$data['Title'] = "Mahasiswa";
		$data['Instansi'] = $this->a->get_instansi();
		$data['Info'] = $this->a->get_app_info();
		$this->load->view('user/v_registrasi',$data);
	}

	public function simpan() {
		$cek_nim = $this->m->cek_nim();
		$cek_email = $this->m->cek_email();
		if($cek_nim>0) {
			if($cek_email==0) {
				$user_id = $this->m->get_id();
				$user = array(
					'user_id' => $user_id,
					'level_id' => 'LVL19011700003',
					'user_nama' => $this->input->post('mahasiswa_nama'),
					'user_login' => $this->input->post('mahasiswa_email'),
					'user_pass' => password_hash($user_id, PASSWORD_BCRYPT)
				);
				$this->m->simpan_user($user);
				$data = array(
					'mahasiswa_id' => $user_id,
					'user_id' => $user_id,
					'mahasiswa_nim' => $this->input->post('mahasiswa_nim'),
					'mahasiswa_nama' => $this->input->post('mahasiswa_nama'),
					'mahasiswa_email' => $this->input->post('mahasiswa_email'),
					'mahasiswa_alamat' => $this->input->post('mahasiswa_alamat'),
					'mahasiswa_kontak' => $this->input->post('mahasiswa_kontak'),
					'created_by' => "REGISTRATION"
				);
				$res = $this->m->simpan($data);
				$pesan = array(
					'warning' => 'Berhasil!',
					'kode' => 'success',
					'pesan' => 'Data berhasil di simpan. Silahkan login menggunakan username : '.$this->input->post('mahasiswa_email').' dan password : '.$user_id.'.'
				);
			} else {
				$pesan = array(
					'warning' => 'Gagal!',
					'kode' => 'error',
					'pesan' => 'Email tersebut sudah digunakan!'
				);
			}
		} else {
			$pesan = array(
				'warning' => 'Gagal!',
				'kode' => 'error',
				'pesan' => 'Nim anda belum terdaftar!'
			);
		}
		echo json_encode($pesan);
	}

}