<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
class CartController extends Controller
{
	public function index () 
	{
		// return view('Dashboard.index', [
		// ]);
		
		$username = 'user';
		$password = 'user';
		$credentials = base64_encode("$username:$password");
		
		$headers = [];
		$headers[] = "Authorization: Basic {$credentials}";
		$headers[] = 'Content-Type: application/x-www-form-urlencoded';
		$headers[] = 'Cache-Control: no-cache';
		
		// Initializing curl
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL,"127.0.0.2:8001/cart");
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		
		// Executing curl
		$response = curl_exec($curl);
		
		// Checking if any error occurs during request or not
		if($e = curl_error($curl)) {
			echo $e;
		} else {
			
			// Dceoding JSON data
			$decodedData =
			json_decode($response, true) ;
			
			// Outputting JSON data in 
			// Decodec form
			$data = $decodedData;
		}
		
		// Closing curl
		curl_close($curl);
		return view('cart.index', ["data" => $data]);
	}
	public function create(){
		return view('cart.create',[

		]);
	}
	public function store(Request $request){
		$this->validate($request,[
			'nama-buku' => 'required',
			'harga-buku' => 'required',
			'deskripsi-buku' => 'required',
		]);

		$postData = array(
			"nama_buku" =>$request->input('nama-buku'),
			"harga" =>$request->input('harga-buku'),
			"deskripsi" =>$request->input('deskripsi-buku'),
		);

		$data_string = json_encode($postData);
		
		$username = 'user';
		$password = 'user';
		$credentials = base64_encode("$username:$password");
		
		$headers = [];
		$headers[] = "Authorization: Basic {$credentials}";
		$headers[] = 'Content-Type: application/json';
		$headers[] = 'Cache-Control: no-cache';
		$headers[] = 'content-length: '.strlen($data_string);
		
		// Initializing curl
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL,"127.0.0.2:8001/buku");
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
		
		// Executing curl
		$response = curl_exec($curl);
		
		// Checking if any error occurs during request or not
		if($e = curl_error($curl)) {
			echo $e;
		}
		
		// Closing curl
		curl_close($curl);
		return redirect()->to('/');
	}

	public function edit($id){
		$username = 'user';
		$password = 'user';
		$credentials = base64_encode("$username:$password");
		
		$headers = [];
		$headers[] = "Authorization: Basic {$credentials}";
		$headers[] = 'Content-Type: application/x-www-form-urlencoded';
		$headers[] = 'Cache-Control: no-cache';
		
		// Initializing curl
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL,"127.0.0.2:8001/detail/$id");
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		
		// Executing curl
		$response = curl_exec($curl);
		
		// Checking if any error occurs during request or not
		if($e = curl_error($curl)) {
			echo $e;
		} else {
			$decodedData = json_decode($response, true);
			$data = $decodedData;
		}
		
		// Closing curl
		curl_close($curl);
		return view('cart.edit', ['data'=>$data]);
	}
	
	public function update(Request $request, $id){
		$this->validate($request,[
			'nama-buku' => 'required',
			'harga-buku' => 'required',
			'deskripsi-buku' => 'required',
		]);

		$postData = array(
			"nama_buku" =>$request->input('nama-buku'),
			"harga" =>$request->input('harga-buku'),
			"deskripsi" =>$request->input('deskripsi-buku'),
		);

		$data_string = json_encode($postData);
		
		$username = 'user';
		$password = 'user';
		$credentials = base64_encode("$username:$password");
		
		$headers = [];
		$headers[] = "Authorization: Basic {$credentials}";
		$headers[] = 'Content-Type: application/json';
		$headers[] = 'Cache-Control: no-cache';
		$headers[] = 'content-length: '.strlen($data_string);
		
		// Initializing curl
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL,"127.0.0.2:8001/update/$id");
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
		
		// Executing curl
		$response = curl_exec($curl);
		
		// Checking if any error occurs during request or not
		if($e = curl_error($curl)) {
			echo $e;
		}
		
		// Closing curl
		curl_close($curl);
		return redirect()->to('/')->with('success','Data berhasil diupdate');
	}
	public function destroy($id){
		$username = 'user';
		$password = 'user';
		$credentials = base64_encode("$username:$password");
		
		$headers = [];
		$headers[] = "Authorization: Basic {$credentials}";
		$headers[] = 'Content-Type: application/json';
		$headers[] = 'Cache-Control: no-cache';
		$headers[] = 'content-length: ';
		
		// Initializing curl
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL,"127.0.0.2:8001/delete/$id");
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'DELETE');
		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		
		// Executing curl
		$response = curl_exec($curl);
		
		// Checking if any error occurs during request or not
		if($e = curl_error($curl)) {
			echo $e;
		}
		
		// Closing curl
		curl_close($curl);
		return redirect()->to('/')->with('success','Data berhasil dihapus');
	}
}
