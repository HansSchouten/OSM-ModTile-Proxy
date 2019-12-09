<?php
// get tile identifier parameters
$z = intval($_GET['z']);
$x = intval($_GET['x']);
$y = intval($_GET['y']);

// check if the requested tile is rendered and stored locally
// (if not, this request will init the rendering process)
$ch_local = curl_init("http://localhost/hot/$z/$x/$y.png");
curl_setopt($ch_local, CURLOPT_CONNECTTIMEOUT, 0.5);
curl_setopt($ch_local, CURLOPT_TIMEOUT, 0.5);
curl_setopt($ch_local, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch_local);

// if no error occurred return locally rendered image, on timeout return openstreetmap tile
if (! curl_errno($ch_local)) {
	header ('Content-Type: image/png');
	echo $response;
} else {
	$server = [];
	$server[] = 'a.tile.openstreetmap.org';
	$server[] = 'b.tile.openstreetmap.org';
	$server[] = 'c.tile.openstreetmap.org';

	$url = 'http://' . $server[array_rand($server)] . "/$z/$x/$y.png";

	$ch = curl_init($url);
	$fp = fopen($file, "w");
	curl_setopt($ch, CURLOPT_FILE, $fp);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_exec($ch);
	curl_close($ch);
	fflush($fp);
	fclose($fp);
}
