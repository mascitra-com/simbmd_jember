<?php (defined("BASEPATH")) OR exit("No direct script access allowed");

class Kibb_model extends MY_Model {

	public $_table = "asset_b";

	public function __construct() {
		parent::__construct();
	}

	public function get_data($filter = array())
	{
		# UNSET REF
		unset($filter['ref']);
		
		# BEGIN GET DATA
		$obj    = $this->where(array("{$this->_table}.deleted"=>0, "status"=>""));
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

		return $result;
	}

	public function get_data_by($where)
	{
		$obj = $this->where(array("{$this->_table}.deleted"=>0));

		# JOIN DLL
		$obj->select("{$this->_table}.*, skpds.name AS skpd, categories.nama AS kategori");
		$obj->join("skpds", "skpds.id = {$this->_table}.skpd_id");
		$obj->join("categories", "categories.id = {$this->_table}.category_id");

		$obj->where($where);

		return  $this->fill_empty($obj->get_all());
	}

	public function save_import($proposal)
	{
		$this->load->library('excel');

		# PREPARE EXCEL CONFIG
		$config['file'] 	= realpath(FCPATH.'/res/docs/imports/'.$proposal->file);
		$config['startRow'] = 3;

		# GET DATA FROM EXCEL
		$result = $this->excel->import($config);
		# FORMAT DATA FOR DB USAGE
		$result = $this->db_formated($result, $proposal->skpd_id);
		
		return $this->batch_insert($result);
	}

	private function db_formated($data, $skpd_id)
	{
		# LOAD KATEGORI
		$this->load->model('Category_model', 'cat');
		$cat = $this->cat->get_formated_data_reverse();

		# SET KOLOM
		$column = array('category_id', 'nama', 'kode_barang', 'reg', 'merk', 'ukuran', 'bahan', 'tahun_pengadaan', 'nomor_pabrik', 'nomor_rangka', 'nomor_mesin', 'nomor_polisi', 'nomor_bpkb', 'asal_usul', 'nilai', 'keterangan');
		$data = $this->trim_array_data($data);
		$final = array();

		# CONVERT
		foreach ($data as $key => $value) {
			foreach ($value as $index => $item) {
				$final[$key][$column[$index]] = !empty($item) ? $item : '';
			}
			$final[$key]['skpd_id'] = $skpd_id;
			$final[$key]['category_id'] = $cat[$final[$key]['category_id']]->id;

			$final[$key]['deleted'] = 0;
		}

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