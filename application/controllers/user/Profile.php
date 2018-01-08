<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends MY_Controller {

	public $class_belongs_to = 'user';

	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_model', 'user');
	}

	public function index()
	{
		$this->load->model('Auth_model', 'auth');

		$id = $this->auth->get_id();
		$data['profil'] = $this->user->get($id);
		$this->render('modules/admin/profile/index', $data);
	}

	public function update()
	{
		$data = $this->input->post();
		$id   = $data['id'];

		if (!empty($data['password']) OR !empty($data['password_re'])) {
			if ($data['password'] !== $data['password_re']) {
				$this->message('Password tidak sama', 'danger');
				$this->go('admin/profile');
			} else {
				$data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
			}
		} else {
			unset($data['password']);
		}

		unset($data['id'], $data['password_re']);

		$sukses = $this->user->update($id, $data);
		if($sukses) {
			$this->message('Profil berhasil disunting','success');
			$this->go('admin/profile');
		} else {
			$this->message('Profil gagal disunting','danger');
			$this->go('admin/profile');
		}
	}

	public function tes($teks)
	{
		$this->load->helper('inflector');
		echo plural($teks);
	}
}