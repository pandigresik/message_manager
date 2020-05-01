<?php

class Migration_add_column_send_status_message extends CI_Migration {

    public function up() {
        $this->dbforge->add_column('messages',['send_status' => ['type' => 'char','constraint' => 1, 'default' => 0]]);
    }

    public function down() {
        $this->dbforge->drop_column('messages','send_status');        
    }

}