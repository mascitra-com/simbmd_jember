<?php
class Migration_Skpd extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id' => array('type' => 'INT','constraint' => 7,'auto_increment' => TRUE),
            'code'=>array('type' => 'VARCHAR', 'constraint'=>255),
            'name'=>array('type' => 'VARCHAR', 'constraint'=>255),
            'address'=>array('type' => 'TEXT'),
            'phone'=>array('type' => 'VARCHAR', 'constraint'=>15),
            'is_admin'=>array('type' => 'TINYINT', 'constraint'=>1, 'default'=>0),
            'created_by'=>array('type'=> 'INT','constraint' => 7),
            'created_at'=>array('type' => 'DATETIME'),
            'updated_by'=>array('type' => 'INT','constraint' => 7),
            'updated_at'=>array('type' => 'DATETIME'),
            'deleted'=>array('type' => 'TINYINT', 'constraint'=>1)
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('skpds');
    }

    public function down() {
        $this->dbforge->drop_table('skpds');
    }
}