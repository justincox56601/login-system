<?php
/**
 * Data scraping file
 * https://w1.weather.gov/data/obhistory/KBJI.html
 * 
 */
include_once APPROOT . '/libraries/simple_html_dom.php';
echo "<h1>Weather</h1>";
$curl = curl_init('https://w1.weather.gov/data/obhistory/KBJI.html');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$agent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)';
curl_setopt($curl, CURLOPT_USERAGENT, $agent);
$page = curl_exec($curl);
if(curl_errno($curl)){
	echo "scraper error: " . curl_error($curl);
	exit;
}

curl_close($curl);

$html = str_get_html($page);
$tables = $html->find('table');

//$table = $tables[3];
//$rows = $table->find('tr');


$rows = $tables[3]->find('tr');
$data = [];
	
for($r=3; $r<sizeof($rows); $r++){
	//echo "Row #$r<br>";

	$cells = $rows[$r]->find('td');
	
	for($c=0; $c<sizeof($cells); $c++){
		//echo "$c => " . $cells[$c]->plaintext . "  ";
		$temp = [
			'Date' 							=> $cells[0]->plaintext,
			'Time (CDT)' 					=> $cells[1]->plaintext,
			'Wind (MPH)' 					=> $cells[2]->plaintext,
			'Visv (mi)' 					=> $cells[3]->plaintext,
			"Weather" 						=> $cells[4]->plaintext, 
			'Sky Condition' 				=> $cells[5]->plaintext,
			'Temperature - Air (F)' 		=> $cells[6]->plaintext,
			'Temperature - Dewpoint (F)' 	=> $cells[7]->plaintext,
			'Relative Humidity' 			=> $cells[10]->plaintext,
			'Windchill (F)' 				=> $cells[11]->plaintext,
			'Heat Index (F)' 				=> $cells[12]->plaintext,
			'Pressure - Altimeter (in)' 	=> $cells[13]->plaintext,
			'Precipiation - 1 hour (in)' 	=> $cells[15]->plaintext,
		];

		$data[] = $temp;
	}
	//echo "<br>";

}

echo '<pre>';
print_r($data);