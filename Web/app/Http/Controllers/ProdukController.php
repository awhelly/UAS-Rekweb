<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
class ProdukController extends Controller
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
		curl_setopt($curl, CURLOPT_URL,"127.0.0.2:8001/produk");
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
		return view('produk.index', ["data" => $data]);
	}
	public function create(){
		$username = 'user';
		$password = 'user';
		$credentials = base64_encode("$username:$password");
		
		$headers = [];
		$headers[] = "Authorization: Basic {$credentials}";
		$headers[] = 'Content-Type: application/x-www-form-urlencoded';
		$headers[] = 'Cache-Control: no-cache';
		
		// Initializing curl
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL,"127.0.0.2:8001/getkategori");
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		
		// Executing curl
		$response = curl_exec($curl);
		
		// Checking if any error occurs during request or not
		if($e = curl_error($curl)) {
			echo $e;
		} else {
			$decodedData = json_decode($response, true) ;
			$data = $decodedData;
		}
		
		// Closing curl
		curl_close($curl);
		return view('produk.create', ["data" => $data]);
	}
	public function store(Request $request){
		$this->validate($request,[
			'kategori_id' => 'required',
			'kode' => 'required',
			'nama' => 'required',
			'deskripsi' => 'required',
			'qty' => 'required',
			'satuan' => 'required',
			'harga' => 'required',
			'status' => 'required',
		]);

		$postData = array(
			"kategori_id" =>$request->input('kategori_id'),
			"kode" =>$request->input('kode'),
			"nama" =>$request->input('nama'),
			"deskripsi" =>$request->input('deskripsi'),
			"qty" =>$request->input('qty'),
			"satuan" =>$request->input('satuan'),
			"harga" =>$request->input('harga'),
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
		curl_setopt($curl, CURLOPT_URL,"127.0.0.2:8001/produk");
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
		return redirect()->to('/produk');
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
		curl_setopt($curl, CURLOPT_URL,"127.0.0.2:8001/produk/$id");
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

		
		$username = 'user';
		$password = 'user';
		$credentials = base64_encode("$username:$password");
		
		$headers = [];
		$headers[] = "Authorization: Basic {$credentials}";
		$headers[] = 'Content-Type: application/x-www-form-urlencoded';
		$headers[] = 'Cache-Control: no-cache';
		
		// Initializing curl
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL,"127.0.0.2:8001/getkategori");
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		
		// Executing curl
		$responseKategori = curl_exec($curl);
		
		// Checking if any error occurs during request or not
		if($e = curl_error($curl)) {
			echo $e;
		} else {
			$decodedDataKategori = json_decode($responseKategori, true) ;
			$datakategori = $decodedDataKategori;
		}
		
		// Closing curl
		curl_close($curl);
		return view('produk.edit', ['data'=>$data, 'datakategori'=>$datakategori]);
	}
	
	public function update(Request $request, $id){
		$this->validate($request,[
			'kategori_id' => 'required',
			'kode' => 'required',
			'nama' => 'required',
			'deskripsi' => 'required',
			'qty' => 'required',
			'satuan' => 'required',
			'harga' => 'required',
			'status' => 'required',
		]);

		$postData = array(
			"kategori_id" =>$request->input('kategori_id'),
			"kode" =>$request->input('kode'),
			"nama" =>$request->input('nama'),
			"deskripsi" =>$request->input('deskripsi'),
			"qty" =>$request->input('qty'),
			"satuan" =>$request->input('satuan'),
			"harga" =>$request->input('harga'),
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
		curl_setopt($curl, CURLOPT_URL,"127.0.0.2:8001/produk/$id");
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
		return redirect()->to('/produk')->with('success','Data berhasil diupdate');
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
		curl_setopt($curl, CURLOPT_URL,"127.0.0.2:8001/produk/$id");
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
		return redirect()->to('/produk')->with('success','Data berhasil dihapus');
	}
}
