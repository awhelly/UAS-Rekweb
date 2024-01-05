<?php
namespace App\Http\Controllers;
use App\Helper;
use Illuminate\Http\Request;
class KategoriController extends Controller
{
	public function index () 
	{
		$data = Helper::index('kategori');
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
		Helper::store('kategori', $data_string);
		return redirect()->to('/kategori');
	}

	public function edit($id){
		$data = Helper::edit('kategori', $id);
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
		Helper::update('kategori',$id,$data_string);
		return redirect()->to('/kategori')->with('success','Data berhasil diupdate');
	}
	public function destroy($id){
		Helper::destroy('kategori',$id);
		return redirect()->to('/kategori')->with('success','Data berhasil dihapus');
	}

}