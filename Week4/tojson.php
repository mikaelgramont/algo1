<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
set_time_limit(120);

class Utils
{
	public static function getList($filename)
	{
		$max = 0;
		$list = [];
		$file = fopen($filename, "r");
		while(!feof($file)){
			$row = trim(fgets($file));
			$values = explode(" ", $row);

			$tail = (int)$values[0] - 1;
			$head = (int)$values[1] - 1;

			if ($tail > $max) $max = $tail;
			if ($head > $max) $max = $head;

			if (!array_key_exists($tail, $list)) {
				$list[$tail] = [];
			}
			$list[$tail][] = $head;
		}
		fclose($file);

		$list2 = [];
		for ($i = 0; $i <= $max; $i++) {
			if (array_key_exists($i, $list)) {
				$list2[$i] = $list[$i];
				//echo "Copying entry $i\n";
			} else {		
				$list2[$i] = [];
				//echo "Creating entry $i\n";
			}
		}
		$data = json_encode($list2);
		file_put_contents("out.js", $data);
	}
}
$id = isset($_GET['id']) ? $_GET['id'] : '1';
// echo Utils::getList("example".$id.".txt");
Utils::getList("SCC.txt");