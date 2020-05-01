<?php
/** Generate by crud generator model pada 2020-04-14 14:36:23
*   Author afandi
*/
class Message_model extends MY_Model{
    protected $_table = 'messages';    
    protected $primary_key = 'id';
    /** this data shown on main table
     *  if your table having foreign key, you can get data on reference column
     *  by references_table.column   
     */
    protected $columnTableData = ['id','content','concat(\'<img class="thumbnail" src="\',image,\'" />\') as image','destination','send_date'];
    protected $headerTableData = [
        [['data' => 'content'],['data' => 'image'],['data' => 'destination'],['data' => 'Tanggal kirim']]    
    ];
    
    protected $form = [		
		'content' => [
			'id' => 'content',
			'name' => 'content',
			'type' => 'input',
            'label' => 'content',
			'rules' => 'required|max:65535',
			                 
        ],		
		'image' => [
			'id' => 'image',
			'name' => 'image',
			'type' => 'input',
            'label' => 'image',
			'rules' => 'required|max:100',
			                 
        ],		
		'destination' => [
			'id' => 'destination',
			'name' => 'destination',
			'type' => 'input',
            'label' => 'destination',
			'rules' => 'required|max:30',
			                 
        ],		
		'send_date' => [
			'id' => 'send_date',
			'name' => 'send_date',
			'type' => 'input',
            'label' => 'send_date',
			'rules' => 'required',			
            'data-tipe' => 'date'                 
        ],
		'submit' => [
            'id' => 'submit',
            'type' => 'submit',
            'label' => 'Simpan'
        ]];
    
    /** function ini untuk memberikan nilai default form,
      * misalkan mengisi data pilihan dropdown dari database dll */
    protected function setOptionDataForm($where = array()){
        parent::setOptionDataForm($where);        
    }

    protected function setOptionDataFormFilter($where = []){        
        parent::setOptionDataFormFilter($where);
        unset($this->formFilter['image']);
    }
}
?>