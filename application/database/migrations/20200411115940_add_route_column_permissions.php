<?php

class Migration_add_route_column_permissions extends CI_Migration {

    public function up() {
        $this->dbforge->add_column('permissions',['route' => ['type' => 'varchar','constraint' => 50, 'null' => TRUE]]);        
    }

    public function down() {
        $this->dbforge->drop_column('permissions','route');        
    }

}