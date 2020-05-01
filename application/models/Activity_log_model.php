<?php
/** Generate by crud generator model pada 2020-04-08 14:25:46
*   Author afandi
*/
class Activity_log_model extends MY_Model{
    protected $_table = 'activity_log';
    
    protected $primary_key = 'id';
    protected $columnTableData = ['route','send_data','comment'];
    protected $headerTableData = [				[['data' => 'route'],['data' => 'send_data'],['data' => 'comment']]];

    protected $form = [			'route' => [
				'id' => 'route',
				'label' => 'route',
				'placeholder' => 'Isikan route',
				'type' => 'input',
				'value' => '',	
				'required' => 'required'	
			]	,			'send_data' => [
				'id' => 'send_data',
				'label' => 'send_data',
				'placeholder' => 'Isikan send_data',
				'type' => 'input',
				'value' => '',	
				'required' => 'required'	
			]	,			'comment' => [
				'id' => 'comment',
				'label' => 'comment',
				'placeholder' => 'Isikan comment',
				'type' => 'input',
				'value' => '',	
				'required' => 'required'	
			]	,
		'submit' => [
            'id' => 'submit',
            'type' => 'submit',
            'label' => 'Simpan'
        ]];

    /** uncomment function ini untuk memberikan nilai default form,
      * misalkan mengisi data pilihan dropdown dari database dll
    protected function setOptionDataForm($where = array()){
        $parentMenu = $this->active()->get(['id','name'])->lists('name','id');
        $parentMenu[0] = 'Menu Utama';
        ksort($parentMenu);
        $this->form['parent_id']['options'] = $parentMenu;
    }
    */
}
?>