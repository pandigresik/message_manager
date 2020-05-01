<?php

class Migration_add_constraint_table extends CI_Migration {

    public function up() {
        $this->db->query('alter table role_menus add constraint fk_role_menu foreign key (menu_id) references menus(id)');
        $this->db->query('alter table role_menus add constraint fk_role_menu2 foreign key (role_id) references roles(id)');
    }

    public function down() {
        //$this->db->query('alter table ');
    }

}