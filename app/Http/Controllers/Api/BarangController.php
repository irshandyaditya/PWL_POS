<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BarangModel;

class BarangController extends Controller
{
    public function index(){
        return BarangModel::all();
    }

    public function store(Request $request){
        // $validated = $request->validate([
        //     'barang_kode' => 'bail|required|string|unique:m_barang,barang_kode',
        //     'barang_nama' => 'required|string|max:100',
        //     'kategori_id' => 'required|integer',
        //     'harga_beli' => 'required|integer',
        //     'harga_jual' => 'required|integer',
        //     'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        // ]);
        // $barang = BarangModel::create(
        //     [
        //     'barang_kode' => $request->barang_kode,
        //     'barang_nama' => $request->barang_nama,
        //     'kategori_id' => $request->kategori_id,
        //     'harga_beli' => $request->harga_beli,
        //     'harga_jual' => $request->harga_jual,
        //     'image' => $request->image->hashName(),
        //     ]
        // );
        // return response()->json($barang, 201);
        $barang = BarangModel::create($request->all());
        return response()->json($barang, 201);
    }

    public function show(BarangModel $barang){
        return $barang;
    }

    public function update(Request $request, BarangModel $barang){
        $barang->update($request->all());
        return $barang;
    }

    public function destroy(BarangModel $barang){
        $barang->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data Terhapus',
        ]);
    }
}