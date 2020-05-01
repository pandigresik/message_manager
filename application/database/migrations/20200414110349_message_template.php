<?php

class Migration_message_template extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'name' => array(
                'type' => 'varchar',
                'constraint' => 50,
                'unique' => TRUE 
            ),
            'description' => array(
                'type' => 'varchar',
                'constraint' => 150                
            ),
            'text_template' => array(
                'type' => 'text'                
            ),
            'image' => array(
                'type' => 'varchar',
                'constraint' => 150                
            ),
            'created_at' => array(
                'type' => 'DATETIME'
            ),
            'updated_at' => array(
                'type' => 'DATETIME'
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('message_template');
    }

    public function down() {
        $this->dbforge->drop_table('message_template');
    }

}