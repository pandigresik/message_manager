<?php

class Migration_add_constraint extends CI_Migration {

    public function up() {
        $this->db->query('alter table menu_permissions add constraint fk_menu_permissions foreign key (menu_id) references menus(id)');
        $this->db->query('alter table menu_permissions add constraint fk_menu_permissions2 foreign key (permission_id) references permissions(id)');
    }

    public function down() {
//        $this->dbforge->drop_table('add_constraint');
    }

}