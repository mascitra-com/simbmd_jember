<?php (defined("BASEPATH")) OR exit("No direct script access allowed");

class User_model extends MY_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_data($filter = array())
	{
		# BEGIN GET DATA
		$result = array();
		$obj    = $this->where(array("{$this->_table}.deleted"=>0));
		$obj->select("{$this->_table}.*, skpds.name AS skpd");
		$obj->join("skpds", "skpds.id = {$this->_table}.skpd_id");

		# FILTER HERE
		if (isset($filter["key"])) {
			$obj->like("{$this->_table}.name", $filter["key"]);
			$obj->or_like("skpds.name", $filter["key"]);
			$obj->or_like("email", $filter["key"]);
			$obj->or_like("username", $filter["key"]);
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
		$obj->order_by("id", "ASC");

		$result["data"] = $obj->get_all();

		return $result;
	}
}