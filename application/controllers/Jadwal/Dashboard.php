<?php
class Dashboard extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$isLogin = $this->session->userdata('LoggedIn');
		if($isLogin) {
			$this->load->model('Jadwal/M_Dashboard','m');
		} else {
			redirect('portal');
		}
	}

	public function index() {
		$data["Title"] = "Jadwal";
		$data["Konten"] = "jadwal/v_dashboard";
		$this->load->view("v_master",$data);
	}

	public function list_data() {
		$list = $this->m->get_list_data();
		$datatb = array();
		foreach($list as $data) {
			if($this->session->userdata('level')=="Kepala Jurusan" OR $this->session->userdata('level')=="Master") {
				$button = "<button id='edit' data='".$data->jadwal_id."' class='btn btn-sm btn-warning'><i class='fa fa-pencil-alt'></i></button> | <button id='hapus' class='btn btn-sm btn-danger' data='".$data->jadwal_id."'><i class='fa fa-trash-alt'></i></a>";
			} else {
				$button = "-";
			}
			$row = array();
			$row[] = $data->mahasiswa_nama;
			$row[] = $data->dosen_nama;
			$row[] = $data->jadwal_tanggal;
			$row[] = $button;
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
			'dosen_id' => $res->dosen_id,
			'mahasiswa_id' => $res->mahasiswa_id,
			'jadwal_tanggal' => $res->jadwal_tanggal
		);
		echo json_encode($data);
	}

	public function simpan() {
		$jadwal_id = $this->input->post('jadwal_id');
		if($jadwal_id=="") {
			$data = array(
				'jadwal_id' => $this->m->get_id(),
				'dosen_id' => $this->input->post('dosen_id'),
				'mahasiswa_id' => $this->input->post('mahasiswa_id'),
				'jadwal_tanggal' => $this->input->post('jadwal_tanggal'),
				'created_by' => $this->session->userdata('nama')
			);
			$res = $this->m->simpan($data);
			$pesan = array(
				'warning' => 'Berhasil!',
				'kode' => 'success',
				'pesan' => 'Data berhasil di simpan'
			);
		} else {
			$data = array( 
				'dosen_id' => $this->input->post('dosen_id'),
				'mahasiswa_id' => $this->input->post('mahasiswa_id'),
				'jadwal_tanggal' => $this->input->post('jadwal_tanggal'),
				'updated_by' => $this->session->userdata('nama'),
				'last_update' => date('Y-m-d H:i:s')
			);
			$res = $this->m->edit($data);
			$pesan = array(
				'warning' => 'Berhasil!',
				'kode' => 'success',
				'pesan' => 'Data berhasil di perbaharui'
			);
		}
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
			'warning' => 'Berhasil!',
			'kode' => 'success',
			'pesan' => 'Data dosen berhasil di hapus'
		);
		echo json_encode($pesan);
	}

	public function options() {
		$res = $this->m->options();
		echo json_encode($res);
	}

}