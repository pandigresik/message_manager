<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sender extends Client_Controller{
    
    function __construct(){
        parent::__construct();
        $config = $this->config->item('ws');        
        $this->rest->http_header('Authorization',$config['token']);
        $this->rest->http_header('Accept','application/json');
    }

	public function send_message($recipients, $message){        
        $data = [
            'phone'     => implode(", ", $recipients),
            'message'   => $message,            
        ];
        
        //$this->rest->debug();
        $result = $this->rest->post('send-message',$data);                
		return $result;
    }
    
    public function send_image($recipients, $message, $filename){
        $base64 = base64_encode(file_get_contents($filename));        
        $data = [
            'phone'     => implode(", ", $recipients),
            'caption'   => $message,            
            'file'      => $base64,
            'data'      => json_encode(['name' => $filename])
        ];
              
        $result = $this->rest->post('send-image-from-local',$data);                
        
		return $result;
    }
    
}
