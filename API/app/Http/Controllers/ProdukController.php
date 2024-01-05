<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
      $produk = Produk::all();
      return response()->json($produk);
    }
    public function create(Request $request)
    {
      $data = $request->all();
      $produk = Produk::create($data);
      return response()->json($produk);
    }
    public function detail($id)
    {
      $produk = Produk::find($id);
      return response()->json($produk);
    }
    public function update(Request $request, $id)
    {
      $produk = Produk::whereId($id)->update([
        "kategori_id" =>$request->input('kategori_id'),
        "kode" =>$request->input('kode'),
        "nama" =>$request->input('nama'),
        "deskripsi" =>$request->input('deskripsi'),
        "qty" =>$request->input('qty'),
        "satuan" =>$request->input('satuan'),
        "harga" =>$request->input('harga'),
        "status" =>$request->input('status'),
      ]);
  
      if ($produk) {
        return response()->json([
          'success' => true,
          'message' => 'Data berhasil diupdate',
          'data' => $produk
        ], 201);
      } else {
        return response()->json([
          'success' => false,
          'message' => 'Data gagal diupdate'
        ], 400);
      }
    }
    public function delete($id)
    {
      $produk = Produk::whereId($id)->first();
      $produk->delete();
  
      if ($produk) {
        return response()->json([
          'success' => true,
          'message' => 'Data berhasil dihapus'
        ], 200);
      }
    }
    public function count()
    {
      $jumlah = Produk::where('status','Publish')->count();
      return $jumlah;
    }
  }