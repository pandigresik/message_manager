<?php
/** Generate by crud generator model pada 2020-04-09 15:22:36
*   Author afandi
*/
class Menu_permission_model extends MY_Model{
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
	private $withPermission = FALSE;
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
    protected $form = [		
		'menu_id' => [
			'id' => 'menu_id',
			'name' => 'menu_id',
			'type' => 'input',
            'label' => 'menu_id',
			'rules' => 'required',
			'class' => 'references hide'
        ],
		'permission_id' => [
			'id' => 'permission_id',
			'name' => 'permission_id',
			'type' => 'dropdown',
            'label' => 'permission_id',
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
        
		$this->load->model('menu_model','fk_menu_id');
		/* adjust second parameter on function dropdown with your column name to show in dropdown */
		/*$dataFk_menu_id = $this->fk_menu_id->dropdown('id','id');
		$this->form['menu_id']['options'] = $dataFk_menu_id;
		*/
		$this->load->model('permission_model','fk_permission_id');
		/* adjust second parameter on function dropdown with your column name to show in dropdown */
		$referenceValue = $this->getReferencesValue();
		if(!empty($referenceValue)){
			$dataFk_permission_id = $this->fk_permission_id->where(['id not in (select permission_id from menu_permissions where menu_id = '.$referenceValue.')'])->dropdown('id','name');
		}else{
			$dataFk_permission_id = $this->fk_permission_id->dropdown('id','name');
		}
		if(!empty($dataFk_permission_id)){
			$this->form['permission_id']['options'] = $dataFk_permission_id;
		}
		
    }
}
?>