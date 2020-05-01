<?php

class Migration_Settings extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'name' => array(
                'type' => 'varchar',
                'constraint' => 60,
                'unique' => TRUE
            ),
            'type' => array(
                'type' => 'varchar',
                'constraint' => 40                
            ),
            'value' => array(
                'type' => 'varchar',
                'constraint' => 80                
            ),
            'created_at' => array(
                'type' => 'DATETIME'
            ),
            'updated_at' => array(
                'type' => 'DATETIME'
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('settings');
    }

    public function down() {
        $this->dbforge->drop_table('settings');
    }

}