<?php
/** Generate by crud generator model pada 2020-04-09 15:22:36
*   Author afandi
*/
class Menu_permission_permission_model extends MY_Model{
    protected $_table = 'menu_permissions';
    
    protected $primary_key = 'id';
    /** this data shown on main table
     *  if your table having foreign key, you can get data on reference column
     *  by references_table.column   
     */
    protected $columnTableData = ['menu_permissions.id','permissions.name as permissions'];
    protected $headerTableData = [
        [['data' => 'permission']]    
    ];
    
	private $withMenus = FALSE;
	private $withPermission = TRUE;
	protected $before_get = array('joinMenus','joinPermission');		
	public function joinMenus()
	{
		if($this->getWithMenus()){
			$this->_database->join('menus', 'menus.id = menu_permissions.menu_id');				
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
	public function joinPermission()
	{
		if($this->getWithPermission()){
			$this->fields(['menu_permissions.id','permissions.route','permissions.name']);
			$this->_database->join('permissions', 'permissions.id = menu_permissions.permission_id');				
		}
	}
	/**
	 * Get the value of withPermission
	 */ 
	public function getWithPermission()
	{
		return $this->withPermission;
	}
	/**
	 * Set the value of withPermission
	 *
	 * @return  self
	 */ 
	public function setWithPermission($withPermission)
	{
		$this->withPermission = $withPermission;
		return $this;
	}    
}
?>