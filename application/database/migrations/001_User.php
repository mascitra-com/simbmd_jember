<?php
class Migration_User extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id' => array('type' => 'INT','constraint' => 7,'auto_increment' => TRUE),
            'name'=>array('type'=>'VARCHAR', 'constraint'=>255),
            'email'=>array('type'=>'VARCHAR', 'constraint'=>255),
            'username'=>array('type'=>'VARCHAR', 'constraint'=>255),
            'password'=>array('type'=>'VARCHAR', 'constraint'=>255),
            'skpd_id'=>array('type'=>'TINYINT', 'constraint'=>2),
            'last_login'=>array('type'=>'DATETIME'),
            'token'=>array('type'=>'text'),
            'created_by'=>array('type' => 'INT','constraint' => 7),
            'created_at'=>array('type'=>'DATETIME'),
            'updated_by'=>array('type' => 'INT','constraint' => 7),
            'updated_at'=>array('type'=>'DATETIME'),
            'deleted'=>array('type'=>'TINYINT', 'constraint'=>1)
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('users');
    }

    public function down() {
        $this->dbforge->drop_table('users');
    }
}