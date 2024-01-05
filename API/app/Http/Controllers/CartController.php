<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CartController extends Controller
{
    public function index()
    {
      $cart = Cart::all();
      return response()->json($cart);
    }
    public function create(Request $request)
    {
      $data = $request->all();
      $cart = Cart::create($data);
      return response()->json($cart);
    }
    public function detail($id)
    {
      $cart = Cart::find($id);
      return response()->json($cart);
    }
    public function update($id)
    {
        $getsubtotal = CartDetail::where('cart_id',$id)->sum('subtotal');
        $getdiskon = CartDetail::where('cart_id',$id)->sum('diskon');
        $updatecart = Cart::whereId($id)->update([
            'subtotal' => $getsubtotal,
            'diskon' => $getdiskon,
            'total' => $getsubtotal - $getdiskon,
        ]);

      if ($updatecart) {
        return response()->json([
          'success' => true,
          'message' => 'Data berhasil diupdate',
          'data' => $updatecart
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
      $cart = Cart::whereId($id)->first();

      if($cart->status_pembayaran != 'Dibayar') {
          $cart->delete();
          
          return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus'
          ], 200);
        } else {
          return response()->json([
            'success' => false,
            'message' => 'Data gagal dihapus'
          ], 400);
        }
      }
    

    public function bayar(Request $request, $id)
    {
        // $data = $request->all();
        $itemcart = Cart::whereId($id)->first();
        // $itemcart->update($data);

        $bayar = $request->input('bayar');

      $cart = Cart::whereId($id)->update([
        'status_pembayaran' => 'Dibayar',
        'bayar' => $bayar,
        'kembali' => $bayar - $itemcart->total,
      ]);
  
      if ($cart) {
        return response()->json([
          'success' => true,
          'message' => 'Data berhasil diupdate',
          'data' => $cart
        ], 201);
      } else {
        return response()->json([
          'success' => false,
          'message' => 'Data gagal diupdate'
        ], 400);
      }
    }
    public function daycount()
    {
      $jumlah = Cart::whereDate('created_at', '>=', Carbon::today())->count();
      return $jumlah;
    }
    public function terbaru()
    {
      $data = Cart::where('status_cart', 'open')->orderBy('created_at','desc')->first();
      if($data){
        $data = $data;
      } else {
        $data['id'] = 0;
      }
      return $data;
    }
  }