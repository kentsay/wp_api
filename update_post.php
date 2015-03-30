<?php

$server  = 'http://localhost';
$port    = '8888';
$uri     = '/wp/wp-json/';
$url = $server . ":" . $port . $uri;
$ch = curl_init();

switch ($argv[1]) {
	case 'query':
		query_post($ch, $url);
		break;
	case 'post':
		creat_new_post($ch, $url);
		break;
	case 'update':
    $update_value = $argv[2];
		update_post($ch, $url, $update_value);
		break;
	default:
		query_post($ch, $url);
		break;
}


$result = curl_exec($ch);
var_dump($result);
curl_close($ch);

	
function query_post($ch, $url) {
	$url = $url . "posts";
	curl_setopt($ch,CURLOPT_URL, $url);
}

function create_new_post_with_pods() {
	$url = $url . "pods/data";

	$data = new stdClass();
	$data->title  = "Location";
	$data->type   = "data";
	$data->status = "publish";
	$data->uri = "10";

	$data_string = json_encode($data);
	var_dump($data_string);
	curl_setopt($ch,CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
    	'Authorization: ' . 'Basic ' . base64_encode( 'test' . ':' . 'password' ), 
    	'Content-Type: application/json',                                                                                
    	'Content-Length: ' . strlen($data_string))                                                                       
	);                                 
}

function creat_new_post($ch, $url) {	
	$url = $url . "posts";

	$data = new stdClass();
	$data->title  = "RFID";
	$data->type   = "sensor";
	$data->status = "publish";
	$data->content_raw = "post by api testing";

	$data_string = json_encode($data);
	var_dump($data_string);
	curl_setopt($ch,CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
    	'Authorization: ' . 'Basic ' . base64_encode( 'test' . ':' . 'password' ), 
    	'Content-Type: application/json',                                                                                
    	'Content-Length: ' . strlen($data_string))                                                                       
	);                                                 
}

function update_post($ch, $url, $update_value) {
	$url = $url . "posts/100/meta/794";
	$data = array(
				"key"   => "numofpeople",
				"value" => $update_value				
			);
	$data_string = json_encode($data);
	curl_setopt($ch,CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
    	'Authorization: ' . 'Basic ' . base64_encode( 'test' . ':' . 'password' ), 
    	'Content-Type: application/json',                                                                                
    	'Content-Length: ' . strlen($data_string))                                                                       
	);                                                 
}

?>
