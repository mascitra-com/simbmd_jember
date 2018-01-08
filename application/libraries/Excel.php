<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Excel 
{
	protected $file;
	protected $startRow;
	protected $result;
	protected $CI;

	public function __construct()
	{
		$this->CI =& get_instance();
		# Panggil library
		require_once APPPATH . 'libraries/PHPExcel.php';
	}

	public function init($config = array())
	{
		if (isset($config['file'])) {
			$this->file = $config['file'];
		}

		if (isset($config['startRow'])) {
			$this->startRow = $config['startRow'];
		}
	}

	public function import($config = array())
	{
		if (!empty($config)) {
			$this->init($config);
		}

		try 
		{
			# Cek tipe file
			$inputFileType = PHPExcel_IOFactory::identify($this->file);

			# Membuat objek pembaca file
			$objReader = PHPExcel_IOFactory::createReader($inputFileType);
			$excel 	   = $objReader->load($this->file);
		} 
		catch (Exception $e) 
		{
			die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());
		}

		$sheet 		= $excel->getSheet(0);
		$maxCell 	= $sheet->getHighestRowAndColumn();
		$startRow 	= $this->startRow;
		$result 	= array();

		# Jika file tidak kosong
		if ( $maxCell > 1 )
		{	
			return $sheet->rangeToArray('A'.$startRow.':'.$maxCell['column'].$maxCell['row']);
		}
		else
		{
			die('Data kosong...');
		}
	}

	public function export_penyusutan($config = array())
	{
	    # Set path dan ambil tipe file
		$output			= "penyusutan_".$config['kib']."_".$config['tahun_penyusutan'].".xls";
		$template 		= FCPATH.'/res/docs/pre/template_penyusutan.xls';
		$inputFileType 	= PHPExcel_IOFactory::identify($template);
		
		# Buat objek
		$excel = PHPExcel_IOFactory::createReader($inputFileType);
		$excel = $excel->load($template);
		
		# Set sheet aktif
		$excel->setActiveSheetIndex(0);

		# Set judul sheet
		$excel->getActiveSheet()->setTitle($config['kib']);

		$startRow = 9;
		$row 	  = $startRow;
		$number   = 1;

		# Write header
		$excel->getActiveSheet()->setCellValue("B2", $config['tahun_penyusutan']);
		$excel->getActiveSheet()->setCellValue("B3", $config['kib']);
		$excel->getActiveSheet()->setCellValue("B4", $config['skpd']);

		# Write data
		foreach ($config['assets'] as $key => $value)
		{
			$excel->getActiveSheet()->setCellValue("A{$row}", $number++);
			$excel->getActiveSheet()->setCellValue("B{$row}", $value->category_kode);
			$excel->getActiveSheet()->setCellValue("C{$row}", trim($value->nama));
			$excel->getActiveSheet()->setCellValue("D{$row}", "1");
			$excel->getActiveSheet()->setCellValue("E{$row}", $value->tahun_perolehan);
			$excel->getActiveSheet()->setCellValue("F{$row}", $value->nilai_perolehan);
			$excel->getActiveSheet()->setCellValue("G{$row}", $value->masa_manfaat);
			$excel->getActiveSheet()->setCellValue("H{$row}", $value->akumulasi_penyusutan_min);
			$excel->getActiveSheet()->setCellValue("I{$row}", $value->tarif_beban_penyusutan);
			$excel->getActiveSheet()->setCellValue("J{$row}", $value->masa_pemanfaatan);
			$excel->getActiveSheet()->setCellValue("K{$row}", $value->akumulasi_penyusutan);
			$excel->getActiveSheet()->setCellValue("L{$row}", $value->nilai_buku);
			$excel->getActiveSheet()->setCellValue("M{$row}", $value->beban_penyusutan);
			$excel->getActiveSheet()->setCellValue("N{$row}", $value->skpd);
			$row++;

			if (isset($value->rehab) && !empty($value->rehab))
			{
				foreach ($value->rehab as $r_key => $r_value) {
					$excel->getActiveSheet()->setCellValue("A{$row}", $number++);
					$excel->getActiveSheet()->setCellValue("C{$row}", trim($r_value->nama));
					$excel->getActiveSheet()->setCellValue("E{$row}", $r_value->tahun_perolehan);
					$excel->getActiveSheet()->setCellValue("F{$row}", $r_value->nilai_perolehan);
					$excel->getActiveSheet()->setCellValue("G{$row}", $r_value->masa_manfaat);
					$excel->getActiveSheet()->setCellValue("H{$row}", isset($r_value->akumulasi_penyusutan_min) ? $r_value->akumulasi_penyusutan_min : '');
					$excel->getActiveSheet()->setCellValue("I{$row}", isset($r_value->tarif_beban_penyusutan) ? $r_value->tarif_beban_penyusutan : '');
					$excel->getActiveSheet()->setCellValue("J{$row}", isset($r_value->masa_pemanfaatan) ? $r_value->masa_pemanfaatan : '');
					$excel->getActiveSheet()->setCellValue("K{$row}", isset($r_value->akumulasi_penyusutan) ? $r_value->akumulasi_penyusutan : '');
					$excel->getActiveSheet()->setCellValue("L{$row}", isset($r_value->nilai_buku) ? $r_value->nilai_buku : '');
					$excel->getActiveSheet()->setCellValue("M{$row}", isset($r_value->beban_penyusutan) ? $r_value->beban_penyusutan : '');
					$row++;
				}
			}
		}

		$excel->getActiveSheet()->setCellValue("F{$row}", "=SUM(F{$startRow}:F".($row-1).")");
		$excel->getActiveSheet()->setCellValue("H{$row}", "=SUM(H{$startRow}:H".($row-1).")");
		$excel->getActiveSheet()->setCellValue("I{$row}", "=SUM(H{$startRow}:I".($row-1).")");
		$excel->getActiveSheet()->setCellValue("K{$row}", "=SUM(K{$startRow}:K".($row-1).")");
		$excel->getActiveSheet()->setCellValue("L{$row}", "=SUM(L{$startRow}:L".($row-1).")");
		$excel->getActiveSheet()->setCellValue("M{$row}", "=SUM(M{$startRow}:M".($row-1).")");

		# Styling Border
		$style = array('borders'=>array('allborders'=>array('style'=>PHPExcel_Style_Border::BORDER_THIN)));
		$excel->getActiveSheet()->getStyle("A{$startRow}:N{$row}")->applyFromArray($style);

		# Styling Background Color
		$bgcolor = array('fill'=>array('type'=>PHPExcel_Style_Fill::FILL_SOLID, 'color'=>array('rgb'=>'CDC9C9')));
		$excel->getActiveSheet()->getStyle("A{$row}:N{$row}")->applyFromArray($bgcolor);

		# Save & download
		$objFinal = PHPExcel_IOFactory::createWriter($excel, "Excel5");
		header("Content-Type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename={$output}");
		header("Cache-Control: max-age=0");
		$objFinal->save('php://output');
	}

	public function export($config = array())
	{
		# Set path dan ambil tipe file
		$output			= "Data_aset_".$config['kib'].".xls";
		$template 		= FCPATH.'/res/docs/pre/template_laporan.xls';
		$inputFileType 	= PHPExcel_IOFactory::identify($template);
		
		# Buat objek
		$excel = PHPExcel_IOFactory::createReader($inputFileType);
		$excel = $excel->load($template);
		
		# Set sheet aktif
		$excel->setActiveSheetIndex(0);

		# Set judul sheet
		$excel->getActiveSheet()->setTitle($config['kib']);

		$startRow = 5;
		$row 	  = $startRow;

		# Write header
		$excel->getActiveSheet()->setCellValue("B2", $config['kib']);
		$excel->getActiveSheet()->setCellValue("B3", $config['skpd']);

		# Write header
		if (count($config['assets']) > 0)
		{
			# Write header
			$col = 'A';
			foreach ($config['assets'][0] as $index => $item)
			{
				if (strtolower($index) !== 'rehab') {
					$excel->getActiveSheet()->setCellValue(($col++).$row, $index);
				}
			}
			$row++;

			# Write data
			foreach ($config['assets'] as $key => $value)
			{	
				$col   = 'A';
				$rehab = isset($value->rehab) ? $value->rehab : array();

				unset($value->rehab);

				# Main Data
				foreach ($value as $index => $item)
				{
					$excel->getActiveSheet()->setCellValue(($col++).$row, $item);
				}
				$row++;

				# Rehab
				if (!empty($rehab)) 
				{
					foreach ($rehab as $r_key => $r_value) 
					{
						$col = 'A';
						foreach ($r_value as $r_index => $r_item)
						{
							$excel->getActiveSheet()->setCellValue(($col++).$row, $r_item);
						}
						$row++;
					}
				}

				$lastCol = $col--;
			}
			

			# Styling Border
			$style = array('borders'=>array('allborders'=>array('style'=>PHPExcel_Style_Border::BORDER_THIN)));
			$excel->getActiveSheet()->getStyle("A{$startRow}:{$lastCol}{$row}")->applyFromArray($style);

			# Styling Background Color
			$bgcolor = array('fill'=>array('type'=>PHPExcel_Style_Fill::FILL_SOLID, 'color'=>array('rgb'=>'CDC9C9')));
			$excel->getActiveSheet()->getStyle("A{$startRow}:{$lastCol}{$startRow}")->applyFromArray($bgcolor);
		}

		# Save & download
		$objFinal = PHPExcel_IOFactory::createWriter($excel, "Excel5");
		header("Content-Type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename={$output}");
		header("Cache-Control: max-age=0");
		$objFinal->save('php://output');
	}
}