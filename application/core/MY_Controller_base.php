<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller_base extends CI_Controller {

	public $class_belongs_to;

	public function __construct()
	{
		parent::__construct();
		$this->init();
	}

	private function init()
	{
		date_default_timezone_set('Asia/Jakarta');
	}

	protected function render($view, $data = array())
	{
		$data['csrf']   = $this->get_csrf();
		$data['notif']  = $this->get_notification();
		$data['access'] = $this->class_belongs_to;
		
		$this->blade->render($view, $data);
	}

	protected function go($link = '')
	{
		redirect(site_url($link));
	}

	protected function message($message, $message_type = 'info')
	{
		$this->session->set_flashdata('message', array($message,$message_type));
	}

	private function get_csrf()
	{
		$csrf_name  = $this->security->get_csrf_token_name();
		$csrf_token = $this->security->get_csrf_hash();
		return "<input type='hidden' name='{$csrf_name}' value='{$csrf_token}'>";
	}

	private function get_notification()
	{
		$this->load->model("Notification_model", "notif");
		return $this->notif->get_data($this->class_belongs_to);
	}

	protected function get_pagination($total = 0, $limit = 20, $filter = array(), $base_url = null) {
		$this->load->library('pagination');
		$url = ($base_url !== null) ? $base_url : 'admin/'.strtolower(get_class($this));
		$url.='?ref=true';
		unset($filter['page'], $filter['ref']);

		if (!empty($filter)) {
			foreach ($filter as $key => $value) {
				if (! empty($value) OR $value === '0') {
					$url .= '&'.$key.'='.$value;
				}
			}
		}

        # base config
		$config['base_url']   = site_url($url);
		$config['total_rows'] = $total;
		$config['per_page']   = $limit;
		$config['page_query_string'] 	= TRUE;
		$config['enable_query_strings'] = TRUE;
		$config['use_page_numbers'] 	= TRUE;
		$config['query_string_segment'] = 'page';

        # styling
        $config['attributes'] 		= array('class' => 'page-link');
		$config['full_tag_open']    = "<nav><ul class='pagination'>";
		$config['full_tag_close']   = "</ul></nav>";
		$config['num_tag_open']     = "<li class='page-item'>";
		$config['num_tag_close']    = "</li>";
		$config['first_tag_open']   = "<li class='page-item'>";
		$config['first_tag_close']  = "</li>";
		$config['last_tag_open']    = "<li class='page-item'>";
		$config['last_tag_close']   = "</li>";
		$config['next_tag_open']    = "<li class='page-item'>";
		$config['next_tag_close']   = "</li>";
		$config['prev_tag_open']    = "<li class='page-item'>";
		$config['prev_tag_close']   = "</li>";
		$config['cur_tag_open']     = "<li class='page-item active'><a class='page-link'>";
		$config['cur_tag_close']    = "</a></li>";
		$this->pagination->initialize($config);
		return $this->pagination->create_links();
	}
}