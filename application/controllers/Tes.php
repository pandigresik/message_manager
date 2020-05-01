<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tes extends MX_Controller {

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
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		//$this->load->view('welcome_message');
		//$t = Modules::run('client/sender/send_message',['085733659400'],'percobaan kirim wa');
		
		$filename = 'uploads/imageMessages/1174385613_Screenshot_from_2019-11-01_09-34-122.png';
		//$t = Modules::run('client/sender/send_image',['085733659400'],'percobaan kirim wa gambar',$filename);
		print_r($t->status);
	}
}
