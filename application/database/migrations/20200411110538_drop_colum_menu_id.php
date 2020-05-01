<?php

class Migration_drop_colum_menu_id extends CI_Migration {

    public function up() {
        $this->dbforge->drop_column('permissions','menu_id');        
    }

    public function down() {
        //$this->dbforge->drop_column('permissions','menu_id');        
    }

}