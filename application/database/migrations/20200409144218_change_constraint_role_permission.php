<?php

class Migration_change_constraint_role_permission extends CI_Migration {

    public function up() {               
        $this->dbforge->drop_table('role_permissions');
    }

    public function down() {
        
    }

}