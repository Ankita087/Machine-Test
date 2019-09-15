<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->library('form_validation');
		$this->load->helper('form');

		$this->form_validation->set_rules("email","Email ID","required|callback_eval");
		$this->form_validation->set_rules("password","Password","required|callback_passValidator");// ek validaor bnaya
		$this->form_validation->set_message('eval','email must be in correct format!');
		$this->form_validation->set_message('passValidator', 'Incorrect username/password.');

		if ($this->form_validation->run() == FALSE)
		{
				$this->load->view('login_form');
		}
		else
		{
				$this->load->view('formsuccess');
		}
	}
	// public function passValidator($str) {
	// 	if($str != 'ankita') {
	// 		return false;
	// 	}
	// 	return true;
	// }
	public function eval($str) {
		if(preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) {
			return true;
		}
		return false;
	}

	public function passValidator() 
    {
        $this->load->model('Login');  // jo login model ko call krega  
        if ($this->Login->log_in_correctly())  // login model ka log_in_co
        {  
            return true;  
        } else {  
            return false;  
        }  
    }  
}
