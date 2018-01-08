<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Notification_model extends MY_Model {

	public function __construct() {
		parent::__construct();
	}

	public function get_data($for = "admin")
	{
		switch ($for) {
			case 'admin':
				$this->load->model("admin/Approval_model", "approval");
				$data['ON_INSERT'] = count($this->approval->get_data('ON_INSERT'));
				$data['ON_UPDATE'] = count($this->approval->get_data('ON_UPDATE'));
				$data['ON_DELETE'] = count($this->approval->get_data('ON_DELETE'));
				$data['ON_EXCHANGE'] = count($this->approval->get_data('ON_EXCHANGE'));
				$data['ON_IMPORT'] = $this->db->query("SELECT COUNT(*) AS jumlah FROM proposals WHERE deleted = 0")->result()[0]->jumlah;
				return $data;
			case 'user':
				$this->load->model("admin/Approval_model", "approval");
				$data['ON_UPDATE'] = count($this->approval->get_data('ON_UPDATE'));
				$data['ON_DELETE'] = count($this->approval->get_data('ON_DELETE'));
				$data['ON_INSERT'] = $this->db->query("SELECT COUNT(*) AS jumlah FROM proposals WHERE deleted = 0")->result()[0]->jumlah;
				return $data;
			default:
				return array();
				break;
		}
	}
}