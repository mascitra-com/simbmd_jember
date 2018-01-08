<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends MY_Controller {

	public $class_belongs_to = 'admin';

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/Kiba_model', 'kiba');
		$this->load->model('admin/Kibb_model', 'kibb');
		$this->load->model('admin/Kibc_model', 'kibc');
		$this->load->model('admin/Kibd_model', 'kibd');
		$this->load->model('admin/Kibe_model', 'kibe');
		$this->load->model('admin/Kibf_model', 'kibf');
		$this->load->model('Skpd_model', 'skpd');
	}

	public function index()
	{
		$data['skpds'] = $this->skpd->order_by('name', 'ASC')->get_all();
		$this->render('modules/admin/laporan/index', $data);
	}

	public function generate()
	{
		$input = $this->input->post();
		$kib   = "kib".$input['asset_category'];

		unset($input['asset_category']);

		$result 	 		 = $this->{$kib}->get_data($input);
		$config['assets'] 	 = $this->format($result['data']);
		$config['skpd']	  	 = !empty($input['skpd_id']) ? $this->skpd->get_name_by_id($input['skpd_id']) : 'Semua';
		$config['kib'] 	  	 = $kib;
		
		$this->load->library('excel');
		$this->excel->export($config);
	}

	private function format($datas)
	{
		$this->load->model("Category_model", "category");
		$cat = $this->category->get_formated_data();

		foreach ($datas as $data) {
			$data->category_id = $cat[$data->category_id]->kode;

			if (isset($data->rehab))
			{
				foreach ($data->rehab as $rehab) 
				{
					$this->trim_unused_data($rehab);
				}
			}

			$this->trim_unused_data($data);
		}

		return $datas;
	}

	private function trim_unused_data($data)
	{
		unset($data->id, $data->skpd_id, $data->status, $data->temp, $data->created_at, $data->created_by, $data->updated_at, $data->updated_by, $data->deleted, $data->kategori, $data->rehab_to);
		return $data;
	}
}