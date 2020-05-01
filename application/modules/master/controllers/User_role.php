<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/** Generate by crud generator model pada 2020-04-09 13:25:22
*   method index, add, edit, delete, detail dapat dioverride jika ingin melakukan custom pada controller tertentu
*   Author afandi
*/
class User_role extends MY_Controller {
    public $title = 'Data User_role';

    function __construct(){
        parent::__construct();
        $this->load->model('User_role_model','user_role_model');
        $this->model = $this->user_role_model;
    }

    public function index($referenceId = null){
        				
		$this->model->setWithRole(TRUE);				
		$this->model->setWithUser(TRUE);   
        parent::index($referenceId);
    }    
}

