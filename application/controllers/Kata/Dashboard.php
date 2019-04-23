<?php
class Dashboard extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$isLogin = $this->session->userdata('LoggedIn');
		if($isLogin) {
			$level = $this->session->userdata('level');
			if($level=="Master") {
				$this->load->model('Kata/M_Dashboard','m');
			}
		} else {
			redirect('portal');
		}
	}

	public function index() {
		$data["Title"] = "Kata";
		$data["Konten"] = "kata/v_dashboard";
		$this->load->view("v_master",$data);
	}

	public function list_data() {
		$list = $this->m->get_list_data();
		$datatb = array();
		foreach($list as $data) {
			$row = array();
			$row[] = $data->kata_input;
			$row[] = $data->kata_daftar;
			$row[] = $data->kata_maksimum;
			$row[] = "<button id='edit' data='".$data->kata_id."' class='btn btn-xs btn-warning'><i class='fa fa-pencil-alt'></i></button> | 
			<button id='hapus' class='btn btn-xs btn-danger' data='".$data->kata_id."'><i class='fa fa-trash-alt'></i></a>";
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
			'kata_id' => $res->kata_id,
			'kata_input' => $res->kata_input,
			'kata_daftar' => $res->kata_daftar,
			'kata_maksimum' => $res->kata_maksimum
		);
		echo json_encode($data);
	}

	public function simpan() {
		$kata_id = $this->input->post('kata_id');
		if($kata_id=="") {
			$data = array(
				'kata_id' => $this->m->get_id(),
				'kata_input' => $this->input->post('kata_input'),
				'kata_daftar' => preg_replace('/\s/', '', $this->input->post('kata_daftar')),
				'kata_maksimum' => $this->input->post('kata_maksimum'),
				'created_by' => $this->session->userdata('nama')
			);
			$res = $this->m->simpan($data);
			$pesan = array(
				'warning' => 'Berhasil!',
				'kode' => 'success',
				'pesan' => 'Data kata '.preg_replace('/\s/', '', $this->input->post('kata_daftar')).' berhasil di simpan'
			);
		} else {
			$data = array( 
				'kata_input' => $this->input->post('kata_input'),
				'kata_daftar' => preg_replace('/\s/', '', $this->input->post('kata_daftar')),
				'kata_maksimum' => $this->input->post('kata_maksimum'),
				'updated_by' => $this->session->userdata('nama'),
				'last_update' => date('Y-m-d H:i:s')
			);
			$res = $this->m->edit($data);
			$pesan = array(
				'warning' => 'Berhasil!',
				'kode' => 'success',
				'pesan' => 'Data kata '.preg_replace('/\s/', '', $this->input->post('kata_daftar')).' berhasil di perbaharui'
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
			'pesan' => 'Data kata berhasil di hapus'
		);
		echo json_encode($pesan);
	}

	public function options() {
		$res = $this->m->options();
		echo json_encode($res);
	}

}