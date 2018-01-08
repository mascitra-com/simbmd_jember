<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penyusutan extends MY_Controller {

	public $class_belongs_to = 'admin';

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Skpd_model', 'skpd');
		$this->load->model('admin/Kibb_model', 'kibb');
		$this->load->model('admin/Kibc_model', 'kibc');
		$this->load->model('admin/Kibd_model', 'kibd');
	}

	public function index()
	{
		$data['skpds'] = $this->skpd->order_by('name')->get_all();
		$this->render('modules/admin/penyusutan/index', $data);
	}

	public function generate()
	{
		$data   = $this->input->get();
		$kib    = 'kib'.$data['kib'];

		if (empty($data['skpd_id'])) {
			$this->message('Pilih OPD terlebih dahulu', 'danger');
			$this->go('admin/penyusutan');
		}

		if ($data['tahun_penyusutan'] < $data['tahun_pengadaan']) {
			$this->message('Tahun penngadaan tidak boleh lebih besar atau sama dari tahun penyusutan', 'danger');
			$this->go('admin/penyusutan');
		}

		$where['status'] = '';
		$where['tahun_pengadaan<='] = $data['tahun_pengadaan'];
		$where['skpd_id'] = $data['skpd_id'];

		
		$penyusutan_config['asset'] = $this->{$kib}->get_data_by($where);
		$penyusutan_config['tahun_penyusutan'] = $data['tahun_penyusutan'];
		
		# Jika data kosong
		if(empty($penyusutan_config['asset']))
		{
		    $this->message('Data aset pada OPD ini kosong', 'danger');
			$this->go('admin/penyusutan');
		}
		
		if ($data['kib'] !== 'b') {
			$penyusutan_config['with_rehab'] = TRUE;
		}
		
		$this->load->library('depreciation', $penyusutan_config);

		$export_config['kib'] 	 = $kib;
		$export_config['assets'] = $this->depreciation->calculate();
		$export_config['skpd'] 	 = !empty($where['skpd_id']) ? $this->skpd->get_name_by_id($where['skpd_id']) : 'Semua';
		$export_config['tahun_penyusutan'] = $data['tahun_penyusutan'];

		if (!empty($data['skpd_id'])) {
			$where['skpd_id'] = $data['skpd_id'];
		}

		$this->load->library('excel');
		$this->excel->export_penyusutan($export_config);
	}
}