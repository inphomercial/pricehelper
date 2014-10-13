<?php

error_reporting(E_ALL);
include_once(__DIR__.'/../vendors/simple_html_dom.php');
ini_set('memory_limit', '512M');

class Scrapper {

	function __construct($city, $keyword) {
		$this->city = $city;
		$this->keyword = $keyword;
	}

	function scrape_cl() {
		$full_url = 'http://'.$this->city.'.craigslist.org/search/sss?sort=date&query=' . urlencode($this->keyword) . '#pic';
		$html = file_get_html($full_url);

		// print $html;die();

		if($html) {
			foreach($html->find('p.row') as $element) {

				// Date as string "Oct 11"
				$date = $element->find('time', 0);
				if(is_object($date)) {
					$item['date'] = trim($date->plaintext);
				}

    				if($element->find('a', 0)->href)
    					$item['link'] = trim($element->find('a', 0)->href);

    				if($element->find('a.hdrlnk', 0)->plaintext)
					$item['title'] = trim($element->find('a.hdrlnk', 0)->plaintext);

				// Price
				$price = $element->find('span.price', 0);
				if(is_object($price)) {
    					$dirty = trim($price->plaintext);
	    				$item['price'] = intval(str_replace('&#x0024;', "", $dirty));
				}

				$city = $element->find('span.pnr small', 0);
				if(is_object($city)) {
					$item['city'] = trim($city->plaintext);
				}

				// Category
				$item['category'] = trim($element->find('a.gc', 0)->plaintext);

				// Pic (NOT WORKING)
				$pic = $element->find('img', 0);
				if(is_object($pic)) {
					$item['pic'] = $pic->src;
				}

    				$ret[] = $item;
    			}

    			$html->clear();
			unset($html);

			return $ret;
		}
		else {
			return "Failed to get data";
		}
	}
}

?>
