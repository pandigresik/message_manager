<?php
/** Generate by crud generator model pada 2020-04-09 13:25:22
*   Author afandi
*/
class User_role_model extends MY_Model{
    protected $_table = 'user_roles';
    
    protected $primary_key = 'role_id';
    /** this data shown on main table
     *  if your table having foreign key, you can get data on reference column
     *  by references_table.column   
     */
    protected $columnTableData = ['role_id','user_id'];
    protected $headerTableData = [
        [['data' => 'role_id'],['data' => 'user_id']]    
    ];
    
	private $withRole = FALSE;
	private $withUser = FALSE;
	protected $before_get = array('joinRole','joinUser');		
	public function joinRole()
	{
		if($this->getWithRole()){
			$this->_database->join('roles', 'roles.id = user_roles.role_id');				
		}
	}
	/**
	 * Get the value of withRole
	 */ 
	public function getWithRole()
	{
		return $this->withRole;
	}
	/**
	 * Set the value of withRole
	 *
	 * @return  self
	 */ 
	public function setWithRole($withRole)
	{
		$this->withRole = $withRole;
		return $this;
	}		
	public function joinUser()
	{
		if($this->getWithUser()){
			$this->_database->join('users', 'users.id = user_roles.user_id');				
		}
	}
	/**
	 * Get the value of withUser
	 */ 
	public function getWithUser()
	{
		return $this->withUser;
	}
	/**
	 * Set the value of withUser
	 *
	 * @return  self
	 */ 
	public function setWithUser($withUser)
	{
		$this->withUser = $withUser;
		return $this;
	}
    protected $form = [		
		'role_id' => [
			'id' => 'role_id',
			'name' => 'role_id',
			'type' => 'dropdown',
            'label' => 'role_id',
			'rules' => 'required',
			'options' => [],
                'class' => 'select2_single',                 
        ],		
		'user_id' => [
			'id' => 'user_id',
			'name' => 'user_id',
			'type' => 'dropdown',
            'label' => 'user_id',
			'rules' => 'required',
			'options' => [],
                'class' => 'select2_single',                 
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
        
		$this->load->model('role_model','fk_role_id');
		/* adjust second parameter on function dropdown with your column name to show in dropdown */
		$dataFk_role_id = $this->fk_role_id->dropdown('id','id');
		$this->form['role_id']['options'] = $dataFk_role_id;
		$this->load->model('user_model','fk_user_id');
		/* adjust second parameter on function dropdown with your column name to show in dropdown */
		$dataFk_user_id = $this->fk_user_id->dropdown('id','id');
		$this->form['user_id']['options'] = $dataFk_user_id;
    }
}
?>