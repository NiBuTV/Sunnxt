<?php

$id = $_GET['id'];

$link = "https://www.sunnxt.com/next/api/media/$id?playbackCounter=1&fields=contents,user/currentdata,images,generalInfo,subtitles,relatedCast,globalServiceName,globalServiceId,relatedMedia,videos,thumbnailSeekPreview&licenseType=false";


$sunnxt_heads = array('User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/104.0.0.0 Safari/537.36',

'Cookie: sessionid=6ppmhggmtnsr1bg5a2zx9nnxblmerbtj',

'x-myplex-platform: browser');

$process = curl_init($link); 

curl_setopt($process, CURLOPT_HTTPHEADER, $sunnxt_heads);

curl_setopt($process, CURLOPT_HEADER, 0);

curl_setopt($process, CURLOPT_TIMEOUT, 30); 

curl_setopt($process, CURLOPT_RETURNTRANSFER, 1); 

curl_setopt($process, CURLOPT_FOLLOWLOCATION, 1); 
  
$response = curl_exec($process); 

$mxp= json_decode("$response", true);

$response = $mxp["response"];

$blackx = base64_decode($response);

//echo $response;


//$sui = base64_encode($return);

curl_close($process);
//$get = file_get_contents('sunkey.json');
//$de = json_decode($get);
$secretHash ="==AUxcDJzh0ZTJ1ThhjNzNTQ";
$hashrev = strrev($secretHash);
$finalkey = base64_decode($hashrev);
//echo $finalkey;
//$hexKey = bin2hex($secretHash);

$finaldata = openssl_decrypt($blackx, 'aes-128-cbc', $finalkey, OPENSSL_RAW_DATA, '');

//echo $return;
//$outdata = @json_decode(@json_decode($decrypted, true), true);
//echo $finaldata;

//echo $return;
//echo $finaldata;
$json = json_decode($finaldata, true);
$base = $json['results'][0]['videos']['values'][0]['link'];
//echo $base;
header('Location:'.$base);


?>