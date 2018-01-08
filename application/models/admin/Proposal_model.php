<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Proposal_model extends MY_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_data()
    {
    	$obj = $this;
    	$obj->select("proposals.*, skpds.name AS skpd");
    	$obj->where(array('proposals.deleted'=>0));
    	$obj->join('skpds', 'skpds.id = proposals.skpd_id');
    	return $obj->get_all();
    }
}