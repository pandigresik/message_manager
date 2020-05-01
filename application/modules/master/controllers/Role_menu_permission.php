<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/** Generate by crud generator model pada 2020-04-09 15:22:50
*   method index, add, edit, delete, detail dapat dioverride jika ingin melakukan custom pada controller tertentu
*   Author afandi
*/
class Role_menu_permission extends MY_Controller {
    public $title = 'Data Menu Role ';
    protected $viewPage = [
        'index' => 'partial/default_form',
    ];
    function __construct(){
        parent::__construct();
        $this->load->model('Role_menu_permission_model','role_menu_permission_model');
        $this->model = $this->role_menu_permission_model;                        
    }

    public function index($referenceId = null){        				
		$this->model->setWithRole(TRUE);				
        $this->model->setWithMenuPermission(TRUE);           
        $referenceId = $this->checkReferencesId($referenceId);        
        $this->title .= $this->getTitleRole($referenceId);
        parent::index($referenceId);
    }    

    private function getTitleRole($referenceId){
        $this->load->model('Role_model', 'rm');
        $role = $this->rm->fields(['name'])->get($referenceId);
        return $role->name;
    }

    protected function setIndexData()
    {
        $this->load->model('role_menu_model','role_menus');
        $this->load->model('menu_model','menus');

        $key = $this->input->post('key');
        $referenceId = $key['id'];
        $this->addFilters('role_id',$referenceId);
        $menus = $this->menus->as_array()->with('menu_permission')->get_many_by(array('status' => 1));             
        $rolemenus = $this->role_menus->where([['role_id' => $referenceId]])->dropdown('menu_id', 'menu_id');
        $rolePermissions = $this->setTableData();
        $table = $this->load->view('master/role_permission', ['rolePermissions' => $rolePermissions, 'menus' => $menus, 'rolemenus' => $rolemenus, 'form_header' => array('data-actiontype' => 'save', 'data-nexturl' => site_url('master/role'), 'action' => site_url($this->pathView.'/'.$this->actionMethodSave)), 'referenceId' => $referenceId,
                            ], true);
        return ['table' => $table, 'title' => $this->title, 'filterModal' => $this->getFilterModal()];
    }

    protected function setBtnAdd($key = null)
    {
        
        return '';
        
    }

    /** override function parent class */
    public function save()
    {
        $this->load->model('role_menu_model','role_menus');
        $data = json_decode($this->input->post('data'),1);
        $where = json_decode($this->input->post('key'),1);
        /* set statusnya menjadi non aktif */
        $this->model->delete_by($where);
        $this->role_menus->delete_by($where);        
        /** simpan datanya */
        $tmpMenu = [];
        $tmpPermissions = [];
        foreach ($data as $k => $v) {
            $tmpKey = explode('_', $k);
            if ($tmpKey[0] == 'menu') {
                array_push($tmpMenu, array_merge($where, array('menu_id' => $v)));
            } 
            if ($tmpKey[0] == 'menu-permission') {
                $tmpPermissions[$v] = array_merge($where,array('menu_permission_id' => $v));
            }
        }
        
        if (!empty($tmpMenu)) {
            $this->role_menus->insert_many($tmpMenu);
        }

        if (!empty($tmpPermissions)) {
            $this->model->insert_many($tmpPermissions);
        }

        $this->result['status'] = 1;
        $this->result['message'] = 'Sudah disimpan';
        $this->display_json($this->result);
    }
}

