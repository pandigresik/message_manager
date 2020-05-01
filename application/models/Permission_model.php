<?php
/** Generate by crud generator model pada 2020-04-09 14:12:17
*   Author afandi
*/
class Permission_model extends MY_Model{
    protected $_table = 'permissions';
    
    protected $primary_key = 'id';
    /** this data shown on main table
     *  if your table having foreign key, you can get data on reference column
     *  by references_table.column   
     */
    protected $columnTableData = ['id','name','route','description'];
    protected $headerTableData = [
        [['data' => 'name'],['data' => 'route'],['data' => 'description']]    
    ];
    
    protected $form = [		
		'name' => [
			'id' => 'name',
			'name' => 'name',
			'type' => 'input',
            'label' => 'name',
			'rules' => 'required|max:100',
			                 
        ],
        'route' => [
			'id' => 'route',
			'name' => 'route',
			'type' => 'input',
            'label' => 'route',
			'rules' => 'max:50',			                 
        ],		
		'description' => [
			'id' => 'description',
			'name' => 'description',
			'type' => 'input',
            'label' => 'description',
			'rules' => 'max:100',
			                 
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