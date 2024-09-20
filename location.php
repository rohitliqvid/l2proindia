<?php

$curl = curl_init();
$address="SLOBOZIA, STR.VIITOR%20NR.12,JUD IALOMITA, Romania";
curl_setopt_array($curl, [
	CURLOPT_URL => "https://address-from-to-latitude-longitude.p.rapidapi.com/geolocationapi?address=".$address,
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
		"X-RapidAPI-Host: address-from-to-latitude-longitude.p.rapidapi.com",
		"X-RapidAPI-Key: a8c8fa316fmsh34140c0c0a5ff3fp18fcb6jsnee263e76c1d0"
	],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
	echo $response;
}