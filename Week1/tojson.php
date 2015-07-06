<?php
class Utils
{
	public static function getNumbers($filename)
	{
		$arr = [];
		$file = fopen($filename, "r");
		while(!feof($file)){
		    echo fgets($file).",\n";
		}
		fclose($file);
	}
}

$filename = $_GET['file'] ? $_GET['file'] : 'IntegerArray.txt';
echo 'var numbers = [';
Utils::getNumbers($filename);
echo '];';