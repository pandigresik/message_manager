<?php
/** Generate by crud generator model pada 2020-04-09 14:21:26
*   Author afandi
*/
class Setting_model extends MY_Model{
    protected $_table = 'settings';
    
    protected $primary_key = 'id';
    /** this data shown on main table
     *  if your table having foreign key, you can get data on reference column
     *  by references_table.column   
     */
    protected $columnTableData = ['id','name','type','value'];
    protected $headerTableData = [
        [['data' => 'name'],['data' => 'type'],['data' => 'value']]    
    ];
    
    protected $form = [		
		'name' => [
			'id' => 'name',
			'name' => 'name',
			'type' => 'input',
            'label' => 'name',
			'rules' => 'required|max:60',
			                 
        ],		
		'type' => [
			'id' => 'type',
			'name' => 'type',
			'type' => 'input',
            'label' => 'type',
			'rules' => 'required|max:40',
			                 
        ],		
		'value' => [
			'id' => 'value',
			'name' => 'value',
			'type' => 'input',
            'label' => 'value',
			'rules' => 'required|max:80',
			                 
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
}
?>