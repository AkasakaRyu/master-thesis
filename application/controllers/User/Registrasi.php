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
					'user_id' => $user_id,
					'created_by' => "REGISTRATION"
				);
				$res = $this->m->update_mahasiswa($data);
				$email = "
					Hello, ".$this->input->post('mahasiswa_nama')."<br /><br />
					Congratulations, your account has been confirmed and you have the right access to the system. Here's the details of your account : <br />
					----------------------------------------------------------- <br />
					<table>
						<tr><td>Username</td><td>:</td><td><b>".$this->input->post('mahasiswa_email')."</b></td></tr>
						<tr><td>Password</td><td>:</td><td><b>".$user_id."</b></td></tr>
					</table>
					-----------------------------------------------------------<br />
					Please click this <a href='https://thesis.kodepanda.id/portal?email=".$this->input->post('mahasiswa_email')."'>link</a>. To access the systems.<br /><br />
					Regards,
					<br />
					<br />
					University.<br />
				";
				$this->load->library('email');
				//config nih
				$config['protocol']    = 'smtp';
				$config['smtp_host']    = 'ssl://mail.kodepanda.id';
				$config['smtp_port']    = '465';
				$config['smtp_timeout'] = '10';
				$config['smtp_user']    = 'webmaster@kodepanda.id';
				$config['smtp_pass']    = 'older45.,';
				$config['charset']    = 'utf-8';
				$config['newline']    = "\r\n";
				$config['mailtype'] = 'html';
				$config['validation'] = TRUE;
				$this->email->initialize($config);
				$this->email->from('webmaster@kodepanda.id', 'Thesis Kodepanda');
				$this->email->to($this->input->post('mahasiswa_email'));
				$this->email->subject('Detail Akun Mahasiswa');
				$this->email->message($email);
				$this->email->send();
				$pesan = array(
					'warning' => 'Hooray!',
					'kode' => 'success',
					'pesan' => 'Registration successful! please check email!'
				);
			} else {
				$pesan = array(
					'warning' => 'Oh, Craps!',
					'kode' => 'error',
					'pesan' => 'The email has already been used!'
				);
			}
		} else {
			$pesan = array(
				'warning' => 'Oh, Craps!',
				'kode' => 'error',
				'pesan' => 'Your Nim is not registered yet!'
			);
		}
		echo json_encode($pesan);
	}

}