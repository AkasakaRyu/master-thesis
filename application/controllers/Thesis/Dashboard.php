<?php
class Dashboard extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$isLogin = $this->session->userdata('LoggedIn');
		if($isLogin) {
			$this->load->model('Thesis/M_Dashboard','m');
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
			if($this->session->userdata('access')=="LVL19011700002") {
				if($data->thesis_status=="Approved") {
					$button = "<button type='button' id='tolak' data='".$data->thesis_id."' class='btn btn-sm btn-danger'><i class='fa fa-times'></i></button>";
				} else {
					$button = "<button type='button' id='terima' data='".$data->thesis_id."' class='btn btn-sm btn-success'><i class='fa fa-check'></i></button> | <button type='button' id='tolak' data='".$data->thesis_id."' class='btn btn-sm btn-danger'><i class='fa fa-times'></i></button>";
				}
			} else {
				$button = "<button type='button' id='edit' data='".$data->thesis_id."' class='btn btn-sm btn-warning'><i class='fa fa-pencil-alt'></i></button>";
			}
			$row = array();
			$row[] = $data->thesis_status;
			$row[] = $data->thesis_judul;
			$row[] = $data->mahasiswa_nim;
			$row[] = $data->mahasiswa_nama;
			$row[] = $data->thesis_keterangan;
			$row[] = $data->thesis_tujuan;
			$row[] = $data->thesis_rumusan_masalah;
			$row[] = $data->thesis_kerangka_teori;
			$row[] = $data->thesis_metodologi_penelitian;
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
			'thesis_id' => $res->thesis_id,
			'user_id' => $res->user_id,
			'thesis_judul' => $res->thesis_judul,
			'thesis_tujuan' => $res->thesis_tujuan,
			'thesis_rumusan_masalah' => $res->thesis_rumusan_masalah,
			'thesis_kerangka_teori' => $res->thesis_kerangka_teori,
			'thesis_metodologi_penelitian' => $res->thesis_metodologi_penelitian,
			'thesis_status' => $res->thesis_status
		);
		echo json_encode($data);
	}

	public function cari_judul() {
		$result = $this->m->cari_judul();
		if($result>0) {
			$pesan = array(
				'warning' => 'Title already exists!',
				'kode' => 'error',
				'pesan' => 'The title of the thesis was found '.$result.' data, click reset button then use another title!'
			);
		} else {
			$pesan = array(
				'warning' => 'No title yet!',
				'kode' => 'success',
				'pesan' => 'No thesis title has been used yet, press the send button to send for review!'
			);
		}
		echo json_encode($pesan);
	}

	public function daftar_judul() {
		$res = $this->m->daftar_judul();
		echo json_encode($res);
	}

	public function terima() {
		$data = array(
			'thesis_status' => 'Approved',
			'updated_by' => $this->session->userdata('nama'),
			'last_update' => date('Y-m-d H:i:s')
		);
		$this->m->edit($data);
		$mahasiswa = $this->m->get_mahasiswa();
		$email = "
			Hello, ".$mahasiswa->mahasiswa_nama."<br /><br />
			Congratulations, your thesis title has been <span style='color:green'>approved</span>. Please log in to the system and fill the next forms.<br /><br />
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
		$this->email->subject('Your Thesis Status');
		$this->email->message($email);
		$this->email->send();
		$pesan = array(
			'warning' => 'It Works!',
			'kode' => 'success',
			'pesan' => 'Thesis data has been approved!'
		);
		echo json_encode($pesan);
	}

	public function tolak() {
		$data = array(
			'thesis_status' => 'Rejected',
			'thesis_keterangan' => $this->input->post('thesis_keterangan'),
			'updated_by' => $this->session->userdata('nama'),
			'last_update' => date('Y-m-d H:i:s')
		);
		$this->m->edit($data);
		$mahasiswa = $this->m->get_mahasiswa();
		$email = "
			Hello, ".$mahasiswa->mahasiswa_nama."<br /><br />
			Sorry, your thesis title has been <span style='color:red'>rejected</span>. Please log in to view revision or note from your head of departement.<br /><br />
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
		$this->email->subject('Your Thesis Status');
		$this->email->message($email);
		$this->email->send();
		$pesan = array(
			'warning' => 'It Works!',
			'kode' => 'success',
			'pesan' => 'Thesis data has been rejected!'
		);
		echo json_encode($pesan);
	}

	public function simpan() {
		$thesis_id = $this->input->post('thesis_id');
		if($this->session->userdata('access')!="LVL19011700001") {
			$status = "Waiting";
			$user_id = $this->session->userdata('id');
		} else {
			$status = "Approved";
			$user_id = $this->input->post('user_id');
		}
		$check_limit = $this->m->check_limit($user_id);
		if($thesis_id=="") {
			if($check_limit==0) {
				$data = array(
					'thesis_id' => $this->m->get_id(),
					'user_id' => $user_id,
					'thesis_judul' => $this->input->post('thesis_judul'),
					'thesis_tujuan' => $this->input->post('thesis_tujuan'),
					'thesis_rumusan_masalah' => $this->input->post('thesis_rumusan_masalah'),
					'thesis_kerangka_teori' => $this->input->post('thesis_kerangka_teori'),
					'thesis_metodologi_penelitian' => $this->input->post('thesis_metodologi_penelitian'),
					'thesis_status' => $status,
					'created_by' => $this->session->userdata('nama')
				);
				$res = $this->m->simpan($data);
				$pesan = array(
					'warning' => 'It Works!',
					'kode' => 'success',
					'pesan' => 'Thesis data successfully saved!'
				);
			} else {
				$pesan = array(
					'warning' => 'Failed!',
					'kode' => 'error',
					'pesan' => 'You have submitted a thesis!'
				);
			}
		} else {
			$data = array(
				'user_id' => $user_id,
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
				'warning' => 'It Works!',
				'kode' => 'success',
				'pesan' => 'Thesis data was successfully updated!'
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

		$clean_string = strtolower(preg_replace('/[^\p{L}\p{N}\s]/u', '', $string));
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
		$data = array( 
			'deleted' => TRUE,
			'updated_by' => $this->session->userdata('nama'),
			'last_update' => date('Y-m-d H:i:s') 
		);
		$this->m->hapus($data);
		$pesan = array(
			'warning' => 'It Works!',
			'kode' => 'success',
			'pesan' => 'Thesis data was successfully deleted!'
		);
		echo json_encode($pesan);
	}

	public function options() {
		$res = $this->m->options();
		echo json_encode($res);
	}

}