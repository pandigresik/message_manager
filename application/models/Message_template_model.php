<?php
/** Generate by crud generator model pada 2020-04-14 11:32:34
*   Author afandi
*/
class Message_template_model extends MY_Model{
    protected $_table = 'message_template';
    protected $before_create = array('setAttachment');    
    protected $before_update = array('setAttachment');    
    protected $primary_key = 'id';
    /** this data shown on main table
     *  if your table having foreign key, you can get data on reference column
     *  by references_table.column   
     */
    protected $columnTableData = ['id','name','description','text_template','concat(\'<img class="thumbnail" src="\',image,\'" />\') as image'];
    protected $headerTableData = [
        [['data' => 'name'],['data' => 'description'],['data' => 'text_template'],['data' => 'image']]    
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
			'type' => 'textarea',
            'rows' => 2,
            'label' => 'description',
			'rules' => 'required|max:150',
			                 
        ],		
		'text_template' => [
			'id' => 'text_template',
			'name' => 'text_template',
            'type' => 'textarea',
            'rows' => 3,
            'label' => 'text_template',
			'rules' => 'required|max:65535',
			'placeholder' => 'Selamat menempuh hidup baru :nama, bagian :bagian, jabatan :jabatan gunakan : sebagai penanda teks dinamis'
        ],		
		'image' => [
			'id' => 'image',
			'name' => 'image',
			'type' => 'file',
            'readonly' => 'readonly',
            'value' => '',
            'input_addons' => [
                'pre_html' => '<div class="btn-default btn btn-file">
                                    <span>
                                        <i class="fa fa-file"></i>
                                    </span>',
            ],
			                 
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

    public function setAttachment($row){
        if(is_array($row)){
            if(isset($row['attachment'])){
                $row['image'] = $row['attachment'];
                unset($row['attachment']);
            } 
        }else{
            if(isset($row->attachment)){
                $row->image = $row->attachment;
                unset($row->attachment);
            }
        }
                
        return $row;
    }
}
?>