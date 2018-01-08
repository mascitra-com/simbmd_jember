<?php
if ( ! function_exists('set_profile_picture'))
{
	function set_profile_picture($file="")
	{
		$file_name = 'blank.png';
		if (! empty($file) && file_exists(realpath('./././res/img/user/'.$file))) {
			$file_name = $file;
		}
		return $file_name;
	}

	if ( ! function_exists('money'))
	{
		function money($text="")
		{
			return number_format($text,0,',','.');
		}
	}
}
?>