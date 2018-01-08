<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Approval_model extends MY_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_data($status)
    {
    	$query_a = "SELECT skpd_id, COUNT(*) AS jumlah, CONCAT('a') as jenis_aset FROM asset_a WHERE status = '{$status}' AND deleted = 0 GROUP BY skpd_id";
        $query_b = "SELECT skpd_id, COUNT(*) AS jumlah, CONCAT('b') as jenis_aset FROM asset_b WHERE status = '{$status}' AND deleted = 0 GROUP BY skpd_id";
        $query_c = "SELECT skpd_id, COUNT(*) AS jumlah, CONCAT('c') as jenis_aset FROM asset_c WHERE status = '{$status}' AND deleted = 0 GROUP BY skpd_id";
    	$query_d = "SELECT skpd_id, COUNT(*) AS jumlah, CONCAT('d') as jenis_aset FROM asset_d WHERE status = '{$status}' AND deleted = 0 GROUP BY skpd_id";
    	$query_e = "SELECT skpd_id, COUNT(*) AS jumlah, CONCAT('e') as jenis_aset FROM asset_e WHERE status = '{$status}' AND deleted = 0 GROUP BY skpd_id";
    	$query_f = "SELECT skpd_id, COUNT(*) AS jumlah, CONCAT('f') as jenis_aset FROM asset_f WHERE status = '{$status}' AND deleted = 0 GROUP BY skpd_id";
    	$query 	 = "SELECT a.*, skpds.name AS skpd FROM ({$query_a} UNION {$query_b} UNION {$query_c} UNION {$query_d} UNION {$query_e} UNION {$query_f}) AS a JOIN skpds ON skpd_id = skpds.id ORDER BY skpd_id, jenis_aset";

    	return $this->db->query($query)->result();
    }
}