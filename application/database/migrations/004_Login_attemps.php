<?php
class Migration_Login_attemps extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id'         => array('type' => 'INT', 'constraint' => 5,'auto_increment' => TRUE),
            'ip_address' => array('type' => 'VARCHAR', 'constraint' => 255),
            'status'     => array('type' => 'TINYINT', 'constraint' => 1),
            'date'       => array('type' => 'DATETIME'),
            ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('login_attempts');
    }

    public function down() {
        $this->dbforge->drop_table('login_attempts');
    }
}