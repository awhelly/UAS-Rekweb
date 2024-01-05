<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
      $kategori = Kategori::all();
      return response()->json($kategori);
    }
    public function create(Request $request)
    {
      $data = $request->all();
      $kategori = Kategori::create($data);
      return response()->json($kategori);
    }
    public function detail($id)
    {
      $kategori = Kategori::find($id);
      return response()->json($kategori);
    }
    public function update(Request $request, $id)
    {
      $kategori = Kategori::whereId($id)->update([
        'kode' => $request->input('kode'),
        'nama' => $request->input('nama'),
        'deskripsi' => $request->input('deskripsi'),
        'status' => $request->input('status'),
      ]);
  
      if ($kategori) {
        return response()->json([
          'success' => true,
          'message' => 'Data berhasil diupdate',
          'data' => $kategori
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
      $kategori = Kategori::whereId($id)->first();
      $kategori->delete();
  
      if ($kategori) {
        return response()->json([
          'success' => true,
          'message' => 'Data berhasil dihapus'
        ], 200);
      }
    }
    public function getKategori()
    {
      $kategori = Kategori::where('status','Publish')->get();
      return response()->json($kategori);
    }
  }