<?php

class Migration_add_constraint_table extends CI_Migration {

    public function up() {
        $this->db->query('alter table menu_permissions add constraint fk_menu_permissions foreign key (menu_id) references menus(id)');
        $this->db->query('alter table menu_permissions add constraint fk_menu_permissions2 foreign key (permission_id) references permissions(id)');

        $this->db->query('alter table menus add constraint fk_menus foreign key (parent_id) references menus(id)');

        $this->db->query('alter table role_permissions add constraint fk_role_permissions foreign key (role_id) references roles(id)');
        $this->db->query('alter table role_permissions add constraint fk_role_permissions2 foreign key (permission_id) references permissions(id)');

        $this->db->query('alter table user_roles add constraint fk_user_roles foreign key (role_id) references roles(id)');
        $this->db->query('alter table user_roles add constraint fk_user_roles2 foreign key (user_id) references users(id)');
    }

    public function down() {
        //$this->dbforge->drop_table('add_constraint_table');
    }

}