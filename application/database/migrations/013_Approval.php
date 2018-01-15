<?php
class Migration_Approval extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id' => array('type' => 'INT','constraint' => 7,'auto_increment' => TRUE),
            'skpd_id'=>array('type' => 'INT', 'constraint'=>2),
            'proposal_id'=>array('type' => 'INT', 'constraint'=>7, 'default'=>NULL),
            'asset_category'=>array('type' => 'VARCHAR', 'constraint'=>25),
            'approval_category'=>array('type' => 'VARCHAR', 'constraint'=>25),
            'approval_status'=>array('type' => 'TINYINT', 'constraint'=>1),
            'message'=>array('type'=> 'TEXT'),
            'read'=>array('type' => 'TINYINT', 'constraint'=>1, 'default'=>0),
            'created_by'=>array('type'=> 'INT','constraint' => 7),
            'created_at'=>array('type' => 'DATETIME'),
            'updated_by'=>array('type' => 'INT','constraint' => 7),
            'updated_at'=>array('type' => 'DATETIME'),
            'deleted'=>array('type' => 'TINYINT', 'constraint'=>1)
            ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('approvals');
    }

    public function down() {
        $this->dbforge->drop_table('approvals');
    }
}