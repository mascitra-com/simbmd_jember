<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends MY_Controller_base {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Auth_model', 'auth');
	}

	public function _remap($method, $params = array())
	{
		if (method_exists($this, $method))
		{
			if ($this->auth->is_loggedin()) 
			{
				if ($this->auth->is_allowed($this->class_belongs_to)) 
				{
					return call_user_func_array(array($this, $method), $params);
				} 
				else
				{
					show_404();
				}
			}
			else
			{
				$this->go('masuk');
			}
		}
		show_404();
	}
}
