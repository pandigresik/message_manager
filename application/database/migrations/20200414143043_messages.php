<?php

class Migration_messages extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'content' => array(
                'type' => 'text',                                
            ),
            'image' => array(
                'type' => 'varchar',
                'constraint' => 100                
            ),
            'destination' => array(
                'type' => 'varchar',
                'constraint' => 30
            ),
            'send_date' => array(
                'type' => 'DATE',                
            ),
            'created_at' => array(
                'type' => 'DATETIME'
            ),
            'updated_at' => array(
                'type' => 'DATETIME'
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('messages');
    }

    public function down() {
        $this->dbforge->drop_table('messages');
    }

}