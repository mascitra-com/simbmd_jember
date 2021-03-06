<?php
class Migration_Asset_c_rehab extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id'                =>array('type'=>'INT','constraint'=>7,'auto_increment'=>TRUE),
            'asset_id'          =>array('type'=>'INT','constraint'=>7),
            'tahun_pengadaan'   =>array('type'=> 'YEAR'),
            'kode_barang'       =>array('type'=>'VARCHAR', 'constraint'=>10),
            'nama'              =>array('type'=> 'VARCHAR','constraint'=>255),
            'tahun_pembuatan'   =>array('type'=> 'YEAR'),
            'nilai'             =>array('type'=>'BIGINT','constraint'=>10),
            'keterangan'        =>array('type'=>'TEXT'),
            'status'            =>array('type'=>'VARCHAR','constraint'=>20),
            'temp'              =>array('type'=>'TEXT'),
            'created_at'        =>array('type'=>'DATETIME'),
            'created_by'        =>array('type'=>'INT','constraint'=>7),
            'updated_at'        =>array('type'=>'DATETIME'),
            'updated_by'        =>array('type'=>'INT','constraint'=>7),
            'deleted'           =>array('type'=>'TINYINT', 'constraint'=>1)
            ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('asset_c_rehab');
    }

    public function down() {
        $this->dbforge->drop_table('asset_c_rehab');
    }
}