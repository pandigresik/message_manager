<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/** Generate by crud generator model pada 2020-04-14 11:32:34
*   method index, add, edit, delete, detail dapat dioverride jika ingin melakukan custom pada controller tertentu
*   Author afandi
*/
class Message_template extends MY_Controller {
    public $title = 'Data Message_template';

    function __construct(){
        parent::__construct();
        $this->load->model('Message_template_model','message_template_model');
        $this->model = $this->message_template_model;
    }

    public function index($referenceId = null){
           
        parent::index($referenceId);
    }        

    public function generateCsv(){
        $str = $this->input->post('key');
        $re = '/:[a-zA-Z]+/m';                        
        preg_match_all($re, $str, $matches, PREG_SET_ORDER, 0);
        // Print the entire match result        

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=example.csv');
        $output = fopen('php://output', 'w');
        fputcsv($output,['data','destination','watermark'],';',"'");

        if(!empty($matches)){
            $data = ['data' => [],'destination' => 'your_number_destination','watermark' => 'watermark'];
            
            foreach($matches as $m){    
                $_key = str_replace('"',"'",$m[0]);                            
                $data['data'][$_key] = 'value_'.$_key;                
            }                        
            
            fputcsv($output,[json_encode($data['data']),$data['destination'], $data['watermark']],';',"'");
        }                
    }
}

