<?php
class Dashboard extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$isLogin = $this->session->userdata('LoggedIn');
		if($isLogin) {
			$token = $this->session->userdata('token');
			if($token=="") {
				$level = $this->session->userdata('level');
				$this->load->model('User/M_Dashboard','m');
				if($level!="Master") {
					$url = strtolower($level)."/dashboard";
					redirect($url);
				}
			} else {
				redirect("ujian/dashboard");
			}
		} else {
			redirect('portal');
		}
	}

	public function index() {
		$data["Title"] = "Dashboard";
		$data["Breadcrumb"] = array("Dashboard");
		$data["Nav"] = "Dashboard";
		$data["Menu"] = "v_menu_dashboard";
		$data["Konten"] = "user/v_dashboard";
		$this->load->view("v_master",$data);
	}

	public function logout() {
		$this->session->sess_destroy();
		redirect('portal','refresh');
	}

}