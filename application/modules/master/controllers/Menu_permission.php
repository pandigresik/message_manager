<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/** Generate by crud generator model pada 2020-04-09 15:22:36
*   method index, add, edit, delete, detail dapat dioverride jika ingin melakukan custom pada controller tertentu
*   Author afandi
*/
class Menu_permission extends MY_Controller {
    public $title = 'Data Permission Menu';
    protected $referenceColumn = 'menu_id';
    function __construct(){
        parent::__construct();
        $this->load->model('Menu_permission_model','menu_permission_model');
        $this->model = $this->menu_permission_model;
    }

    public function index($referenceId = null){
        				
		$this->model->setWithMenus(TRUE);				
        $this->model->setWithPermission(TRUE);   
        $referenceId = $this->checkReferencesId($referenceId);        
        $this->title .= ' '. $this->getTitleMenu($referenceId);
        parent::index($referenceId);
    }
    
    private function getTitleMenu($referenceId){
        $this->load->model('Menu_model', 'mm');
        $menu = $this->mm->fields(['name'])->get($referenceId);
        return $menu->name;
    }
}

