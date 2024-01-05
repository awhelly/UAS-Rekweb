<?php
namespace App\Http\Controllers;
use App\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
class CartController extends Controller
{
	public function index () 
	{
		$datacart = Helper::terbaru('cart');
		$dataKategori = Helper::index('kategori');
		$dataProduk = Helper::index('produk');
		return view('cart.index', ["dataProduk" => $dataProduk, "dataKategori" => $dataKategori, "datacart" => $datacart]);
	}
	public function create(){
		return view('cart.create',[

		]);
	}
	public function store(Request $request){
		$this->validate($request,[
			'pembeli' => 'required',
		]);
		$tanggal = new Carbon(now());
		$daycount = sprintf('%03d', Helper::daycount('cart')+1);
		$thn = substr($tanggal->year,2);
		$bln = sprintf('%02d', $tanggal->month);
		$tgl = sprintf('%02d', $tanggal->day);

		$inv = 'INV#'.$thn.$bln.$tgl.$daycount;
		$postData = array(
			"pembeli" =>$request->input('pembeli'),
			"no_invoice" =>$inv,
			"status_cart" => 'open',
			"status_pembayaran" => 'Belum Bayar',
		);

		$data_string = json_encode($postData);
		Helper::store('cart', $data_string);
		$dataKategori = Helper::index('kategori');
		$dataProduk = Helper::index('produk');
		return redirect()->to('/cart')->with(["dataProduk" => $dataProduk, "dataKategori" => $dataKategori]);
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
			'nama' => 'required',
			'harga' => 'required',
			'deskripsi' => 'required',
		]);

		$postData = array(
			"nama_buku" =>$request->input('nama'),
			"harga" =>$request->input('harga'),
			"deskripsi" =>$request->input('deskripsi'),
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
