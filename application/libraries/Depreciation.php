<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Depreciation 
{
	/*

	tp = tahun penyusutan
	to = tahun perolehan
	np = nilai perolehan
	bp = beban penyusutan
	mf = masa manfaat
	mp = masa pemanfaatan
	ap = akumulasi penyusutan
	nb = nilai buku

	Rumus.
	bp = (np / mf)
	ap = bp * mp
	mp = tp - (to - 1)
	nb = np - ap

	Rumus mf REHAB ONLY.
	mf = mf(gedung utama) - mp (gedung utama) + mp(rehab)

	*/

	protected $with_rehab = FALSE;
	protected $asset = array();
	protected $result = array();
	protected $tahun_penyusutan;
	protected $category = array();
	protected $skpd = array();
	protected $CI;

	public function __construct($config = array())
	{
		if(!empty($config)) {
			$this->init($config);
		}

		if (empty($this->tahun_penyusutan)) {
			$this->tahun_penyusutan = date('Y');
		}

		$this->CI =& get_instance();
		$this->CI->load->model("Category_model", "cat");
		$this->CI->load->model("Umur_ekonomis_model", "umur");
		$this->CI->load->model("Skpd_model", "skpd");
		$this->category = $this->CI->cat->get_formated_data();
		$this->skpd 	= $this->CI->skpd->get_formated_data();

	}

	public function init($config = array())
	{
		if (isset($config['with_rehab'])) {
			$this->with_rehab = $config['with_rehab'];
		}

		if (isset($config['asset'])) {
			$this->asset = $config['asset'];
		}

		if (isset($config['tahun_penyusutan'])) {
			$this->tahun_penyusutan = $config['tahun_penyusutan'];
		}
	}

	public function calculate($asset = array())
	{
		if(!empty($asset)) {
			$this->asset = $asset;
		}

		if ($this->with_rehab) {
			$this->calculate_special();
		} else {
			$this->calculate_normal();
		}

		return $this->result;
	}

	private function calculate_normal()
	{
		$final = array();
		foreach ($this->asset as $key => $value) {
			$final[$key] = $this->no_rehab($value);
		}

		$this->result = $final;
	}

	private function calculate_special()
	{
		$final = array();

		foreach ($this->asset as $key => $value) 
		{
			if (!isset($value->rehab) OR empty($value->rehab)) 
			{
				# No rehab
				$final[$key] = $this->no_rehab($value);
			}
			else
			{
				if ($this->has_2015($value->rehab)) 
				{
					if ($this->has_2014($value->rehab))
					{	
						# Rehab 2014 kebawah dan 2014 keatas
						$final[$key] = $this->rehab_2014_with_2015($value);
					}
					else
					{
						# Rehab tidak ada 2014 kebawah
						$final[$key] = $this->rehab_no_2014($value);
					}
				}
				else
				{
					# Rehab 2014 only
					$final[$key] = $this->rehab_2014_only($value);
				}
			}
		}

		$this->result = $final;
	}

	private function no_rehab($data)
	{
		$tmp = new stdClass();
		$tmp->category_kode			 	= $this->category[$data->category_id]->kode;
		$tmp->nama 					 	= $data->nama;
		$tmp->skpd 	 				 	= $this->skpd[$data->skpd_id]->name;
		$tmp->saldo 				 	= "";
		$tmp->tahun_perolehan 		 	= $data->tahun_pengadaan;
		$tmp->nilai_perolehan 		 	= $data->nilai;
		$tmp->masa_manfaat 			 	= $this->category[$data->category_id]->umur_ekonomis;
		$tmp->beban_penyusutan 		 	= $data->nilai / $this->category[$data->category_id]->umur_ekonomis;
		$tmp->tarif_beban_penyusutan 	= $tmp->beban_penyusutan;
		$tmp->masa_pemanfaatan 		 	= $this->tahun_penyusutan - ($data->tahun_pengadaan - 1);
		$tmp->akumulasi_penyusutan 	 	= $tmp->beban_penyusutan * $tmp->masa_pemanfaatan;
		$tmp->akumulasi_penyusutan_min 	= $tmp->beban_penyusutan * (($this->tahun_penyusutan - 1) - ($data->tahun_pengadaan - 1));

		if ($tmp->akumulasi_penyusutan > $data->nilai) {
			$tmp->akumulasi_penyusutan = $data->nilai;
		}

		if ($this->tahun_penyusutan - $data->tahun_pengadaan > $tmp->masa_manfaat) {
			$tmp->beban_penyusutan = 0;
		}

		$tmp->nilai_buku = $data->nilai - $tmp->akumulasi_penyusutan;

		return $tmp;
	}

	private function rehab_2014_only($data)
	{
		# Basic data with sorted rehab
		$data->rehab = $this->sorting_rehab($data->rehab);
		$tmp 		 = $this->no_rehab($data);
		$tmp->rehab  = array();

		# Calculate masa manfaat before
		$masa_manfaat_atas = $tmp->masa_manfaat - $tmp->masa_pemanfaatan;

		foreach ($data->rehab as $key => $value)
		{
			$rehab = new stdClass();
			$rehab->category_kode 			 = $this->category[$value->category_id]->kode;
			$rehab->nama 		 			 = $value->nama;
			$rehab->skpd 	 	 			 = $this->skpd[$value->skpd_id]->name;
			$rehab->saldo 		 			 = "";
			$rehab->tahun_perolehan 	   	 = $value->tahun_pengadaan;
			$rehab->nilai_perolehan 	   	 = $value->nilai;
			$rehab->masa_pemanfaatan 	   	 = $this->tahun_penyusutan - ($value->tahun_pengadaan - 1);
			$rehab->masa_manfaat 		   	 = $masa_manfaat_atas + $rehab->masa_pemanfaatan;
			$rehab->beban_penyusutan 	   	 = $value->nilai / $rehab->masa_manfaat;
			$rehab->tarif_beban_penyusutan 	 = $rehab->beban_penyusutan;
			$rehab->akumulasi_penyusutan 	 = $rehab->beban_penyusutan * $rehab->masa_pemanfaatan;
			$rehab->akumulasi_penyusutan_min = $rehab->beban_penyusutan * (($this->tahun_penyusutan - 1) - ($value->tahun_pengadaan - 1));
			$rehab->nilai_buku 				 = $rehab->nilai_perolehan - $rehab->akumulasi_penyusutan;
			$tmp->rehab[]	   = $rehab;
			$masa_manfaat_atas = $rehab->masa_manfaat - $rehab->masa_pemanfaatan;
		}

		return $tmp;
	}

	private function rehab_2014_with_2015($data)
	{
		# UBAH DISINI
		$tahun_rehab_after_2014 = $this->get_tahun_rehab_after_2014($data->rehab);
		$data->rehab   = $this->sorting_rehab($data->rehab);
		$gedung 	   = $this->no_rehab($data);
		$gedung->rehab = array();

		# CETAK KE EXCEL
		$gedung->akumulasi_penyusutan_min = "";
		$gedung->masa_pemanfaatan 	   = ($tahun_rehab_after_2014[0]-1) - ($gedung->tahun_perolehan - 1);
		$gedung->akumulasi_penyusutan  = $gedung->beban_penyusutan * $gedung->masa_pemanfaatan;
		$gedung->nilai_buku 		   = $gedung->nilai_perolehan - $gedung->akumulasi_penyusutan;
		
		$_perolehan_per_tahun = 0;
		$_nilai_susut 		  = 0;
		$_masa_manfaat 		  = 0;
		$_nilai_buku 		  = $gedung->nilai_buku;
		$_perolehan 		  = $gedung->nilai_perolehan;
		$_akumulasi 		  = $gedung->akumulasi_penyusutan;
		$_masa_manfaat_atas	  = $gedung->masa_manfaat - $gedung->masa_pemanfaatan;

		foreach ($data->rehab as $key => $value)
		{
			# CETAK KE EXCEL
			$rehab = new stdClass();
			$rehab->category_kode 			 = $this->category[$value->category_id]->kode;
			$rehab->nama 		 			 = $value->nama;
			$rehab->skpd 	 	 			 = $this->skpd[$value->skpd_id]->name;
			$rehab->tahun_perolehan 	   	 = $value->tahun_pengadaan;
			$rehab->nilai_perolehan 	   	 = $value->nilai;

			if ($value->tahun_pengadaan < 2015)
			{
				# UBAH DISINI
				$masa_pemanfaatan 	    = ($tahun_rehab_after_2014[0]-1) - ($rehab->tahun_perolehan - 1);
				$masa_manfaat 	 	    = $_masa_manfaat_atas + $masa_pemanfaatan;
				$tarif_beban_penyusutan = $rehab->nilai_perolehan / $masa_manfaat;
				$akumulasi_penyusutan   = $tarif_beban_penyusutan * $masa_pemanfaatan;
				$nilai_buku 			= $rehab->nilai_perolehan - $akumulasi_penyusutan;

				$_akumulasi  += $akumulasi_penyusutan;
				$_nilai_buku += $nilai_buku;
				$_perolehan  += $rehab->nilai_perolehan;
				$_masa_manfaat_atas = $masa_manfaat - $masa_pemanfaatan;
				$_masa_manfaat 		= $masa_manfaat;
				$_masa_manfaat 		= $masa_manfaat - $masa_pemanfaatan;

				# CETAK KE EXCEL
				$rehab->masa_manfaat = $masa_manfaat;
			}
			else
			{
				$_perolehan_per_tahun += $rehab->nilai_perolehan;

				if ($this->is_break($data->rehab, $key)) 
				{
					# Hitung persentase
					$persentase = round($_perolehan_per_tahun / $_perolehan * 100);
					$persentase = $persentase > 100 ? 100 : $persentase;
					
					# Tambah masa manfaat
					$penambahan   = $this->CI->umur->get_tahun($gedung->category_kode, $persentase);
					$masa_manfaat = $_masa_manfaat + $penambahan;
					$masa_manfaat = $masa_manfaat > $gedung->masa_manfaat ? $gedung->masa_manfaat : $masa_manfaat;
					
					# Hitung nilai susut
					$nilai_susut  = $_perolehan_per_tahun + $_nilai_buku;
					$tarif_beban_penyusutan = $nilai_susut / $masa_manfaat;
					$masa_pemanfaatan 		= $rehab->tahun_perolehan - ($rehab->tahun_perolehan - 1);

					if ($key >= count($data->rehab) - 1)
					{
						$masa_pemanfaatan = $this->tahun_penyusutan - ($rehab->tahun_perolehan - 1);
					}

					$akumulasi_penyusutan = $tarif_beban_penyusutan * $masa_pemanfaatan;
					$nilai_buku 		  = $nilai_susut - $akumulasi_penyusutan;

					# CETAK KE EXCEL
					$rehab->masa_manfaat = $masa_manfaat;

					$_perolehan 		 += $_perolehan_per_tahun;
					$_akumulasi 		 += $akumulasi_penyusutan;
					$_nilai_buku		  = $nilai_buku;	
					$_masa_manfaat 		  = $masa_manfaat;
					$_perolehan_per_tahun = 0;
				}
			}

			$gedung->rehab[$key] = $rehab;
		}

		$gedung->masa_manfaat 			 = $masa_manfaat;
		$gedung->masa_pemanfaatan 		 = $masa_pemanfaatan;
		$gedung->tarif_beban_penyusutan	 = $tarif_beban_penyusutan;
		$gedung->beban_penyusutan 		 = $tarif_beban_penyusutan;

		# This is what's probably wrong
		$gedung->akumulasi_penyusutan_min 	= $_akumulasi - $gedung->tarif_beban_penyusutan;
		# ===================================================================================
		
		$gedung->akumulasi_penyusutan 	 	= $_akumulasi;
		$gedung->nilai_buku 			 	= $_nilai_buku;

		return $gedung;
	}

	private function rehab_no_2014($data)
	{
		$data->rehab = $this->sorting_rehab($data->rehab);
		$tmp 		 = $this->no_rehab($data);
		$tmp->rehab  = array();

		$tmp->akumulasi_penyusutan_min = "";
		$tmp->masa_pemanfaatan 	   = ($data->rehab[0]->tahun_pengadaan - 1) - ($tmp->tahun_perolehan - 1);
		$tmp->akumulasi_penyusutan = $tmp->beban_penyusutan * $tmp->masa_pemanfaatan;
		$tmp->nilai_buku 		   = $tmp->nilai_perolehan - $tmp->akumulasi_penyusutan;

		$_perolehan_per_tahun = 0;
		$_nilai_buku 		  = $tmp->nilai_buku;
		$_perolehan 		  = $tmp->nilai_perolehan;
		$_akumulasi 		  = $tmp->akumulasi_penyusutan;
		$_masa_manfaat	  	  = $tmp->masa_manfaat - $tmp->masa_pemanfaatan;

		foreach ($data->rehab as $key => $value)
		{
			$rehab = new stdClass();
			$rehab->category_kode 			 = $this->category[$value->category_id]->kode;
			$rehab->nama 		 			 = $value->nama;
			$rehab->skpd 	 	 			 = $this->skpd[$value->skpd_id]->name;
			$rehab->tahun_perolehan 	   	 = $value->tahun_pengadaan;
			$rehab->nilai_perolehan 	   	 = $value->nilai;

			$_perolehan_per_tahun += $rehab->nilai_perolehan;

			if ($this->is_break($data->rehab, $key)) 
			{
				$persentase   = round($_perolehan_per_tahun / $_perolehan * 100);
				$persentase   = $persentase > 100 ? 100 : $persentase;
				$penambahan   = $this->CI->umur->get_tahun($tmp->category_kode, $persentase);
				$masa_manfaat = $_masa_manfaat + $penambahan;
				$masa_manfaat = $masa_manfaat > $tmp->masa_manfaat ? $tmp->masa_manfaat : $masa_manfaat;
				$nilai_susut  = $_perolehan_per_tahun + $_nilai_buku;
				$tarif_beban_penyusutan = $nilai_susut / $masa_manfaat;
				$masa_pemanfaatan 		= $rehab->tahun_perolehan - ($rehab->tahun_perolehan - 1);

				if ($key >= count($data->rehab) - 1)
				{
					$masa_pemanfaatan = $this->tahun_penyusutan - ($rehab->tahun_perolehan - 1);
				}

				$akumulasi_penyusutan = $tarif_beban_penyusutan * $masa_pemanfaatan;
				$nilai_buku 		  = $nilai_susut - $akumulasi_penyusutan;

				# CETAK KE EXCEL
				$rehab->masa_manfaat = $masa_manfaat;
				// $rehab->masa_pemanfaatan = $masa_pemanfaatan;

				$_perolehan 		 += $_perolehan_per_tahun;
				$_akumulasi 		 += $akumulasi_penyusutan; 
				$_nilai_buku		  = $nilai_buku;	
				$_masa_manfaat 		  = $masa_manfaat;
				$_perolehan_per_tahun = 0;
			}

			$tmp->rehab[$key] = $rehab;
		}

		$tmp->tarif_beban_penyusutan 	= $tarif_beban_penyusutan;
		$tmp->beban_penyusutan 		 	= $tarif_beban_penyusutan;
		$tmp->akumulasi_penyusutan_min 	= $_akumulasi - $tmp->tarif_beban_penyusutan;
		$tmp->akumulasi_penyusutan 	 	= $_akumulasi;
		$tmp->nilai_buku 			 	= $_nilai_buku;

		return $tmp;
	}

	private function has_2014($rehab)
	{
		foreach ($rehab as $key => $value) {
			if ($value->tahun_pengadaan <= 2014) {
				return TRUE;
			}
		}

		return FALSE;
	}

	private function has_2015($rehab)
	{
		foreach ($rehab as $key => $value) {
			if ($value->tahun_pengadaan > 2014) {
				return TRUE;
			}
		}

		return FALSE;
	}

	private function get_tahun_rehab_after_2014($rehab)
	{
		$result = array();
		foreach ($rehab as $key => $value) {
			if ($value->tahun_pengadaan > 2014) {
				$result[] = $value->tahun_pengadaan;
			}
		}
		return $result;
	}

	private function sorting_rehab($data)
	{
		for($i=0; $i<count($data); $i++)
		{
			for($j=0; $j<count($data)-1; $j++)
			{
				if ($data[$j]->tahun_pengadaan > $data[$j+1]->tahun_pengadaan) {
					$tmp 		= $data[$j];
					$data[$j] 	= $data[$j+1];
					$data[$j+1] = $tmp;
				}
			}
		}

		return $data;
	}

	private function is_break($rehab, $key)
	{
		$con1 = $key >= count($rehab) - 1;
		$con2 = $key < count($rehab) - 1 AND $rehab[$key]->tahun_pengadaan !== $rehab[$key+1]->tahun_pengadaan;

		return  $con1 OR $con2; 
	}
}