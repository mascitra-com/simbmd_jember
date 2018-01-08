<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Asset_a extends MY_Controller {

	public $class_belongs_to = 'user';
	private $skpd_id;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('user/Kiba_model', 'kib');
		$this->load->model('Category_model', 'category');
		$this->load->model('Skpd_model', 'skpd');
		$this->load->model('auth_model', 'auth');

        $this->skpd_id = $this->auth->get_skpd_id();
	}

	public function index()
	{
		$data['filter'] = $this->kib->strip_filter($this->input->get());
		$data['filter']['skpd_id'] = $this->skpd_id;
		$result 			= $this->kib->get_data($data['filter']);
		$data['kibs'] 		= $result['data'];
		$data['skpds']		= $this->skpd->order_by('name')->get_all();
		$data['categories']	= $this->category->order_by('nama')->get_all();
		$data['pagination'] = $this->get_pagination($result['data_count'], 20, $data['filter']);
		$data['data_count'] = $result['data_count'];

		$this->render('modules/user/asset_a/index', $data);
	}

	public function add()
	{
		$data['categories']	= $this->category->order_by('nama')->get_all();
		$this->render('modules/user/asset_a/import', $data);
	}

	public function edit($id = null)
	{
		if (empty($id)) {
			show_404();
		}

		$data['kib'] 		= $this->kib->get($id);
		$data['categories'] = $this->category->order_by('nama')->get_all();
		$this->render('modules/user/asset_a/form', $data);
	}

	public function import()
	{
		# GET & VALIDATE DATA
		$data = $this->input->post();
		$data['asset_category'] = 'a';
		$data['skpd_id'] = $this->skpd_id;

		# BEGIN UPLOAD
		if ($_FILES['file']['size'] > 0) {
			$config['upload_path']   = realpath(FCPATH.'/res/docs/imports/');
			$config['file_name']	 = date('Ymdhis').'-kiba-'.$data['skpd_id'];
			$config['allowed_types'] = 'xls|xlsx';
			$config['max_size']      = 1500;
			$config['overwrite']     = TRUE;

			$this->load->library('upload', $config);
			if ($this->upload->do_upload('file')) {
				$data['file'] = $this->upload->data('file_name');
			} else {
				$this->message($this->upload->display_errors(), 'danger');
				$this->go('user/asset_a/add');
			}

			$this->load->model('user/Proposal_model', 'proposal');
			$sukses = $this->proposal->insert($data);
			if($sukses) {
				$this->message('Pengajuan data berhasil disimpan dan <b>menunggu persetujuan BPKA</b>','success');
				$this->go('user/asset_a');
			} else {
				unlink(realpath(FCPATH.'/res/docs/imports/'.$data['file']));
				$this->message('Pengajuan gagal disimpan, perikas kembali data anda','danger');
				$this->go('user/asset_a/add');
			}
		}
	}

	public function insert()
	{
		$data = $this->input->post();
		$data['status']  = 'ON_INSERT';
		$data['skpd_id'] = $this->skpd_id;

		$sukses = $this->kib->insert($data);
		if($sukses) {
			$this->message('Data berhasil ditambah. <b>Menunggu persetujuan BPKA</b>','success');
			$this->go('user/asset_a/add');
		} else {
			$this->message('Terjadi kesalahan. Periksa kembali data masukan.','danger');
			$this->go('user/asset_a/add');
		}
	}

	public function update()
	{
		$data = $this->input->post();
		$id   = $data['id'];
		unset($data['id']);

		$result = $this->kib->get($id);
		$data['temp']   = json_encode($result);
		$data['status'] = 'ON_UPDATE';

		$sukses = $this->kib->update($id, $data);
		if($sukses) {
			$this->message('Data berhasil disunting dan <b>menunggu persetujuan BPKA.</b>','success');
			$this->go('user/asset_a');
		} else {
			$this->message('Data gagal disunting','danger');
			$this->go('user/asset_a/edit/'.$id);
		}
	}

	public function delete($id = null)
	{
		if (empty($id)) {
			show_404();
		}

		$sukses = $this->kib->update($id, array('status'=>'ON_DELETE'));
		if($sukses) {
			$this->message('Data berhasil dihapus dan <b>menunggu persetujuan BPKA.</b>','success');
			$this->go('user/asset_a');
		} else {
			$this->message('Pengajuan penghapusan data gagal','danger');
			$this->go('user/asset_a');
		}
	}

	public function exchange()
	{
		$data = $this->input->post();

		if (empty($data['skpd_id'])) {
			$this->message('Pilih OPD terlebih dahulu','danger');
			$this->go('user/asset_a');
		}

		#PREPARE DATA UPDATE
		$skpd_id   	 = $data['skpd_id'];
		$skpd_name 	 = $this->skpd->get_name_by_id($skpd_id);
		$temp 		 = json_encode(array('skpd_id'=>$skpd_id, 'skpd_name'=>$skpd_name));
		$data_update = array('status'=>'ON_EXCHANGE', 'temp'=>$temp);
		
		$sukses = $this->kib->update($data['id'], $data_update);
		if($sukses) {
			$this->message('Mutasi berhasil disimpan. <b>Menunggu persetujuan BPKA.</b>','success');
			$this->go('user/asset_a');
		} else {
			$this->message('Mutasi gagal disimpan.','danger');
			$this->go('user/asset_a');
		}
	}

	private function batch_deletes($id = null)
	{
		if (empty($id)) {
			show_404();
		}

		$sukses = $this->kib->batch_update($id, array('status'=>'ON_DELETE'));
		if($sukses) {
			$this->message('Data berhasil dihapus dan <b>menunggu persetujuan BPKA.</b>','success');
			$this->go('user/asset_a');
		} else {
			$this->message('Pengajuan penghapusan data gagal','danger');
			$this->go('user/asset_a');
		}
	}

	public function batch_action()
	{
		$batch_action = $this->input->post('batch_action');
		$batch_id	  = explode(' ', $this->input->post('batch_id'));

		switch ($batch_action) {
			case '1':
				$this->batch_deletes($batch_id);
				break;
			
			default:
				show_404();
				break;
		}
	}
}