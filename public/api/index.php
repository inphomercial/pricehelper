<?php

require __DIR__.'/../../vendor/autoload.php';
require __DIR__.'/models/CraigsListScrapper.php';
// require __DIR__.'/models/CraigsListScrapper.php';

$app = new Slim\Slim();

$app->get('/search/:city/:keyword', 'search');

$app->run();

function search($city, $keyword) {
	ini_set('user_agent', 'My-Application');

	$craig = new Scrapper($city, $keyword);
	$results = $craig->scrape_cl();

	if(!$results) die("failed");
	
	print json_encode($results);
	exit;
};


