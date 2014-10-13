<?php

error_reporting(0);
include_once('simple_html_dom.php');

function scrape_cl($city, $keyword) {

    $html = file_get_html('http://'.$city.'.craigslist.org/search/sss?query=' . $keyword . '&sort=rel#pic');

    foreach($html->find('p.row') as $element) {

		if($element->find('span.date', 0)->plaintext)
			$item['date'] = trim($element->find('span.date', 0)->plaintext);

    	if($element->find('a', 0)->href)
    		$item['link'] = trim($element->find('a', 0)->href);

    	if($element->find('a.hdrlnk', 0)->plaintext)
			$item['title'] = trim($element->find('a.hdrlnk', 0)->plaintext);

    	if($element->find('span.price', 0)->plaintext)
    	{
    		$dirty = trim($element->find('span.price', 0)->plaintext);
    		$item['price'] = str_replace('&#x0024;', "", $dirty);
    	}

		$item['city'] = trim($element->find('span.pnr small', 0)->plaintext);

		$item['category'] = trim($element->find('a.gc', 0)->plaintext);

		//$item['pic'] = $element->find('img', 0)->innertext;

    	$ret[] = $item;
    }

    // clean up memory
    $html->clear();
    unset($html);

    return $ret;
}

function build_prices_array($array) {

	$prices = array();
	foreach($array as $price)
	{
		$prices[] = $price['price'];
	}

	return $prices;
}

function get_average_price($array) {
	return array_sum($array) / count($array);
}

function get_highest_price($array) {
	return max($array);

}
function get_lowest_price($array) {
	return min($array);
}


// -----------------------------------------------------------------------------
// test it!

ini_set('user_agent', 'My-Application/2.5');

$ret = scrape_cl($_GET['city'], $_GET['keyword']);

// Build prices array once
$prices = build_prices_array($ret);

$ret['HIGHEST'] = get_highest_price($prices);
$ret['LOWEST'] = get_lowest_price($prices);
$ret['AVERAGE'] = get_average_price($prices);

print json_encode($ret);
die();

?>
