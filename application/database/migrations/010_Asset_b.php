<?php
class Migration_Asset_b extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id'                =>array('type'=>'INT','constraint'=>7,'auto_increment'=>TRUE),
            'skpd_id'           =>array('type'=>'INT', 'constraint'=>7),
            'category_id'       =>array('type'=>'INT', 'constraint'=>7),
            'tahun_pengadaan'   =>array('type'=> 'YEAR'),
            'kode_barang'       =>array('type'=>'VARCHAR', 'constraint'=>10),
            'nama'              =>array('type'=> 'VARCHAR','constraint'=>255),
            'reg'               =>array('type'=> 'INT','constraint'=>10),
            'merk'              =>array('type'=> 'VARCHAR','constraint'=>255),
            'ukuran'            =>array('type'=> 'INT','constraint'=>10),
            'bahan'             =>array('type'=> 'VARCHAR','constraint'=>255),
            'tahun_pembuatan'   =>array('type'=> 'YEAR'),
            'nomor_pabrik'      =>array('type'=> 'VARCHAR','constraint'=>255),
            'nomor_rangka'      =>array('type'=> 'VARCHAR','constraint'=>255),
            'nomor_mesin'       =>array('type'=> 'VARCHAR','constraint'=>255),
            'nomor_polisi'      =>array('type'=> 'VARCHAR','constraint'=>255),
            'nomor_bpkb'        =>array('type'=> 'VARCHAR','constraint'=>255),
            'asal_usul'         =>array('type'=> 'VARCHAR','constraint'=>255),
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
        $this->dbforge->create_table('asset_b');
    }

    public function down() {
        $this->dbforge->drop_table('asset_b');
    }
}