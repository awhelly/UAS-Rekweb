<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
class KategoriController extends Controller
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
		curl_setopt($curl, CURLOPT_URL,"127.0.0.2:8001/kategori");
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
		return view('kategori.index', ["data" => $data]);
	}
	public function create(){
		return view('kategori.create',[

		]);
	}
	public function store(Request $request){
		$this->validate($request,[
			'nama' => 'required',
			'kode' => 'required',
			'deskripsi' => 'required',
		]);

		$postData = array(
			"nama" =>$request->input('nama'),
			"kode" =>$request->input('kode'),
			"deskripsi" =>$request->input('deskripsi'),
			"status" => 'Publish',
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
		curl_setopt($curl, CURLOPT_URL,"127.0.0.2:8001/kategori");
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
		return redirect()->to('/kategori');
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
		curl_setopt($curl, CURLOPT_URL,"127.0.0.2:8001/kategori/$id");
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
		return view('kategori.edit', ['data'=>$data]);
	}
	
	public function update(Request $request, $id){
		$this->validate($request,[
			'nama' => 'required',
			'kode' => 'required',
			'deskripsi' => 'required',
		]);

		$postData = array(
			"nama" =>$request->input('nama'),
			"kode" =>$request->input('kode'),
			"deskripsi" =>$request->input('deskripsi'),
			"status" =>$request->input('status'),
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
		curl_setopt($curl, CURLOPT_URL,"127.0.0.2:8001/kategori/$id");
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
		return redirect()->to('/kategori')->with('success','Data berhasil diupdate');
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
		curl_setopt($curl, CURLOPT_URL,"127.0.0.2:8001/kategori/$id");
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
		return redirect()->to('/kategori')->with('success','Data berhasil dihapus');
	}
}
