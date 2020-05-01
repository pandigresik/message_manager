<?php

class Migration_Role_menu_permissions extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'role_id' => array(
                'type' => 'INT',
                'constraint' => 11,                
            ),
            'menu_permission_id' => array(
                'type' => 'INT',
                'constraint' => 11,                
            ),                        
            'created_at' => array(
                'type' => 'DATETIME'
            ),
            'updated_at' => array(
                'type' => 'DATETIME'
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('role_menu_permissions');
        $this->db->query('alter table role_menu_permissions add constraint uq_role_menu_permission unique(menu_permission_id, role_id)');
        $this->db->query('alter table role_menu_permissions add constraint fk_role_menu_permission foreign key(menu_permission_id) references menu_permissions(id)');
        $this->db->query('alter table role_menu_permissions add constraint fk_role_menu_permission2 foreign key(role_id) references roles(id)');
    }

    public function down() {
        $this->dbforge->drop_table('role_menu_permissions');
    }
}