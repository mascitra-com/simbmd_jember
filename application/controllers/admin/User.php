<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

	public $class_belongs_to = 'admin';

	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_model', 'user');
	}

	public function index()
	{
		$data['filter'] 	= $this->input->get();
		$result 			= $this->user->get_data($data['filter']);
		$data['users']  	= $result['data'];
		$data['pagination'] = $this->get_pagination($result['data_count'], 20, $data['filter']);
		$this->render('modules/admin/user/index', $data);
	}

	public function add()
	{
		$this->load->model('Skpd_model', 'skpd');
		$data['skpds'] = $this->skpd->order_by('name', 'ASC')->get_many_by(array('deleted'=>0, 'id<>'=>1));
		$this->render('modules/admin/user/create', $data);
	}

	public function edit($id = null)
	{
		if ($id === null) {
			show_404();
		}

		$this->load->model('Skpd_model', 'skpd');
		$data['skpds'] = $this->skpd->order_by('name', 'ASC')->get_many_by(array('deleted'=>0, 'id<>'=>1));
		$data['user']  = $this->user->get($id);
		$this->render('modules/admin/user/create', $data);
	}

	public function create()
	{
		$data = $this->input->post();

		if (empty($data['skpd_id'])) {
			$this->message('Pilih SKPD terlebih dahulu', 'danger');
			$this->go('admin/user/add');
		}

		$result = $this->user->get_by(array('username'=>$data['username']));
		if ($result) {
			$this->message('Username telah terdaftar', 'danger');
			$this->go('admin/user/add');
		}

		if (empty($data['password']) OR empty($data['password_re']) OR $data['password'] !== $data['password_re']) {
			$this->message('Password tidak sama', 'danger');
			$this->go('admin/user/add');
		}

		$data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
		unset($data['password_re']);

		$sukses = $this->user->insert($data);
		if($sukses) {
			$this->message('Pengguna berhasil ditambah','success');
			$this->go('admin/user');
		} else {
			$this->message('Pengguna gagal ditambah','danger');
			$this->go('admin/user/add');
		}
	}

	public function update()
	{
		$data = $this->input->post();
		$id   = $data['id'];

		if (empty($data['skpd_id'])) {
			$this->message('Pilih SKPD terlebih dahulu', 'danger');
			$this->go('admin/user/add');
		}

		if (!empty($data['password']) OR !empty($data['password_re'])) {
			if ($data['password'] !== $data['password_re']) {
				$this->message('Password tidak sama', 'danger');
				$this->go('admin/user/add');
			} else {
				$data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
			}
		} else {
			unset($data['password']);
		}

		unset($data['id'], $data['password_re']);

		$sukses = $this->user->update($id, $data);
		if($sukses) {
			$this->message('Pengguna berhasil disunting','success');
			$this->go('admin/user');
		} else {
			$this->message('Pengguna gagal disunting','danger');
			$this->go('admin/user/add');
		}
	}

	public function delete($id = null)
	{
		if ($id === null) {
			show_404();
		}

		$sukses = $this->user->delete($id);
		if($sukses) {
			$this->message('Pengguna berhasil dihapus','success');
			$this->go('admin/user');
		} else {
			$this->message('pengguna gagal dihapus','danger');
			$this->go('admin/user');
		}
	}

	public function batch_action()
	{
		$batch_action = $this->input->post('batch_action');
		$batch_id 	  = explode(' ', $this->input->post('batch_id'));

		if (empty($batch_id)) {
			show_404();
		}

		$sukses = $this->user->batch_delete($batch_id);
		if($sukses) {
			$this->message('Pengguna berhasil dihapus','success');
			$this->go('admin/user');
		} else {
			$this->message('pengguna gagal dihapus','danger');
			$this->go('admin/user');
		}
	}

	public function api_get_by_username($username)
	{
		$result = $this->user->get_by(array('username'=>$username));
		echo json_encode($result);
	}
}