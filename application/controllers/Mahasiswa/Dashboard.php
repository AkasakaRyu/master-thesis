<?php
class Dashboard extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$isLogin = $this->session->userdata('LoggedIn');
		$access = $this->session->userdata('access');
		if($isLogin) {
			$this->load->model('Mahasiswa/M_Dashboard','m');
		} else {
			redirect('portal');
		}
	}

	public function index() {
		$data["Title"] = "Students";
		$data["Konten"] = "mahasiswa/v_dashboard";
		$this->load->view("v_master",$data);
	}

	public function list_data() {
		$list = $this->m->get_list_data();
		$datatb = array();
		foreach($list as $data) {
			$row = array();
			$row[] = $data->mahasiswa_nim;
			$row[] = $data->mahasiswa_nama;
			$row[] = $data->mahasiswa_email;
			$row[] = $data->mahasiswa_alamat;
			$row[] = $data->mahasiswa_kontak;
			if($this->session->userdata('access')=="LVL19011700003") {
				$row[] = "<button id='edit' data='".$data->mahasiswa_id."' class='btn btn-sm btn-warning'><i class='fa fa-pencil-alt'></i></button> | <button id='pass' class='btn btn-sm btn-info' data='".$data->mahasiswa_id."'><i class='fa fa-key'></i></button>";
			} else {
				$row[] = "<button id='edit' data='".$data->mahasiswa_id."' class='btn btn-sm btn-warning'><i class='fa fa-pencil-alt'></i></button> | 
				<button id='hapus' class='btn btn-sm btn-danger' data='".$data->mahasiswa_id."'><i class='fa fa-trash-alt'></i></button> | <button id='pass' class='btn btn-sm btn-info' data='".$data->mahasiswa_id."'><i class='fa fa-key'></i></button>";
			}
			$datatb[] = $row;
		}
		$output = array(
			"draw" => $this->input->post('draw'),
			"data" => $datatb
		);
		echo json_encode($output);
	}

	public function get_data() {
		$res = $this->m->get_data();
		$data = array(
			'mahasiswa_id' => $res->mahasiswa_id,
			'user_id' => $res->user_id,
			'mahasiswa_nim' => $res->mahasiswa_nim,
			'mahasiswa_nama' => $res->mahasiswa_nama,
			'mahasiswa_email' => $res->mahasiswa_email,
			'mahasiswa_alamat' => $res->mahasiswa_alamat,
			'mahasiswa_kontak' => $res->mahasiswa_kontak
		);
		echo json_encode($data);
	}

	public function simpan() {
		$mahasiswa_id = $this->input->post('mahasiswa_id');
		$user_id = $this->input->post('mahasiswa_nim');
		if($mahasiswa_id=="") {
			$data = array(
				'mahasiswa_id' => $this->m->get_id(),
				'user_id' => $user_id,
				'mahasiswa_nim' => $this->input->post('mahasiswa_nim'),
				'mahasiswa_nama' => $this->input->post('mahasiswa_nama'),
				'mahasiswa_email' => $this->input->post('mahasiswa_email'),
				'mahasiswa_alamat' => $this->input->post('mahasiswa_alamat'),
				'mahasiswa_kontak' => $this->input->post('mahasiswa_kontak'),
				'created_by' => $this->session->userdata('nama')
			);
			$res = $this->m->simpan($data);
			$pesan = array(
				'warning' => 'It Works',
				'kode' => 'success',
				'pesan' => 'Student data saved successfully'
			);
		} else {
			$data = array( 
				'mahasiswa_nim' => $this->input->post('mahasiswa_nim'),
				'mahasiswa_nama' => $this->input->post('mahasiswa_nama'),
				'mahasiswa_email' => $this->input->post('mahasiswa_email'),
				'mahasiswa_alamat' => $this->input->post('mahasiswa_alamat'),
				'mahasiswa_kontak' => $this->input->post('mahasiswa_kontak'),
				'updated_by' => $this->session->userdata('nama'),
				'last_update' => date('Y-m-d H:i:s')
			);
			$res = $this->m->edit($data);
			$pesan = array(
				'warning' => 'It Works',
				'kode' => 'success',
				'pesan' => 'Student data successfully updated'
			);
		}
		echo json_encode($pesan);
	}

	public function ganti_password() {
		$data = array(
			'user_pass' => password_hash($this->input->post('user_pass'), PASSWORD_BCRYPT)
		);
		$this->m->ganti_password($data);
		$mahasiswa = $this->m->get_mahasiswa();
		$email = "
			Hello, ".$mahasiswa->mahasiswa_nama."<br /><br />
			Your password has been changed on ".date('Y-m-d H:i:s')."<br /><br />
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
		$this->email->to($mahasiswa->mahasiswa_email);
		$this->email->subject('Notice of new password change');
		$this->email->message($email);
		$this->email->send();
		$pesan = array(
			'warning' => 'It Works',
			'kode' => 'success',
			'pesan' => 'Student password successfully updated'
		);
		echo json_encode($pesan);
	}

	public function hapus() {
		$data = array( 
			'updated_by' => $this->session->userdata('nama'),
			'last_update' => date('Y-m-d H:i:s'),
			'deleted' => TRUE 
		);
		$this->m->hapus($data);
		$pesan = array(
			'warning' => 'It Works',
			'kode' => 'success',
			'pesan' => 'Student data was successfully deleted'
		);
		echo json_encode($pesan);
	}

	public function options() {
		$res = $this->m->options();
		echo json_encode($res);
	}

}