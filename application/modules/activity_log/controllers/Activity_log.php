<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/** Generate by crud generator model pada 2020-04-08 14:25:46
*   method index, add, edit, delete, detail dapat dioverride jika ingin melakukan custom pada controller tertentu
*   Author afandi
*/
class Activity_log extends MY_Controller {
    public $title = 'Data Activity_log';

    function __construct(){
        parent::__construct();
        $this->load->model('Activity_log_model','activity_log_model');
        $this->model = $this->activity_log_model;
    }
}

