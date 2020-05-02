<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/** Generate by crud generator model pada 2020-04-14 14:36:23
*   method index, add, edit, delete, detail dapat dioverride jika ingin melakukan custom pada controller tertentu
*   Author afandi
*/

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Promise\EachPromise;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\RequestException;

class SendMessage extends MY_Controller {
    public $title = 'Data Message';
    private $successSend = 0;
    const BELUM_KIRIM = 0;
    function __construct(){
        parent::__construct();
        $this->load->model('Message_model','message_model');
        $this->model = $this->message_model;   
        $this->addFilters(NULL,'send_date <= \''.date('Y-m-d').'\'');
        $this->addFilters('send_status',self::BELUM_KIRIM);                                    
    }

    public function index($referenceId = null){        
        parent::index($referenceId);
    }    

    protected function setBtnAdd($key = null)
    {
        if ($this->getTransaction()) {
            $text = ucwords(str_replace('_', ' ', $this->aliasClass));
            $urlUpdateAction = empty($key) ? $this->pathView.'/send' : $this->pathView.'/send/'.$key ;
            $urlUpdateMessage = $this->pathView.'/updateMessage';
            $nextUrl = $this->pathView.'/index';
            $config = ['onclick' => 'App.postRequest(\''.site_url($urlUpdateAction).'\',{},\''.site_url($nextUrl).'\')','class' => 'btn btn-dark active'];
            return generateButton($text, $config, '<i class="fa fa-send-o"></i>');
        } else {
            return '';
        }
    }

    public function updateMessage()
    {        
        $where = $this->getFilters();
        $total = $this->model->count_by($where);
        echo $total.' pesan akan dikirim, apakah anda setuju ?';
    }

    public function send()
    {                        
        $where = $this->getFilters();
        $sendData = $this->model->as_array()->get_many_by($where);
        if(!empty($sendData)){
            $promiseWait = $this->build_request($sendData);
            
            $promiseWait->promise()->wait();
            /*foreach($sendData as $data){
                // send to destination
                if(!empty($data['destination'])){
                    if(!empty($data['image'])){
                        $sendMessage = Modules::run('client/sender/send_message',[$data['destination']],$data['content']);
                    }else{
                        $sendMessage = Modules::run('client/sender/send_image',[$data['destination']],$data['content'],$data['image']);
                    }
                    log_message('error', 'proses '. json_encode($sendMessage));
                    if($sendMessage->status){
                        $this->model->update($data['id'],['send_status' => 1, 'updated_at' => date('Y-m-d H:i:s')]);
                        $successSend++;
                    }else{
                        log_message('error', json_encode($sendMessage));
                    }                    
                }                                                
            }*/
        }
        
        //$saved = $this->model->insert_many($insertData);                

        $this->result['status'] = 1;
        $this->result['message'] = $this->successSend.' sudah dikirim';
        $this->display_json($this->result);
    }

    private function build_request($lists){
        $this->load->config('serverws');
        $config = $this->config->item('ws');        
        $promises = (function () use ($lists, $config) {
        $header = [
            //"User-Agent"  => "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.90 Safari/537.36",
            //"Content-Type" => "application/x-www-form-urlencoded"
            'Accept' => 'application/json',
            'Authorization' => $config['token']
        ];	
        $client = new Client(['cookies' => true, 'headers' => $header]);                
        foreach ($lists as $list) {        	                        
            $dataPost = ['form_params' => [ 'phone' => $list['destination']]];
            if(!empty($list['image'])){
                $base64 = base64_encode(file_get_contents($list['image'])); 
                $dataPost['form_params']['file'] = $base64;
                $dataPost['form_params']['caption'] = $list['content'];
                $dataPost['form_params']['data'] = json_encode(['name' => $list['image']]);                

                $urlPost = $config['server'].'send-image-from-local';
            }else{
                $dataPost['form_params']['message'] = $list['content'];
                
                $urlPost = $config['server'].'send-message';
            }
            $idMessage = $list['id'];
            
            //log_message('error', json_encode($dataPost));
            yield $client->requestAsync('POST',$urlPost,$dataPost)
                ->then(function (Response $response) use ($idMessage) {								
                    //log_message('error',$response->getBody()->getContents());
                    $html['data'] = $response->getBody()->getContents();     
                    $html['id'] = $idMessage;           
                    return $html;
                });
            }
        })();

        return new EachPromise($promises, [
            'concurrency' => 10,
            'fulfilled' => function (array $html) {
                log_message('error',json_encode($html['data']));
                $this->model->update($html['id'],['send_status' => 1, 'updated_at' => date('Y-m-d H:i:s')]);
                $this->successSend++;
            },
            'rejected' => function ($reason) {
                log_message('error','reject ' .$reason);
            },
        ]);        
    }
}

