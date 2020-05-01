<?php

class Migration_add_menui_id_permission extends CI_Migration {

    public function up() {
        $this->dbforge->add_column('permissions',['menu_id' => ['type' => 'int','constraint' => 11, 'null' => TRUE]]);
    }

    public function down() {
        $this->dbforge->drop_column('permissions','menu_id');        
    }

}