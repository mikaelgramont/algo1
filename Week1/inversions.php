<?php
// phpinfo();
// exit();
$filename = $_GET['file'] ? $_GET['file'] : 'numbers.txt';
$inversionCounter = new InversionCounter();

// list($b, $x) = $inversionCounter->sortAndCount(Utils::getFirstHalf($a));
// list($c, $y) = $inversionCounter->sortAndCount(Utils::getSecondHalf($a));
// list($d, $z) = $inversionCounter->mergeAndCountSplitInv($b, $c);


$sorted = $inversionCounter->sortAndCount(Utils::getNumbers($filename));
// Utils::dump($sorted);


echo "Total inversions: " . $inversionCounter->getTotalInversions();


class InversionCounter
{
	public $inversions = 0;

	public function getTotalInversions()
	{
		return $this->inversions;
	}

	public function sortAndCount($arr)
	{
		if (sizeof($arr) < 2) {
			return [$arr, 0];
		}

		list($x, $b) = $this->sortAndCount(Utils::getFirstHalf($arr));
		list($y, $c) = $this->sortAndCount(Utils::getSecondHalf($arr));
		return $this->merge($b, $c, $x + $y);
	}

	public function merge($b, $c, $count)
	{
		$length = sizeof($b) + sizeof($c);
		$result = array();
		$i = 0;
		$j = 0;

		while ($i < sizeof($b) and $j < sizeof($c)) {
			if ($b[$i] < $c[$j]) {
				$result[] = $b[$i];
				$i++;
			} else {
				$result[] = $c[$j];
				$j++;

				$count += sizeof($b) - $i;
			}
		}
		array_merge($result, array_slice($b, $i));
		array_merge($result, array_slice($c, $j));
		Utils::dump([$count,$result]);		
		return [$count, $result];
	}
}


class Utils
{
	public static function getNumbers($filename)
	{
		$arr = [];
		$file = fopen($filename, "r");
		while(!feof($file)){
		    $arr[] = fgets($file);
		}
		fclose($file);
		return $arr;
	}

	public static function dump($var)
	{
		echo "<pre>";
		print_r($var);
		echo "</pre>";
	}	

	public static function getFirstHalf($arr)
	{
		$length = sizeof($arr) / 2;
		return array_slice($arr, 0, $length);
	}

	public static function getSecondHalf($arr)
	{
		$start = sizeof($arr) / 2;
		return array_slice($arr, $start);
	}
}