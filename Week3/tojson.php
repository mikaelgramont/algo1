<?php
class Utils
{
	public static function getList($filename)
	{
		$list = [];
		$file = fopen($filename, "r");
		while(!feof($file)){
			$row = trim(fgets($file));
			$values = explode("\t", $row);
			// Remove the first entry, the index.
			array_shift($values);

			$currentValues = [];
			for($i = 0; $i < sizeof($values); $i++) {
				$currentValues[] = (int) $values[$i];
			}
			$list[] = $currentValues;
		}
		fclose($file);

		return json_encode($list);
	}
}

$filename = isset($_GET['file']) ? $_GET['file'] : 'kargerMinCut.txt';
echo Utils::getList($filename);