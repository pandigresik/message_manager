<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/** Generate by crud generator model pada 2020-04-09 13:25:06
*   method index, add, edit, delete, detail dapat dioverride jika ingin melakukan custom pada controller tertentu
*   Author afandi
*/
class Role_menu extends MY_Controller {
    public $title = 'Data Role_menu';

    function __construct(){
        parent::__construct();
        $this->load->model('Role_menu_model','role_menu_model');
        $this->model = $this->role_menu_model;
    }

    public function index($referenceId = null){
        				
		$this->model->setWithRole(TRUE);				
		$this->model->setWithMenus(TRUE);   
        parent::index($referenceId);
    }    
}

