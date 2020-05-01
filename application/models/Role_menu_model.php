<?php
/** Generate by crud generator model pada 2020-04-11 08:57:49
*   Author afandi
*/
class Role_menu_model extends MY_Model{
    protected $_table = 'role_menus';
    
    protected $primary_key = 'role_id';
    /** this data shown on main table
     *  if your table having foreign key, you can get data on reference column
     *  by references_table.column   
     */
    protected $columnTableData = ['role_id','role_id','menu_id'];
    protected $headerTableData = [
        [['data' => 'role_id'],['data' => 'menu_id']]    
    ];
    
	private $withRole = FALSE;
	private $withMenus = FALSE;
	protected $before_get = array('joinRole','joinMenus');		
	public function joinRole()
	{
		if($this->getWithRole()){
			$this->_database->join('roles', 'roles.id = role_menus.role_id');				
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
	public function joinMenus()
	{
		if($this->getWithMenus()){
			$this->_database->join('menus', 'menus.id = role_menus.menu_id');				
		}
	}
	/**
	 * Get the value of withMenus
	 */ 
	public function getWithMenus()
	{
		return $this->withMenus;
	}
	/**
	 * Set the value of withMenus
	 *
	 * @return  self
	 */ 
	public function setWithMenus($withMenus)
	{
		$this->withMenus = $withMenus;
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
		'menu_id' => [
			'id' => 'menu_id',
			'name' => 'menu_id',
			'type' => 'dropdown',
            'label' => 'menu_id',
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
		$dataFk_role_id = $this->fk_role_id->dropdown('id','name');
		$this->form['role_id']['options'] = $dataFk_role_id;
		$this->load->model('menus_model','fk_menu_id');
		/* adjust second parameter on function dropdown with your column name to show in dropdown */
		$dataFk_menu_id = $this->fk_menu_id->dropdown('id','name');
		$this->form['menu_id']['options'] = $dataFk_menu_id;
    }
}
?>