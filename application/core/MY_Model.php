<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model extends MY_Model_base {

    public $before_create = array( 'timestamps_create' );
    public $before_update = array( 'timestamps_update' );
    
    public function __construct()
    {
        parent::__construct();
    }

    public function select($field) {
        $this->_database->select($field);
        return $this;
    }

    public function join($with, $on) {
        $this->_database->join($with, $on);
        return $this;
    }

    public function like($field, $match = '', $side = 'both', $escape = NULL) {
        $this->_database->like($field, $match, $side, $escape);
        return $this;
    }

    public function or_like($field, $match = '', $side = 'both', $escape = NULL) {
        $this->_database->or_like($field, $match, $side, $escape);
        return $this;
    }

    public function where($field, $match = '') {
        $this->_database->where($field, $match);
        return $this;
    }

    public function where_in($field, $match = '') {
        $this->_database->where_in($field, $match);
        return $this;
    }

    public function batch_insert($data)
    {
        return $this->db->insert_batch($this->_table, $data);
    }

    public function batch_update($id, $data)
    {
        $this->db->where_in('id', $id);
        return $this->db->update($this->_table, $data);
    }

    public function batch_delete($id)
    {
        $this->db->where_in('id', $id);
        return $this->db->delete($this->_table);
    }

    protected function timestamps_create($data)
    {
        $data['created_at'] = $data['updated_at'] = date('Y-m-d H:i:s');
        return $data;
    }

    protected function timestamps_update($data)
    {
        $data['updated_at'] = date('Y-m-d H:i:s');
        return $data;
    }

    protected function fill_empty($data)
    {
        foreach ($data as $key => $value) {
            foreach ($value as $index => $item) {
                if (empty($item) && $item !== '0') {
                    $data[$key]->{$index} = '-';
                }
            }
        }
        return $data;
    }

    public function strip_filter($data) {
        foreach ($data as $index => $item) {
            if (empty($item) && $item !== '0') {
                unset($data[$index]);
            }
        }
        return $data;
    }
}