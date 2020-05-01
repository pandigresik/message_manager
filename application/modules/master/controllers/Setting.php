<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/** Generate by crud generator model pada 2020-04-09 14:21:26
*   method index, add, edit, delete, detail dapat dioverride jika ingin melakukan custom pada controller tertentu
*   Author afandi
*/
class Setting extends MY_Controller {
    public $title = 'Data Setting';

    function __construct(){
        parent::__construct();
        $this->load->model('Setting_model','setting_model');
        $this->model = $this->setting_model;
    }

    public function index($referenceId = null){
           
        parent::index($referenceId);
    }    
}

