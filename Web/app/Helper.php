<?php

namespace App;

class Helper
{
    public static function formatCode($code)
    {
        return str_replace('>', 'HTMLCloseTag', str_replace('<', 'HTMLOpenTag', $code));
    }

    public static function count($route, $id, $str = 'count'){
		$username = 'user';
		$password = 'user';
		$credentials = base64_encode("$username:$password");
		$headers = [];
		$headers[] = "Authorization: Basic {$credentials}";
		$headers[] = 'Content-Type: application/x-www-form-urlencoded';
		$headers[] = 'Cache-Control: no-cache';
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL,"127.0.0.2:8001/$route/$id/$str");
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($curl);
		if($e = curl_error($curl)) {
			echo $e;
		} else {
			$decodedData = json_decode($response, true) ;
			$data = $decodedData;
		}
		curl_close($curl);
        return $data;
    }

    public static function index($route){
        $username = 'user';
		$password = 'user';
		$credentials = base64_encode("$username:$password");
		$headers = [];
		$headers[] = "Authorization: Basic {$credentials}";
		$headers[] = 'Content-Type: application/x-www-form-urlencoded';
		$headers[] = 'Cache-Control: no-cache';
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL,"127.0.0.2:8001/$route");
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($curl);
		if($e = curl_error($curl)) {
			echo $e;
		} else {
			$decodedData =
			json_decode($response, true) ;
			$data = $decodedData;
		}
		curl_close($curl);
        return $data;
    }

    public static function store($route, $data_string){
        $username = 'user';
		$password = 'user';
		$credentials = base64_encode("$username:$password");
		$headers = [];
		$headers[] = "Authorization: Basic {$credentials}";
		$headers[] = 'Content-Type: application/json';
		$headers[] = 'Cache-Control: no-cache';
		$headers[] = 'content-length: '.strlen($data_string);
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL,"127.0.0.2:8001/$route");
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
		$response = curl_exec($curl);
		if($e = curl_error($curl)) {
			echo $e;
		}
		curl_close($curl);
    }
    public static function edit($route, $id){
		$username = 'user';
		$password = 'user';
		$credentials = base64_encode("$username:$password");
		$headers = [];
		$headers[] = "Authorization: Basic {$credentials}";
		$headers[] = 'Content-Type: application/x-www-form-urlencoded';
		$headers[] = 'Cache-Control: no-cache';
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL,"127.0.0.2:8001/$route/$id");
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($curl);
		if($e = curl_error($curl)) {
			echo $e;
		} else {
			$decodedData = json_decode($response, true);
			$data = $decodedData;
		}
		curl_close($curl);
        return $data;
    }
    public static function update($route, $id, $data_string){
		$username = 'user';
		$password = 'user';
		$credentials = base64_encode("$username:$password");
		$headers = [];
		$headers[] = "Authorization: Basic {$credentials}";
		$headers[] = 'Content-Type: application/json';
		$headers[] = 'Cache-Control: no-cache';
		$headers[] = 'content-length: '.strlen($data_string);
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL,"127.0.0.2:8001/$route/$id");
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
		$response = curl_exec($curl);
		if($e = curl_error($curl)) {
			echo $e;
		}
		curl_close($curl);
    }
    public static function destroy($route, $id){
		$username = 'user';
		$password = 'user';
		$credentials = base64_encode("$username:$password");
		$headers = [];
		$headers[] = "Authorization: Basic {$credentials}";
		$headers[] = 'Content-Type: application/json';
		$headers[] = 'Cache-Control: no-cache';
		$headers[] = 'content-length: ';
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL,"127.0.0.2:8001/$route/$id");
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'DELETE');
		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($curl);
		if($e = curl_error($curl)) {
			echo $e;
		}
		curl_close($curl);
    }
    public static function terbaru($route){
		$username = 'user';
		$password = 'user';
		$credentials = base64_encode("$username:$password");
		$headers = [];
		$headers[] = "Authorization: Basic {$credentials}";
		$headers[] = 'Content-Type: application/x-www-form-urlencoded';
		$headers[] = 'Cache-Control: no-cache';
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL,"127.0.0.2:8001/$route-terbaru");
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($curl);
		if($e = curl_error($curl)) {
			echo $e;
		} else {
			$decodedData = json_decode($response, true) ;
			$data = $decodedData;
		}
		curl_close($curl);
        return $data;
    }    
    public static function daycount($route){
		$username = 'user';
		$password = 'user';
		$credentials = base64_encode("$username:$password");
		$headers = [];
		$headers[] = "Authorization: Basic {$credentials}";
		$headers[] = 'Content-Type: application/x-www-form-urlencoded';
		$headers[] = 'Cache-Control: no-cache';
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL,"127.0.0.2:8001/$route-daycount");
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($curl);
		if($e = curl_error($curl)) {
			echo $e;
		} else {
			$decodedData = json_decode($response, true) ;
			$data = $decodedData;
		}
		curl_close($curl);
        return $data;
    }    
}
