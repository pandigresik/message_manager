<?php
/** Generate by crud generator model pada 2020-04-09 12:50:32
*   Author afandi
*/
class Role_model extends MY_Model{
    protected $_table = 'roles';
    
    protected $primary_key = 'id';
    /** this data shown on main table
     *  if your table having foreign key, you can get data on reference column
     *  by references_table.column   
     */
    protected $columnTableData = ['id','name','description'];
    protected $headerTableData = [
        [['data' => 'name'],['data' => 'description']]    
    ];
    
    protected $form = [		
		'name' => [
			'id' => 'name',
			'name' => 'name',
			'type' => 'input',
            'label' => 'name',
			'rules' => 'required|max:50',
			                 
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