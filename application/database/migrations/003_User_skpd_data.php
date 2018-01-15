<?php
class Migration_User_skpd_data extends CI_Migration {

    public function up() {
        $this->load->database();

        $data_skpd = array(
                array('name'=>'PEMDA','code'=>'1','address'=>'Jember','phone'=>'0332-4234234','is_admin'=>1,'deleted'=>0),
                array("name"=>"BAGIAN HUKUM", "code"=>"2", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"BAGIAN HUMAS", "code"=>"3", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"BAGIAN KESEJAHTERAAN RAKYAT", "code"=>"4", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"BAGIAN ORGANISASI", "code"=>"5", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"BAGIAN PEMBANGUNAN", "code"=>"6", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"BAGIAN PEMERINTAHAN DESA", "code"=>"7", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"BAGIAN PEMERINTAHAN UMUM", "code"=>"8", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"BAGIAN PEREKONOMIAN DAN KETAHANAN PANGAN", "code"=>"9", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"BAGIAN UMUM", "code"=>"10", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"INSPEKTORAT KABUPATEN", "code"=>"11", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"BADAN KESATUAN BANGSA, POLITIK DAN PERLINDUNGAN MASYARAKAT", "code"=>"12", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"BADAN PENGELOLAAN KEUANGAN DAN ASET", "code"=>"13", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"BADAN PERENCANAAN PEMBANGUNAN KABUPATEN", "code"=>"14", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"BADAN PEMBERDAYAAN MASYARAKAT", "code"=>"15", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"BADAN KEPEGAWAIAN", "code"=>"16", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"BADAN PEMBERDAYAAN PEREMPUAN DAN KELUARGA BERENCANA", "code"=>"17", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"BADAN PENANGGULANGAN BENCANA DAERAH", "code"=>"18", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"DINAS KEPENDUDUKAN DAN PENCATATAN SIPIL", "code"=>"19", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"DINAS KESEHATAN", "code"=>"20", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"DINAS KOPERASI, USAHA MIKRO, KECIL DAN MENENGAH", "code"=>"21", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"DINAS PASAR", "code"=>"22", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"DINAS PEKERJAAN UMUM BINA MARGA", "code"=>"23", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"DINAS PEKERJAAN UMUM PENGAIRAN", "code"=>"24", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"DINAS PENDAPATAN", "code"=>"25", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"DINAS PENDIDIKAN", "code"=>"26", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"DINAS PERHUBUNGAN", "code"=>"27", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"DINAS PERINDUSTRIAN, PERDAGANGAN DAN ESDM", "code"=>"28", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"DINAS PERKEBUNAN DAN KEHUTANAN", "code"=>"29", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"DINAS PERTANIAN", "code"=>"30", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"DINAS PETERNAKAN, PERIKANAN DAN KELAUTAN", "code"=>"31", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"DINAS PU CIPTA KARYA DAN TATA RUANG", "code"=>"32", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"DINAS SOSIAL", "code"=>"33", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"DINAS TENAGA KERJA DAN TRANSMIGRASI", "code"=>"34", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"KANTOR LINGKUNGAN HIDUP KABUPATEN JEMBER", "code"=>"35", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"KANTOR PARIWISATA DAN KEBUDAYAAN", "code"=>"36", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"KANTOR PEMUDA DAN OLAHRAGA", "code"=>"37", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"KANTOR PERPUSTAKAAN, ARSIP DAN DOKUMENTASI", "code"=>"38", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"KANTOR SATUAN POLISI PAMONG PRAJA", "code"=>"39", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"SEKRETARIAT DEWAN / DPRD ", "code"=>"40", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"RUMAH SAKIT DAERAH (RSD) BALUNG", "code"=>"41", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"RUMAH SAKIT DAERAH (RSD) DR SOEBANDI", "code"=>"42", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"RUMAH SAKIT DAERAH (RSD) KALISAT", "code"=>"43", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"KECAMATAN AJUNG", "code"=>"44", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"KECAMATAN AMBULU", "code"=>"45", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"KECAMATAN ARJASA", "code"=>"46", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"KECAMATAN BALUNG", "code"=>"47", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"KECAMATAN BANGSALSARI", "code"=>"48", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"KECAMATAN GUMUKMAS", "code"=>"49", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"KECAMATAN JELBUK", "code"=>"50", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"KECAMATAN JENGGAWAH", "code"=>"51", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"KECAMATAN JOMBANG", "code"=>"52", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"KECAMATAN KALISAT", "code"=>"53", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"KECAMATAN KALIWATES", "code"=>"54", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"KECAMATAN KENCONG", "code"=>"55", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"KECAMATAN LEDOKOMBO", "code"=>"56", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"KECAMATAN MAYANG", "code"=>"57", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"KECAMATAN MUMBULSARI", "code"=>"58", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"KECAMATAN PAKUSARI", "code"=>"59", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"KECAMATAN PANTI", "code"=>"60", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"KECAMATAN PATRANG", "code"=>"61", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"KECAMATAN PUGER", "code"=>"62", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"KECAMATAN RAMBIPUJI", "code"=>"63", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"KECAMATAN SEMBORO", "code"=>"64", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"KECAMATAN SILO", "code"=>"65", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"KECAMATAN SUKORAMBI", "code"=>"66", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"KECAMATAN SUKOWONO", "code"=>"67", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"KECAMATAN SUMBERBARU", "code"=>"68", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"KECAMATAN SUMBERJAMBE", "code"=>"69", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"KECAMATAN SUMBERSARI", "code"=>"70", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"KECAMATAN TANGGUL", "code"=>"71", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"KECAMATAN TEMPUREJO", "code"=>"72", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"KECAMATAN UMBULSARI", "code"=>"73", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"KECAMATAN WULUHAN", "code"=>"74", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"KELURAHAN ANTIROGO", "code"=>"75", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"KELURAHAN BANJAR SENGON", "code"=>"76", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"KELURAHAN BARATAN", "code"=>"77", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"KELURAHAN BINTORO", "code"=>"78", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"KELURAHAN GEBANG", "code"=>"79", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"KELURAHAN JEMBER KIDUL", "code"=>"80", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"KELURAHAN JEMBER LOR", "code"=>"81", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"KELURAHAN JUMERTO", "code"=>"82", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"KELURAHAN KALIWATES", "code"=>"83", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"KELURAHAN KARANGREJO", "code"=>"84", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"KELURAHAN KEBONAGUNG", "code"=>"85", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"KELURAHAN KEBONSARI", "code"=>"86", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"KELURAHAN KEPATIHAN", "code"=>"87", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"KELURAHAN KRANJINGAN", "code"=>"88", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"KELURAHAN MANGLI", "code"=>"89", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"KELURAHAN PATRANG", "code"=>"90", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"KELURAHAN SEMPUSARI", "code"=>"91", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"KELURAHAN SLAWU", "code"=>"92", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"KELURAHAN SUMBERSARI", "code"=>"93", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"KELURAHAN TEGAL BESAR", "code"=>"94", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"KELURAHAN TEGALGEDE", "code"=>"95", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0),
                array("name"=>"KELURAHAN WIROLEGI", "code"=>"96", "address"=>"Jember", "phone"=>"", "is_admin"=>0, "deleted"=>0)
            );

        $this->db->insert_batch('skpds', $data_skpd);

        $data_user = array(
                array('name'=>'Ainul','email'=>'ainul086@gmail.com','username'=>'pemda','password'=>password_hash('pemda123', PASSWORD_BCRYPT),'skpd_id'=>1,'deleted'=>'0'),
                array('name'=>'Budi','email'=>'budi@gmail.com','username'=>'dinkes','password'=>password_hash('dinkes123', PASSWORD_BCRYPT),'skpd_id'=>2,'deleted'=>'0')
            );
        $this->db->insert_batch('users', $data_user);
    }

    public function down() {
        $this->db->truncate('skpds');
        $this->db->truncate('users');
    }
}