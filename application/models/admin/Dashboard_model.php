<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Dashboard_model extends MY_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_data()
    {
        $queryAssetCount = "SELECT 
        (SELECT COUNT(*) FROM asset_a WHERE deleted = 0) AS jumlah_a,
        (SELECT COUNT(*) FROM asset_b WHERE deleted = 0) AS jumlah_b,
        (SELECT COUNT(*) FROM asset_c WHERE deleted = 0) AS jumlah_c,
        (SELECT COUNT(*) FROM asset_d WHERE deleted = 0) AS jumlah_d,
        (SELECT COUNT(*) FROM asset_e WHERE deleted = 0) AS jumlah_e,
        (SELECT COUNT(*) FROM asset_f WHERE deleted = 0) AS jumlah_f";

        $result = $this->db->query($queryAssetCount)->result_array()[0];
        $data['asset_count'] = array_sum($result);

        $queryAssetSum = "SELECT 
        (SELECT SUM(nilai) FROM asset_a WHERE deleted = 0) AS nilai_a,
        (SELECT SUM(nilai) FROM asset_b WHERE deleted = 0) AS nilai_b,
        (SELECT SUM(nilai) FROM asset_c WHERE deleted = 0) AS nilai_c,
        (SELECT SUM(nilai) FROM asset_d WHERE deleted = 0) AS nilai_d,
        (SELECT SUM(nilai) FROM asset_e WHERE deleted = 0) AS nilai_e,
        (SELECT SUM(nilai) FROM asset_f WHERE deleted = 0) AS nilai_f";

        $result = $this->db->query($queryAssetSum)->result_array()[0];
        $data['asset_sum'] = array_sum($result);

        $this->load->model("admin/Approval_model", "approval");
        $tmp['update'] = count($this->approval->get_data('ON_UPDATE'));
        $tmp['delete'] = count($this->approval->get_data('ON_DELETE'));
        $tmp['insert'] = $this->db->query("SELECT COUNT(*) AS jumlah FROM proposals WHERE deleted = 0")->result()[0]->jumlah;

        $data['proposal_count'] = array_sum($tmp);

        $querySkpd         = "SELECT COUNT(*) AS jumlah FROM skpds";
        $data['skpd_count'] = $this->db->query($querySkpd)->result()[0]->jumlah;

        return $data;
    }
}