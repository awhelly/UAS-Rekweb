<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartDetail;
use Illuminate\Http\Request;

class CartDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $cartdetail = CartDetail::all();
        return response()->json($cartdetail);
    }
    public function create(Request $request)
    {
        $data = $request->all();
        $cartdetail = CartDetail::create($data);
        $getsubtotal = CartDetail::where('cart_id',$request->cart_id)->sum('subtotal');
        $getdiskon = CartDetail::where('cart_id',$request->cart_id)->sum('diskon');
        $updatecart = Cart::whereId($request->cart_id)->update([
            'subtotal' => $getsubtotal,
            'diskon' => $getdiskon,
            'total' => $getsubtotal - $getdiskon,
        ]);
        return response()->json($cartdetail);
    }
    public function detail($id)
    {
        $cartdetail = CartDetail::find($id);
        return response()->json($cartdetail);
    }
    public function update(Request $request, $id)
    {
        $cartdetail = CartDetail::whereId($id)->update([
        'cart_id' => $request->input('cart_id'),
        'produk_id' => $request->input('produk_id'),
        'qty' => $request->input('qty'),
        'harga' => $request->input('harga'),
        'diskon' => $request->input('diskon'),
        'subtotal' => $request->input('qty') * $request->input('harga'),
        ]);

        if ($cartdetail) {
            $getsubtotal = CartDetail::where('cart_id',$request->input('cart_id'))->sum('subtotal');
            $getdiskon = CartDetail::where('cart_id',$request->input('cart_id'))->sum('diskon');
            $updatecart = Cart::whereId($request->cart_id)->update([
                'subtotal' => $getsubtotal,
                'diskon' => $getdiskon,
                'total' => $getsubtotal - $getdiskon,
            ]);
            
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil diupdate',
            'data' => $cartdetail
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
        $cartdetail = CartDetail::whereId($id)->first();
        $idcart = $cartdetail->cart_id;
        $cartdetail->delete();

        if ($cartdetail) {
            $getsubtotal = CartDetail::where('cart_id',$idcart)->sum('subtotal');
            $getdiskon = CartDetail::where('cart_id',$idcart)->sum('diskon');
            $updatecart = Cart::whereId($idcart)->update([
                'subtotal' => $getsubtotal,
                'diskon' => $getdiskon,
                'total' => $getsubtotal - $getdiskon,
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil dihapus'
            ], 200);
        }
    }
}