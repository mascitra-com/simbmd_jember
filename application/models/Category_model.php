<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Category_model extends MY_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_data($filter = array())
    {
        # BEGIN GET DATA
        $obj    = $this->where(array('deleted'=>0));
        $result = array();

        # FILTER HERE
        if (isset($filter['key'])) {
            $obj->like('nama', $filter['key']);
            $obj->or_like('kode', $filter['key']);
            $obj->or_like('umur_ekonomis', $filter['key']);
            $obj->or_like('batas_kapitalisasi', $filter['key']);
        }

        # GET ALL DATA COUNT FOR PAGINATION
        $tmp = clone $obj->db;
        $result['data_count'] = $tmp->from($this->_table)->count_all_results();

        if (!isset($filter['page'])) {
            $filter['page'] = 1;
        }

        # LIMIT
        $limit = 20;
        $obj->limit($limit, ($filter['page'] - 1) * $limit);
        
        # ORDER
        $obj->order_by('kode', 'ASC');

        $result['data'] = $obj->get_all();

        return $result;
    }

    public function get_formated_data()
    {
    	$result = $this->get_all();
    	$final  = array();

    	foreach ($result as $key => $value) {
    		$final[$value->id] = $value;
    	}

    	return $final;
    }

    public function get_formated_data_reverse()
    {
        $result = $this->get_all();
        $final  = array();

        foreach ($result as $key => $value) {
            $final[$value->kode] = $value;
        }

        return $final;
    }

    public function batch_updates($data)
    {
        foreach ($data as $key => $value) {
            $id = $value['id'];
            unset($value['id']);
            $this->update($id, $value);
        }

        return TRUE;
    }

    public function format_batch_data($data = array())
    {
        $result = array();
        foreach ($data as $key => $value) {
            foreach ($value as $index => $item) {
                $result[$index][$key] = $item;
            }
        }
        return $result;
    }
}