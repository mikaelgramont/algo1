<?php
class Utils
{
	public static function getList($filename)
	{
		$list = [];
		$file = fopen($filename, "r");
		while(!feof($file)){
			$row = trim(fgets($file));
			$values = explode(" ", $row);

			$tail = (int)$values[0];
			$head = (int)$values[1];

			if (!array_key_exists($tail, $list)) {
				$list[$tail] = [];
			}
			$list[$tail][] = $head;
		}
		fclose($file);

		return json_encode(array_values($list));
	}
}

$id = isset($_GET['id']) ? $_GET['id'] : '1';
echo Utils::getList("example".$id.".txt");