<?php (defined("BASEPATH")) OR exit("No direct script access allowed");

class Kibc_model extends MY_Model {

	public $_table = "asset_c";
	public $categories = array();

	public function __construct() {
		parent::__construct();
		$this->load->model('Category_model', 'cat');
		$this->categories = $this->cat->get_formated_data_reverse();
	}

	public function get_data($filter = array())
	{
		# UNSET REF
		unset($filter['ref']);
		
		# BEGIN GET DATA
		$obj    = $this->where(array("{$this->_table}.deleted"=>0, "status"=>"", "rehab_to"=>NULL));
		$result = array();

		# JOIN DLL
		$obj->select("{$this->_table}.*, skpds.name AS skpd, categories.nama AS kategori");
		$obj->join("skpds", "skpds.id = {$this->_table}.skpd_id");
		$obj->join("categories", "categories.id = {$this->_table}.category_id");

		# FILTER HERE
		foreach ($filter as $key => $value) {
			if ($key !== "page") {
				$obj->like($this->_table.'.'.$key, $value);
			}
		}

		# GET ALL DATA COUNT FOR PAGINATION
		$tmp = clone $obj->db;
		$result["data_count"] = $tmp->from("{$this->_table}")->count_all_results();

		if (!isset($filter["page"])) {
			$filter["page"] = 1;
		}

		# LIMIT
		$limit = 20;
		$obj->limit($limit, ($filter["page"] - 1) * $limit);

		# ORDER
		$obj->order_by("skpd_id", "ASC");

		$result["data"] = $this->fill_empty($obj->get_all());
		$result["data"] = $this->get_rehab($result["data"]);

		return $result;
	}

	public function get_data_by($where)
	{
		if (empty($where['tahun_pengadaan<=']))
		{
			$where['tahun_pengadaan<='] = date('Y');
		}

		$obj = $this->where(array("{$this->_table}.deleted"=>0, "rehab_to"=>NULL));

		# JOIN DLL
		$obj->select("{$this->_table}.*, skpds.name AS skpd, categories.nama AS kategori");
		$obj->join("skpds", "skpds.id = {$this->_table}.skpd_id");
		$obj->join("categories", "categories.id = {$this->_table}.category_id");

		$obj->where($where);

		return  $this->get_rehab($obj->get_all(), $where['tahun_pengadaan<=']);
	}

	public function get_rehab($data, $tahun_pengadaan="")
	{
		if (empty($tahun_pengadaan)) {
			$tahun_pengadaan = date('Y');
		}
		
		foreach ($data as $key => $value) {
			$data[$key]->rehab = new stdClass();

			if (!empty($value->id)) {
				$data[$key]->rehab = $this->get_many_by(array('rehab_to'=>$value->id, 'tahun_pengadaan<='=>$tahun_pengadaan, 'deleted'=>0, 'status'=>''));
			}
		}
		return $data;
	}

	public function save_import($proposal)
	{
		$this->load->library('excel');

		# PREPARE EXCEL CONFIG
		$config['file'] 	= realpath(FCPATH.'/res/docs/imports/'.$proposal->file);
		$config['startRow'] = 4;

		# GET DATA FROM EXCEL
		$result = $this->excel->import($config);
		$result = $this->trim_array_data($result);

		# START SAVING
		$current_id;
		$tmp = array();

		foreach ($result as $key => $value)
		{
			$data = $this->db_formated($value, $proposal->skpd_id);
			if (!empty($data['reg'])) {
				if (count($tmp) > 0) {
					$this->batch_insert($tmp);
				}

				$current_id = $this->insert($data);
				$tmp = array();

			} else {
				$data['rehab_to'] = $current_id;
				$tmp[] = $data;
			}
		}

		if (count($tmp) > 0) {
			$this->batch_insert($tmp);
		}
		
		return TRUE;
	}

	private function db_formated($data, $skpd_id)
	{

		# SET KOLOM
		$column = array('category_id', 'nama', 'kode_barang', 'reg', 'kondisi', 'tingkat', 'pondasi', 'luas_lantai', 'alamat', 'tahun_pengadaan', 'nomor_dokumen', 'luas_bangunan', 'status_tanah', 'kode_tanah', 'asal_usul', 'nilai', 'keterangan');
		$final = array();

		# CONVERT
		foreach ($column as $index => $item)
		{
			$final[$item] = !empty($data[$index]) ? $data[$index] : '';
		}

		$final['skpd_id'] 	  = $skpd_id;
		$final['rehab_to'] 	  = NULL;
		$final['category_id'] = $this->categories[$final['category_id']]->id;
		$final['deleted'] 	  = 0;

		return $final;
	}

	public function trim_array_data($data)
	{
		foreach ($data as $key => $value) {
			$is_empty = TRUE;
			foreach ($value as $index => $item) {
				if (!empty($item)) {
					$is_empty = FALSE;
				}
			}

			if ($is_empty) {
				unset($data[$key]);
			}
		}

		return $data;
	}
}