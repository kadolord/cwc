<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function sanitize($in) {
	return addslashes(htmlspecialchars(strip_tags(trim($in))));
}

function clean($in){
	return preg_replace('/[^A-Za-z0-9\-]/','',$in);
}

function generate_json($data) {
	header("access-control-allow-origin: *");
	header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
	header('Content-type: application/json');
	echo json_encode($data);
}

function today() {
	date_default_timezone_set('Asia/Manila');
	return date("Y-m-d");
}

function today2() {
	date_default_timezone_set('Asia/Manila');
	return date("m/d/Y");
}

function today_text() {
	date_default_timezone_set('Asia/Manila');
	return date("Y/m/d");
}

function today_date() {
	date_default_timezone_set('Asia/Manila');
	return date("m/d/Y");
}
function today_date2() {
	date_default_timezone_set('Asia/Manila');
	return date("m/d/Y",strtotime("+90 days"));
}

function today_text2() {
	date_default_timezone_set('Asia/Manila');
	return date("Y/m/d", strtotime("+90 days"));
}

function todaytime() {
	date_default_timezone_set('Asia/Manila');
	return date("Y-m-d G:i:s");
}

function company_name() {
	echo "SBMS - Subaybay Bata Monitoring System";
}

function company_name_php() { //please change the content same as company_name() function.
	return "SBMS - Subaybay Bata Monitoring System";
}

function company_initial() {
	echo "SBMS";
}

function powered_by(){
	echo "Powered by <a href='http://www.cloudpanda.ph/' class='external' style='text-decoration:underline;'>Cloud Panda PH</a>";
}

function en_dec($action, $string) //used for token
{
	$output = false;

	$encrypt_method = "AES-256-CBC";
	$secret_key = 'CloudPandaPHInc';
	$secret_iv = 'TheDarkHorseRule';

	// hash
	$key = hash('sha256', $secret_key);

	// iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
	$iv = substr(hash('sha256', $secret_iv), 0, 16);

	if( $action == 'en' ) 
	{
	  $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
	  $output = base64_encode($output);
	}
	else if( $action == 'dec' )
	{
	  $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
	}

	return $output;
}

function Generate_random_password() {
    $alphabet = "abcdefghijklmnopqrstuwxyz";
    $alphabetUpper = "ABCDEFGHIJKLMNOPQRSTUWXYZ";
    $alphabetNumber = "0123456789";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabetNumber) - 1; //put the length -1 in cache
    for ($i = 0; $i < 3; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n].$alphabetUpper[$n].$alphabetNumber[$n];
    }
    return implode($pass); //turn the array into a string
}

function generate_player_no(){
	$letters = array("A","B","C","D","E",
					 "F","G","H","I","J",
					 "K","L","M","N","O",
					 "P","Q","R","S","T",
					 "U","V","W","X","Y",
					 "Z");

	$numbers = array("1","2","3","4","5",
					 "6","7","8","9","0");

	$generated_key = array();
	for($x=0; $x < 11; $x++){	 
		if (count($generated_key) < 4) {
			$get_val = array_rand($letters, 1);

			array_push($generated_key, $letters[$get_val]);
		}else{
			$get_val = array_rand($numbers, 1);
			array_push($generated_key, $numbers[$get_val]);
		}
	}
	$generated_key = implode("",$generated_key);

	return $generated_key;
}