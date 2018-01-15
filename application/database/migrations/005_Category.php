<?php
class Migration_Category extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id' => array('type' => 'INT','constraint' => 7,'auto_increment' => TRUE),
            'kode'=>array('type' => 'VARCHAR', 'constraint'=>25),
            'nama'=>array('type' => 'VARCHAR', 'constraint'=>255),
            'umur_ekonomis'=>array('type'=> 'INT','constraint' => 7),
            'batas_kapitalisasi'=>array('type'=> 'BIGINT','constraint' => 10),
            'created_by'=>array('type'=> 'INT','constraint' => 7),
            'created_at'=>array('type' => 'DATETIME'),
            'updated_by'=>array('type' => 'INT','constraint' => 7),
            'updated_at'=>array('type' => 'DATETIME'),
            'deleted'=>array('type' => 'TINYINT', 'constraint'=>1)
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('categories');

        $this->dbforge->add_field(array(
            'id' => array('type' => 'INT','constraint' => 7,'auto_increment' => TRUE),
            'kode_kategori'=>array('type' => 'VARCHAR', 'constraint'=>25),
            'uraian'=>array('type' => 'VARCHAR', 'constraint'=>255),
            'awal'=>array('type'=> 'INT','constraint' => 3),
            'akhir'=>array('type'=> 'INT','constraint' => 3),
            'tahun'=>array('type'=> 'INT','constraint' => 3),
            'created_by'=>array('type'=> 'INT','constraint' => 7),
            'created_at'=>array('type' => 'DATETIME'),
            'updated_by'=>array('type' => 'INT','constraint' => 7),
            'updated_at'=>array('type' => 'DATETIME'),
            'deleted'=>array('type' => 'TINYINT', 'constraint'=>1)
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('umur_ekonomis');
    }

    public function down() {
        $this->dbforge->drop_table('categories');
        $this->dbforge->drop_table('umur_ekonomis');
    }
}