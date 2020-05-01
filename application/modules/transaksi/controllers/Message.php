<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/** Generate by crud generator model pada 2020-04-14 14:36:23
*   method index, add, edit, delete, detail dapat dioverride jika ingin melakukan custom pada controller tertentu
*   Author afandi
*/
class Message extends MY_Controller {
    public $title = 'Data Message';

    function __construct(){
        parent::__construct();
        $this->load->model('Message_model','message_model');
        $this->model = $this->message_model;
    }

    public function index($referenceId = null){           
        parent::index($referenceId);
    }    

    public function add($referenceId = null)
    {     
        $this->add_external_js(['assets/js/transaksi/message.js']);
        $this->_formGenerate($references);
    }

    private function getMessageTemplate(){
        $this->load->model('message_template_model','mtm');
        return $this->mtm->dropdown('id','name');
    }

    protected function _formGenerate($data = array(), $where = array())
    {        
        $this->setButtonRight();
        $messageTemplate = $this->getMessageTemplate();
        $targetElmentChange = str_replace('"',"'",json_encode(['text_template' => '#content_template', 'image' => '#image']));                
        $form_options = [						
		'template' => [
			'id' => 'template',
			'name' => 'template',
			'type' => 'dropdown',
            'label' => 'template',
            'class' => 'select2_single',
            'onchange' => "App.setElementValue(this,'master/message_template/searchAjax',".$targetElmentChange.")",
            'options' => [0 => 'Pilih template'] + $messageTemplate,
            'required' => 'required'			                 
        ],	
        'content_template' => [
			'id' => 'content_template',
			'name' => 'content_template',
            'type' => 'textarea',
            'rows' => 3,
            'label' => 'Isi template',            
            'readonly' => 'readonly',
            'required' => 'required'			                 
        ],		
        'image' => [            
            'label' => 'Gambar',
            'type' => 'html',
            'html' => '<img id="image" src=\'#\' class=\'thumbnail\' />',
        ],
        'link' => [            
            'label' => 'Contoh',            
            'type' => 'html',
            'html' => '<a class="btn btn-danger" href="#" data-url="master/message_template/generateCsv" onclick="Message.generateCsvData(this)"><i class="fa fa-file-excel-o"></i> Contoh Data</a>',
        ],
        'source_data' => [
			'id' => 'source_data',
			'name' => 'source_data',
			'type' => 'file',
            'readonly' => 'readonly',
            'value' => '',
            'input_addons' => [
                'pre_html' => '<div class="btn-default btn btn-file">
                                    <span>
                                        <i class="fa fa-file"></i>
                                    </span>',
            ],			                 
        ],
		'send_date' => [
			'id' => 'send_date',
			'name' => 'send_date',
			'type' => 'input',
            'label' => 'Tanggal kirim',
			'required' => 'required',
            'data-tipe' => 'date',
            'data-mindate' => '+0'
        ],
		'submit' => [
            'id' => 'submit',
            'type' => 'submit',
            'label' => 'Generate'
        ]];
    
        $dataForm = array(
            'form_header' => array('data-actiontype' => 'save', 'data-nexturl' => site_url($this->pathView.'/'.$this->actionMethodIndex), 'action' => site_url($this->pathView.'/'.$this->actionMethodSave)),
            'form_options' => $form_options,
        );
        $this->loadView('layout/form', $dataForm);
    }

    public function save()
    {
        $data = json_decode($this->input->post('data'),1);
        $where = json_decode($this->input->post('key'),1);
        $image = $_FILES['attachment'];
        
        $attachment = null;
        if (!empty($image)) {
            $config = array(
                'upload_path' => 'uploads/',
                'allowed_types' => 'csv',
                'max_size' => 10240,
            );
            $attachment = $this->saveAttachment('attachment', $config);
            if (!$attachment['status']) {
                $this->result['message'] = $attachment['data']['error'];
                $this->display_json($this->result);

                return;
            }
            
            $data['attachment'] = $config['upload_path'].$attachment['data']['upload_data']['file_name'];
        }
        
        $this->db->trans_begin();
        /** baca data dari hasil upload */
        $this->load->model('message_template_model', 'mpm');
        $template = $this->mpm->as_array()->get($data['template']);
        $template['send_date'] = $data['send_date'];
        $insertData = $this->getSourceData($data['attachment'], $template);
        $saved = $this->model->insert_many($insertData);                
        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            $this->result['status'] = 1;
            $this->result['message'] = 'Sudah disimpan';
        }

        $this->display_json($this->result);
    }
    /** next can replace with other source data */
    private function getSourceData($filename, $template){
        $result = [];        
        if (($handle = fopen($filename, "r")) !== FALSE) {
            $header = 0;
            while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                if(!$header){
                    $header++;
                    continue;
                }
                $dataText = json_decode($data[0],1);                                
                $destination = $data[1];
                $watermark = $data[2];
                $newImagePath = $template['image'];
                if(!empty($destination)){                    
                    /** set watermark text */
                    if(!empty($watermark)){
                        $tmpImagePath = explode('/',$template['image']);
                        $newImagePath = './uploads/imageMessages/'.rand().'_'.end($tmpImagePath);                        
                        $this->textImage($template['image'],$newImagePath,str_replace("'",'',$watermark));
                    }                    
                    $insertData = [
                        'content' => str_replace(array_keys($dataText), array_values($dataText), $template['text_template']),
                        'image' => $newImagePath,
                        'send_date' => $template['send_date'],
                        'destination' => $destination
                    ];
                    array_push($result,$insertData);                                
                } 
                
            }
            fclose($handle);
        }
        return $result;        
    }

    private function buildMessage($message,$data_array = array()){
        $re = '/:[a-zA-Z]+/mi';                  
		return preg_replace_callback($re, function($m) use($data_array){
              //return is_string($data_array[$m[1]]) ? '\''.$data_array[$m[1]].'\'' : $data_array[$m[1]];
              return $data_array[$m[1]];
		}, $message);
	}

}

