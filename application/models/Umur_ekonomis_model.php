<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Umur_ekonomis_model extends MY_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_tahun($kode, $persentase)
    {
    	$where  = array('kode_kategori'=>$kode, 'awal<='=>$persentase, 'akhir>='=>$persentase);
    	$result = $this->get_by($where);

    	if ($result) {
    		return $result->tahun;
    	}

    	return 0;
    }
}