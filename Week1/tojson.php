<?php
class Utils
{
	public static function getNumbers($filename)
	{
		$arr = [];
		$file = fopen($filename, "r");
		while(!feof($file)){
			$val = trim(fgets($file));
			if ($val) {
			    $arr[] = $val;
			}
		}
		fclose($file);

		return json_encode($arr);
	}
}

$filename = $_GET['file'] ? $_GET['file'] : 'IntegerArray.txt';
echo Utils::getNumbers($filename);