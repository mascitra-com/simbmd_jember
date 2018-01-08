<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller_base {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Auth_model', 'auth');
	}

	public function index()
	{
		if (!$this->auth->is_loggedin()) {
			$this->render('modules/auth/login');
		} else {
			$this->go($this->_get_destination());
		}
	}

	public function do_login()
	{
		$data['username'] = $this->input->post('username');
		$data['password'] = $this->input->post('password');

		if ($this->auth->authenticate($data)) {
			$this->go($this->_get_destination());
		} else {
			$this->message('Username atau password salah', 'danger');
			$this->go('masuk');
		}
	}

	public function do_logout()
	{
		$this->auth->do_logout();
		$this->go('masuk');
	}

	private function _get_destination()
	{
		$user_group = $this->auth->get_admin_status();
		switch ($user_group) {
			case 0:
				return 'user';
			case 1:
				return 'admin';		
			default:
				show_404();
				break;
		}
	}
}