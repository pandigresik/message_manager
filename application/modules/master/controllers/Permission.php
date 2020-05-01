<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/** Generate by crud generator model pada 2020-04-09 14:12:17
*   method index, add, edit, delete, detail dapat dioverride jika ingin melakukan custom pada controller tertentu
*   Author afandi
*/
class Permission extends MY_Controller {
    public $title = 'Data Permission';

    function __construct(){
        parent::__construct();
        $this->load->model('Permission_model','permission_model');
        $this->model = $this->permission_model;
    }

    public function index($referenceId = null){
           
        parent::index($referenceId);
    }    
}

