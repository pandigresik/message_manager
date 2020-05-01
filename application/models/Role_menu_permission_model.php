<?php
/** Generate by crud generator model pada 2020-04-09 15:22:50
*   Author afandi
*/
class Role_menu_permission_model extends MY_Model{
    protected $_table = 'role_menu_permissions';
    
    protected $primary_key = 'id';
    /** this data shown on main table
     *  if your table having foreign key, you can get data on reference column
     *  by references_table.column   
     */
    protected $columnTableData = ['role_menu_permissions.id','role_id','menu_permission_id'];
    protected $headerTableData = [
        [['data' => 'role_id'],['data' => 'menu_permission_id']]    
    ];
    
	private $withRole = FALSE;
	private $withMenuPermission = FALSE;
	protected $before_get = array('joinRole','joinMenuPermission');		
	public function joinRole()
	{
		if($this->getWithRole()){
			$this->_database->join('roles', 'roles.id = role_menu_permissions.role_id');				
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
	public function joinMenuPermission()
	{
		if($this->getWithMenuPermission()){
			$this->_database->join('menu_permissions', 'menu_permissions.id = role_menu_permissions.menu_permission_id');				
		}
	}
	/**
	 * Get the value of withMenuPermission
	 */ 
	public function getWithMenuPermission()
	{
		return $this->withMenuPermission;
	}
	/**
	 * Set the value of withMenuPermission
	 *
	 * @return  self
	 */ 
	public function setWithMenuPermission($withMenuPermission)
	{
		$this->withMenuPermission = $withMenuPermission;
		return $this;
	}
    protected $form = [		
		'role_id' => [
			'id' => 'role_id',
			'name' => 'role_id',
			'type' => 'dropdown',
            'label' => 'role_id',
			'rules' => 'required',
			'options' => [''],
            'class' => 'select2_single',                 
        ],		
		'menu_permission_id' => [
			'id' => 'menu_permission_id',
			'name' => 'menu_permission_id',
			'type' => 'dropdown',
            'label' => 'menu_permission_id',
			'rules' => 'required',
			'options' => [''],
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
		if(!empty($dataFk_role_id)){
			$this->form['role_id']['options'] = $dataFk_role_id;
		}
		
		$this->load->model('menu_permission_model','fk_menu_permission_id');
		/* adjust second parameter on function dropdown with your column name to show in dropdown */
		$dataFk_menu_permission_id = $this->fk_menu_permission_id->dropdown('id','id');
		if(!empty($dataFk_menu_permission_id)){
			$this->form['menu_permission_id']['options'] = $dataFk_menu_permission_id;
		}		
    }
}
?>