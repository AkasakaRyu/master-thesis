<?php
class Dashboard extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$isLogin = $this->session->userdata('LoggedIn');
		if($isLogin) {
			$level = $this->session->userdata('level');
			if($level=="Master") {
				$this->load->model('Mahasiswa/M_Dashboard','m');
			}
		} else {
			redirect('portal');
		}
	}

	public function index() {
		$data["Title"] = "Mahasiswa";
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
			$row[] = "<button id='edit' data='".$data->mahasiswa_id."' class='btn btn-xs btn-warning'><i class='fa fa-pencil-alt'></i></button> | 
			<button id='hapus' class='btn btn-xs btn-danger' data='".$data->mahasiswa_id."'><i class='fa fa-trash-alt'></i></a>";
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
		$user_id = $this->m->get_user_id();
		if($mahasiswa_id=="") {
			$user = array(
				'user_id' => $user_id,
				'level_id' => 'LVL19011700003',
				'user_nama' => $this->input->post('mahasiswa_nama'),
				'user_login' => $this->input->post('mahasiswa_email'),
				'user_pass' => password_hash($user_id, PASSWORD_BCRYPT)
			);
			$this->m->simpan_user($user);
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
				'warning' => 'Berhasil!',
				'kode' => 'success',
				'pesan' => 'Data mahasiswa '.$this->input->post('mahasiswa_nama').' berhasil di simpan'
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
				'warning' => 'Berhasil!',
				'kode' => 'success',
				'pesan' => 'Data mahasiswa '.$this->input->post('mahasiswa_nama').' berhasil di perbaharui'
			);
		}
		echo json_encode($pesan);
	}

	public function hapus() {
		$data = array( 'deleted' => TRUE );
		$this->m->hapus($data);
		$pesan = array(
			'warning' => 'Berhasil!',
			'kode' => 'success',
			'pesan' => 'Data mahasiswa berhasil di hapus'
		);
		echo json_encode($pesan);
	}

	public function options() {
		$res = $this->m->options();
		echo json_encode($res);
	}

}