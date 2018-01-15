<?php
class Migration_Asset_c extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id'                =>array('type'=>'INT','constraint'=>7,'auto_increment'=>TRUE),
            'skpd_id'           =>array('type'=>'INT', 'constraint'=>7),
            'category_id'       =>array('type'=>'INT', 'constraint'=>7),
            'rehab_to'          =>array('type'=>'INT','constraint'=>7, 'default'=>NULL),
            'tahun_pengadaan'   =>array('type'=> 'YEAR'),
            'kode_barang'       =>array('type'=>'VARCHAR', 'constraint'=>10),
            'nama'              =>array('type'=> 'VARCHAR','constraint'=>255),
            'reg'               =>array('type'=> 'INT','constraint'=>10, 'default'=>NULL),
            'kondisi'           =>array('type'=> 'VARCHAR','constraint'=>255),
            'tingkat'           =>array('type'=> 'VARCHAR','constraint'=>255),
            'pondasi'           =>array('type'=> 'VARCHAR','constraint'=>255),
            'luas_lantai'       =>array('type'=> 'INT','constraint'=>10),
            'alamat'            =>array('type'=> 'text'),
            'nomor_dokumen'     =>array('type'=> 'VARCHAR','constraint'=>255),
            'luas_bangunan'     =>array('type'=> 'INT','constraint'=>10),
            'status_tanah'      =>array('type'=> 'VARCHAR','constraint'=>255),
            'kode_tanah'        =>array('type'=> 'INT','constraint'=>10),
            'asal_usul'         =>array('type'=> 'VARCHAR','constraint'=>255),
            'nilai'             =>array('type'=>'BIGINT','constraint'=>10),
            'keterangan'        =>array('type'=>'TEXT'),
            'status'            =>array('type'=>'VARCHAR','constraint'=>20),
            'temp'              =>array('type'=>'TEXT'),
            'created_at'        =>array('type'=>'DATETIME'),
            'created_by'        =>array('type'=>'INT','constraint'=>7),
            'updated_at'        =>array('type'=>'DATETIME'),
            'updated_by'        =>array('type'=>'INT','constraint'=>7),
            'deleted'           =>array('type'=>'TINYINT', 'constraint'=>1, 'default'=>0)
            ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('asset_c');
    }

    public function down() {
        $this->dbforge->drop_table('asset_c');
    }
}