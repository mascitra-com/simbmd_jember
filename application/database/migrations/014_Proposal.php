<?php
class Migration_Proposal extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id' => array('type' => 'INT','constraint' => 7,'auto_increment' => TRUE),
            'skpd_id'=>array('type' => 'INT', 'constraint'=>2),
            'asset_category'=>array('type' => 'VARCHAR', 'constraint'=>25),
            'file'=>array('type' => 'VARCHAR', 'constraint'=>255),
            'message'=>array('type'=> 'TEXT'),
            'created_by'=>array('type'=> 'INT','constraint' => 7),
            'created_at'=>array('type' => 'DATETIME'),
            'updated_by'=>array('type' => 'INT','constraint' => 7),
            'updated_at'=>array('type' => 'DATETIME'),
            'deleted'=>array('type' => 'TINYINT', 'constraint'=>1)
            ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('proposals');
    }

    public function down() {
        $this->dbforge->drop_table('proposals');
    }
}