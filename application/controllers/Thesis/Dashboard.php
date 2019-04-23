<?php
class Dashboard extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$isLogin = $this->session->userdata('LoggedIn');
		if($isLogin) {
			$level = $this->session->userdata('level');
			if($level=="Master") {
				$this->load->model('Thesis/M_Dashboard','m');
			}
		} else {
			redirect('portal');
		}
	}

	public function index() {
		$data["Title"] = "Thesis";
		$data["Konten"] = "thesis/v_dashboard";
		$this->load->view("v_master",$data);
	}

	public function list_data() {
		$list = $this->m->get_list_data();
		$datatb = array();
		foreach($list as $data) {
			$row = array();
			$row[] = $data->thesis_judul;
			$row[] = $data->thesis_tujuan;
			$row[] = $data->thesis_rumusan_masalah;
			$row[] = $data->thesis_kerangka_teori;
			$row[] = $data->thesis_metodologi_penelitian;
			$row[] = "<button id='edit' data='".$data->thesis_id."' class='btn btn-xs btn-warning'><i class='fa fa-pencil-alt'></i></button> | 
			<button id='hapus' class='btn btn-xs btn-danger' data='".$data->thesis_id."'><i class='fa fa-trash-alt'></i></a>";
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
			'thesis_id' => $res->thesis_id,
			'thesis_judul' => $res->thesis_judul,
			'thesis_tujuan' => $res->thesis_tujuan,
			'thesis_rumusan_masalah' => $res->thesis_rumusan_masalah,
			'thesis_kerangka_teori' => $res->thesis_kerangka_teori,
			'thesis_metodologi_penelitian' => $res->thesis_metodologi_penelitian
		);
		echo json_encode($data);
	}

	public function simpan() {
		$thesis_id = $this->input->post('thesis_id');
		$check_judul = $this->checker('judul');
		$check_rumusan = $this->checker('rumusan');
		$check_kerangka = $this->checker('kerangka');
		if($check_judul) {
			if($check_rumusan) {
				if($check_kerangka) {
					if($thesis_id=="") {
						$data = array(
							'thesis_id' => $this->m->get_id(),
							'user_id' => $this->session->userdata('id'),
							'thesis_judul' => $this->input->post('thesis_judul'),
							'thesis_tujuan' => $this->input->post('thesis_tujuan'),
							'thesis_rumusan_masalah' => $this->input->post('thesis_rumusan_masalah'),
							'thesis_kerangka_teori' => $this->input->post('thesis_kerangka_teori'),
							'thesis_metodologi_penelitian' => $this->input->post('thesis_metodologi_penelitian'),
							'created_by' => $this->session->userdata('nama')
						);
						$res = $this->m->simpan($data);
						$pesan = array(
							'warning' => 'Berhasil!',
							'kode' => 'success',
							'pesan' => 'Data thesis berhasil di simpan'
						);
					} else {
						$data = array(
							'thesis_judul' => $this->input->post('thesis_judul'),
							'thesis_tujuan' => $this->input->post('thesis_tujuan'),
							'thesis_rumusan_masalah' => $this->input->post('thesis_rumusan_masalah'),
							'thesis_kerangka_teori' => $this->input->post('thesis_kerangka_teori'),
							'thesis_metodologi_penelitian' => $this->input->post('thesis_metodologi_penelitian'),
							'updated_by' => $this->session->userdata('nama'),
							'last_update' => date('Y-m-d H:i:s')
						);
						$res = $this->m->edit($data);
						$pesan = array(
							'warning' => 'Berhasil!',
							'kode' => 'success',
							'pesan' => 'Data thesis berhasil di perbaharui'
						);
					}
				} else {
					$pesan = array(
						'warning' => 'Gagal!',
						'kode' => 'error',
						'pesan' => 'Data thesis ditolak sistem. Check Kerangka!'
					);
				}
			} else {
				$pesan = array(
					'warning' => 'Gagal!',
					'kode' => 'error',
					'pesan' => 'Data thesis ditolak sistem. Check Rumusan!'
				);
			}
		} else {
			$pesan = array(
				'warning' => 'Gagal!',
				'kode' => 'error',
				'pesan' => 'Data thesis ditolak sistem. Check Judul!'
			);
		}
		echo json_encode($pesan);
	}

	public function checker($penempatan) {
		if($penempatan=="judul") {
			$string = $this->input->post('thesis_judul');
			$forbidden_word = $this->m->get_title_words()->kata_daftar;
			$allowed_word = $this->m->get_title_words()->kata_maksimum;
		} elseif($penempatan=="rumusan") {
			$string = $this->input->post('thesis_rumusan_masalah');
			$forbidden_word = $this->m->get_summary_words()->kata_daftar;
			$allowed_word = $this->m->get_summary_words()->kata_maksimum;
		} elseif($penempatan=="kerangka") {
			$string = $this->input->post('thesis_kerangka_teori');
			$forbidden_word = $this->m->get_theory_words()->kata_daftar;
			$allowed_word = $this->m->get_theory_words()->kata_maksimum;
		}

		$clean_string = strtolower(preg_replace('/[^a-z0-9]+/i', ' ', $string));
		$string_array = array_unique(explode(" ",$clean_string));

		if(!empty($forbidden_word)) {
			$forbidden_array = explode(",",$forbidden_word);
			$array_data = array_diff($string_array,$forbidden_array);
		} else {
			$array_data = $string_array;
		}

		if($penempatan=="judul") {
			$maxlength = count($array_data);
		} else {
			$maxlength = 10;
		}

		$except = array();
		foreach($array_data as $words) {
			$filter = substr_count(strtolower($clean_string),$words);
			if($maxlength<10 OR $maxlength>15) {
				$except[] = array("REJECTED" => $words);
			} else {
				if($filter>$allowed_word) {
					$except[] = array("REJECTED" => $words);
				} else {
					$except[] = array("PASS" => $words);
				}
			}
		}
		$word_passed = implode(' ', array_column($except, 'PASS'));
		$word_rejected = implode(' ', array_column($except, 'REJECTED'));
		if(str_word_count($word_rejected)>0) {
			return FALSE;
		} else {
			return TRUE;
		}
	}

	public function hapus() {
		$data = array( 'deleted' => TRUE );
		$this->m->hapus($data);
		$pesan = array(
			'warning' => 'Berhasil!',
			'kode' => 'success',
			'pesan' => 'Data thesis berhasil di hapus'
		);
		echo json_encode($pesan);
	}

	public function options() {
		$res = $this->m->options();
		echo json_encode($res);
	}

}