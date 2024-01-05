<?php
namespace App\Http\Controllers;
use App\Helper;
use Illuminate\Http\Request;
class ProdukController extends Controller
{
	public function index () 
	{
		$data = Helper::index('produk');
		return view('produk.index', ["data" => $data]);
	}
	public function create(){
		$data = Helper::index('kategori');
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
		Helper::store('produk', $data_string);
		return redirect()->to('/produk');
	}

	public function edit($id){
		$data = Helper::edit('produk', $id);
		$datakategori = Helper::index('kategori');
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
		Helper::update('produk',$id,$data_string);
		return redirect()->to('/produk')->with('success','Data berhasil diupdate');
	}
	public function destroy($id){
		Helper::destroy('produk',$id);
		return redirect()->to('/produk')->with('success','Data berhasil dihapus');
	}
}
