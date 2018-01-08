<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Approval extends MY_Controller {

	public $class_belongs_to = 'user';

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/Approval_model', 'approval');
		$this->load->model('admin/Proposal_model', 'proposal');
		$this->load->model('admin/Kiba_model', 'kiba');
		$this->load->model('admin/Kibb_model', 'kibb');
		$this->load->model('admin/Kibc_model', 'kibc');
		$this->load->model('admin/Kibd_model', 'kibd');
		$this->load->model('admin/Kibe_model', 'kibe');
		$this->load->model('admin/Kibf_model', 'kibf');
	}

	public function index()
	{
		show_404();
	}

	public function import()
	{
		$data['proposals'] = $this->proposal->get_data();
		$this->render('modules/admin/approval/import', $data);
	}

	public function import_save()
	{
		# GET DATA
		$data = $this->input->post();
		$kib  = 'kib'.$data['asset_category'];
		$data['approval_category'] = 'ON_INSERT';
		$proposal = $this->proposal->get($data['proposal_id']);

		# INSERT DATA FROM EXCEL IF APPROVED
		if ($data['approval_status'] === '1') {
			# begin import data
			$sukses = $this->{$kib}->save_import($proposal);
		}

		# DELETE PROPOSAL
		$sukses = $this->proposal->update_by(array('id'=>$proposal->id), array('deleted'=>'1'));

		if (!$sukses) {
			$this->message('Terjadi kesalahan', 'danger');
			$this->go('admin/approval/import');
		}

		# DELETE FILE
		unlink(realpath(FCPATH.'/res/docs/imports/'.$proposal->file));

		# INSERT TO APPROVAL TABLE
		$sukses = $this->approval->insert($data);
		if($sukses) {
			$this->message('Persetujuan berhasil diproses','success');
			$this->go('admin/approval/import');
		} else {
			$this->message('Persetujuan gagal diproses','danger');
			$this->go('admin/approval/import');
		}
	}

	public function delete()
	{
		$data['approvals'] = $this->approval->get_data('ON_DELETE');
		$this->render('modules/admin/approval/delete', $data);
	}

	public function delete_detail($skpd = null, $id = null)
	{
		if ($skpd === null OR $id === null) {
			show_404();
		}

		$data['excluded'] = array('id', 'skpd_id', 'skpd', 'category_id', 'created_at', 'created_by', 'updated_at', 'updated_by', 'deleted', 'status', 'temp');
		$data['data'] = $this->{$skpd}->get_data_by(array('status'=>'ON_DELETE', 'skpd_id'=>$id));
		$this->render('modules/admin/approval/delete_detail', $data);
	}

	public function delete_save()
	{
		# GET DATA
		$data = $this->input->post();
		$data['approval_category'] = 'ON_DELETE';
		$kib = 'kib'.$data['asset_category'];

		# UPDATE MAIN TABEL FIRST
		$data_where = array('skpd_id'=>$data['skpd_id'], 'status'=>'ON_DELETE');
		if ($data['approval_status'] === '0') {
			$sukses = $this->{$kib}->update_by($data_where, array('status'=>''));
		} else {
			$sukses = $this->{$kib}->delete_by($data_where);
		}

		if (!$sukses) {
			$this->message('Terjadi kesalahan', 'danger');
			$this->go('admin/approval/delete');
		}

		# INSERT TO APPROVAL TABLE
		$sukses = $this->approval->insert($data);
		if($sukses) {
			$this->message('Persetujuan berhasil diproses','success');
			$this->go('admin/approval/delete');
		} else {
			$this->message('Persetujuan gagal diproses','danger');
			$this->go('admin/approval/delete');
		}
	}

	public function update()
	{
		$data['approvals'] = $this->approval->get_data('ON_UPDATE');
		$this->render('modules/admin/approval/update', $data);
	}

	public function update_detail($skpd = null, $id = null)
	{
		if ($skpd === null OR $id === null) {
			show_404();
		}

		$data['excluded'] = array('id', 'skpd_id', 'skpd', 'category_id', 'created_at', 'created_by', 'updated_at', 'updated_by', 'deleted', 'status', 'temp');
		$data['data'] = $this->{$skpd}->get_data_by(array('status'=>'ON_UPDATE', 'skpd_id'=>$id));
		$this->render('modules/admin/approval/update_detail', $data);
	}

	public function update_save()
	{
		# GET DATA
		$data = $this->input->post();
		$data['approval_category'] = 'ON_UPDATE';
		$kib = 'kib'.$data['asset_category'];

		# UPDATE MAIN TABEL FIRST
		$data_updated = array('status'=>'', 'temp'=>'');
		$data_where   = array('skpd_id'=>$data['skpd_id'], 'status'=>'ON_UPDATE');

		if ($data['approval_status'] === '1') {
			$sukses = $this->{$kib}->update_by($data_where, $data_updated);
		} else {
			$sukses = $this->do_rollback($data);
		}

		if (!$sukses) {
			$this->message('Terjadi kesalahan', 'danger');
			$this->go('admin/approval/delete');
			exit();
		}

		# INSERT TO APPROVAL TABLE
		$sukses = $this->approval->insert($data);
		if($sukses) {
			$this->message('Persetujuan berhasil diproses','success');
			$this->go('admin/approval/delete');
		} else {
			$this->message('Persetujuan gagal diproses','danger');
			$this->go('admin/approval/delete');
		}
	}

	private function do_rollback($data)
	{
		# GET DATA
		$kib = 'kib'.$data['asset_category'];
		$result = $this->{$kib}->get_many_by(array('deleted'=>0, 'skpd_id'=>$data['skpd_id'],'status'=>'ON_UPDATE'));
		
		# ROLLBACK
		foreach ($result as $key => $value) {
			$temp = json_decode($value->temp);
			$id   = $temp->id;
			unset($temp->id, $temp->created_at, $temp->created_by, $temp->updated_at, $temp->updated_by, $temp->deleted);
			if(!$this->{$kib}->update($id, (array)$temp)) {
				return FALSE;
			}
		}

		return TRUE;
	}
}