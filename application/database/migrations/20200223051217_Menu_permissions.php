<?php

class Migration_Menu_permissions extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(            
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'menu_id' => array(
                'type' => 'INT',
                'constraint' => 11,                
            ),
            'permission_id' => array(
                'type' => 'INT',
                'constraint' => 11,                
            ),
        ));        
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('menu_permissions');
        $this->db->query('alter table menu_permissions add constraint uq_menu_permission unique(permission_id, menu_id)');
    }

    public function down() {
        $this->dbforge->drop_table('menu_permissions');
    }

}