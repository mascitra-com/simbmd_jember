<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Auth_model extends MY_Model {

	protected $ip_adress;
	public $_table = 'users';

	public function __construct() {
		parent::__construct();
		$this->ip_address = $this->input->ip_address();
	}

	public function do_logout()
	{
		$this->session->sess_destroy();
	}

	public function authenticate($data = array())
	{

		if ($this->_is_empty($data)) {
			return FALSE;
		}

		$username = $data['username'];
		$password = $data['password'];

		$result = $this->auth->get_by(array('username' => $username));

		if (!empty($result)) {
			if (password_verify($password, $result->password)) {
				# GET ADDITIONAL DATA
				$this->load->model('Skpd_model', 'skpd');
				$result->skpd = $this->skpd->get($result->skpd_id);
    			# SET ATTEMPT
				$this->_set_attempt(1);
    			# SET SESSION
				$this->_set_session($result);
    			# SET LAST LOGIN
				$this->_set_last_login($result->id);

				return TRUE;
			}
		}

		# SET ATTEMP
		$this->_set_attempt(0);
		return FALSE;
	}

	public function is_loggedin()
	{
		if ($this->session->has_userdata('auth')) {
			$data = $this->session->auth;
			if (isset($data['is_loggedin']) && $data['is_loggedin']===TRUE) {
				return TRUE;
			}
		}

		return FALSE;
	}

	public function is_allowed($class_belongs_to)
	{
		$admin_status = $this->get_admin_status();
		if ($class_belongs_to === 'user' &&  $admin_status === '0') {
			return TRUE;
		}
		
		if ($class_belongs_to === 'admin' && $admin_status === '1') {
			return TRUE;
		}

		return FALSE;
	}

	public function get_id()
	{
		if ($this->session->has_userdata('auth')) {
			$data = $this->session->auth;
			if (isset($data['id']) && !empty($data['id'])) {
				return $data['id'];
			}
		}

		return '';
	}

	public function get_skpd_id()
	{
		if ($this->session->has_userdata('auth')) {
			$data = $this->session->auth;
			if (isset($data['skpd_id']) && !empty($data['skpd_id'])) {
				return $data['skpd_id'];
			}
		}

		return '';
	}

	public function get_admin_status()
	{
		if ($this->session->has_userdata('auth')) {
			$data = $this->session->auth;
			if (isset($data['is_admin']) && !empty($data['is_admin']) OR $data['is_admin'] === '0') {
				return $data['is_admin'];
			}
		}

		return;
	}

	private function _set_session($data)
	{
		$this->session->unset_userdata('auth');
		$data = array(
			'is_loggedin'=>TRUE,
			'ip_address'=>$this->ip_address,
			'id'=>$data->id,
			'name'=>$data->name,
			'skpd_id'=>$data->skpd_id,
			'is_admin'=>$data->skpd->is_admin
			);
		$this->session->set_userdata('auth', $data);
	}

	private function _set_last_login($id)
	{
		$this->auth->update($id, array('last_login'=>date('Y-m-d h:i:s')));
	}

	private function _set_attempt($status)
	{
		$data = array('ip_address'=>$this->ip_address, 'status'=>$status, 'date'=>date('Y-m-d h:i:s'));
		$this->db->insert('login_attempts', $data);
	}

	private function _is_empty($data)
	{
		return empty($data) OR !isset($data['username']) OR !isset($data['password']) OR empty($data['username']) OR empty($data['password']);
	}
}