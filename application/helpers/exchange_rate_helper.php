<?php
defined('BASEPATH') OR exit('No direct script access allowed');


function get_exchange_rate($end_point, $from, $to,$amount, $access_key )
{

		// initialize CURL:
		$ch = curl_init('https://api.exchangeratesapi.io/v1/'.$endpoint.'?access_key='.$access_key.'&from='.$from.'&to='.$to.'&amount='.$amount.'');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		// get the JSON data:
		$json = curl_exec($ch);
		print_r($json);
		$error = curl_error($ch);
		if($error)
		{
			return $error;
		}
		curl_close($ch);
		// Decode JSON response:
		$conversionResult = json_decode($json, true);
		// access the conversion result
		return $conversionResult['result'];

}



?>