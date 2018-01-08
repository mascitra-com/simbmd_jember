<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends MY_Controller {

	public $class_belongs_to = 'user';
	private $skpd_id;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('user/Kiba_model', 'kiba');
		$this->load->model('user/Kibb_model', 'kibb');
		$this->load->model('user/Kibc_model', 'kibc');
		$this->load->model('user/Kibd_model', 'kibd');
		$this->load->model('user/Kibe_model', 'kibe');
		$this->load->model('user/Kibf_model', 'kibf');
		$this->load->model('skpd_model', 'skpd');

		$this->load->model('auth_model', 'auth');
        $this->skpd_id = $this->auth->get_skpd_id();
	}

	public function index()
	{
		$this->render('modules/user/laporan/index');
	}

	public function generate()
	{
		$input = $this->input->post();
		$kib   = "kib".$input['asset_category'];

		$input['skpd_id'] = $this->skpd_id;

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