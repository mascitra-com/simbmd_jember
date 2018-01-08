<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Skpd extends MY_Controller {

	public $class_belongs_to = 'admin';

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Skpd_model', 'skpd');
	}

	public function index()
	{
		$data['filter'] 	= $this->input->get();
		$result 			= $this->skpd->get_data($data['filter']);
		$data['skpds']  	= $result['data'];
		$data['pagination'] = $this->get_pagination($result['data_count'], 20, $data['filter']);
		$this->render('modules/admin/skpd/index', $data);
	}

	public function add()
	{
		$this->render('modules/admin/skpd/create');
	}

	public function edit($id = null)
	{
		if ($id === null) {
			show_404();
		}

		$data['skpd'] = $this->skpd->get($id);
		$this->render('modules/admin/skpd/create', $data);
	}

	private function batch_edit($id = array())
	{
		$data['skpds'] = $this->skpd->where_in('id', $id)->get_all();
		$this->render('modules/admin/skpd/update_batch', $data);
	}

	public function create()
	{
		$data = $this->input->post();

		$sukses = $this->skpd->insert($data);
		if($sukses) {
			$this->message('Data berhasil ditambah','success');
			$this->go('admin/skpd');
		} else {
			$this->message('Data gagal ditambah','danger');
			$this->go('admin/skpd/add');
		}
	}

	public function update()
	{
		$data = $this->input->post();
		$id   = $data['id'];
		unset($data['id']);

		$sukses = $this->skpd->update($id, $data);
		if($sukses) {
			$this->message('Data berhasil disunting','success');
			$this->go('admin/skpd');
		} else {
			$this->message('Data gagal disunting','danger');
			$this->go('admin/skpd/edit/'.$id);
		}
	}

	public function batch_update()
	{
		$data = $this->input->post();
		$data = $this->skpd->format_batch_data($data);

		$sukses = $this->skpd->batch_updates($data);
		if($sukses) {
			$this->message('Data berhasil disunting','success');
			$this->go('admin/skpd');
		} else {
			$this->message('Data gagal disunting','danger');
			$this->go('admin/skpd/edit/'.$id);
		}
	}

	public function delete($id = null)
	{
		if ($id === null) {
			show_404();
		}

		$sukses = $this->skpd->delete($id);
		if($sukses) {
			$this->message('Data berhasil dihapus','success');
			$this->go('admin/skpd');
		} else {
			$this->message('Data gagal dihapus','danger');
			$this->go('admin/skpd');
		}
	}

	private function batch_delete($id = array())
	{
		$sukses = $this->skpd->batch_delete($id);
		if($sukses) {
			$this->message('Data berhasil dihapus','success');
			$this->go('admin/skpd');
		} else {
			$this->message('Data gagal dihapus','danger');
			$this->go('admin/skpd');
		}
	}

	public function batch_action()
	{
		$id = explode(' ', $this->input->post('batch_id'));
		$action = $this->input->post('batch_action');

		switch ($action) {
			case '1':
				$this->batch_edit($id);
				break;
			case '2':
				$this->batch_delete($id);
				break;
			default:
				show_404();
				break;
		}
	}
}