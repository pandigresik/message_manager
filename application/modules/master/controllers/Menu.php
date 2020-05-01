<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/** Generate by crud generator model pada 2020-04-09 13:27:27
*   method index, add, edit, delete, detail dapat dioverride jika ingin melakukan custom pada controller tertentu
*   Author afandi
*/
class Menu extends MY_Controller {
    public $title = 'Data Menu';

    function __construct(){
        parent::__construct();
        $this->load->model('Menu_model','menu_model');
        $this->model = $this->menu_model;
    }

    public function index($referenceId = null){
        				
		$this->model->setWithMenus(TRUE);   
        parent::index($referenceId);
    }    

    public function setTableConfig()
    {
        parent::setTableConfig();
        $this->table->extra_columns = [
            'btnEdit' => [
                    'data' => generatePrimaryButton('<i class="fa fa-pencil"></i>', ['onclick' => 'App.editRecord(this)', 'data-url' => site_url($this->pathView.'/'.$this->actionMethodEdit)])
                    .' '.generateDangerButton('<i class="fa fa-recycle"></i>', ['onclick' => 'App.deleteRecord(this)', 'data-urlmessage' => site_url($this->pathView.'/deleteMessage'), 'data-nexturl' => site_url($this->pathView.'/'.$this->actionMethodIndex), 'data-url' => site_url($this->pathView.'/'.$this->actionMethodDelete)])
                    .' '.generateSuccessButton('<i class="fa fa-lock"></i>', ['onclick' => 'App.detailRecord(this)', 'data-nexturl' => site_url($this->pathView.'/'.$this->actionMethodIndex), 'data-url' => site_url('master/menu_permission')])
                    
                ],
        ];
    }
}

