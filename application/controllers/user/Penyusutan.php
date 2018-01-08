<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penyusutan extends MY_Controller {

	public $class_belongs_to = 'user';
	private $skpd_id;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('user/Kibb_model', 'kibb');
		$this->load->model('user/Kibc_model', 'kibc');
		$this->load->model('user/Kibd_model', 'kibd');

		$this->load->model('auth_model', 'auth');
        $this->skpd_id = $this->auth->get_skpd_id();
	}

	public function index()
	{
		$this->render('modules/user/penyusutan/index');
	}

	public function generate()
	{
		$data = $this->input->get();
		$kib  = 'kib'.$data['kib'];

		$data['skpd_id'] = $this->skpd_id;

		if ($data['tahun_penyusutan'] < $data['tahun_pengadaan'])
		{
			$this->message('Tahun penngadaan tidak boleh lebih besar dari tahun penyusutan', 'danger');
			$this->go('user/penyusutan');
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
			$this->go('user/penyusutan');
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