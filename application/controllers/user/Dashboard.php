<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	public $class_belongs_to = 'user';

	public function __construct()
	{
		parent::__construct();
		$this->load->model("user/Dashboard_model", "dashboard");
	}

	public function index()
	{
		$data['insight'] = $this->dashboard->get_data();
		$this->render('modules/user/index', $data);
	}
}