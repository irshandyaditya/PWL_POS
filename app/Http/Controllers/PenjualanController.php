<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use App\Models\PenjualanDetailModel;
use App\Models\PenjualanModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PenjualanController extends Controller
{
    public function index(Request $request)
    {
        $breadcrumb = (object) [
            'title' => 'Daftar penjualan',
            'list' => ['Home', 'penjualan']
        ];

        $page = (object) [
            'title' => 'Daftar penjualan yang terdaftar dalam sistem',
        ];

        $user = UserModel::all();

        $activeMenu = 'penjualan'; // set menu aktif

        return view('penjualan.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'user' => $user, 'activeMenu' => $activeMenu]);
    
    }

    public function list(Request $request)
    {
        $penjualans = PenjualanModel::select('penjualan_id', 'user_id', 'pembeli', 'penjualan_kode','penjualan_tanggal')->with('user');

        //filter data
        if($request->user_id) {
            $penjualans->where('user_id', $request->barang_id);
        }

        return DataTables::of($penjualans)
            ->addIndexColumn() // menambahkan kolom index / no urut (default penjualan_namakolom: DT_RowIndex)
            ->addColumn('aksi', function ($penjualan) { // menambahkan kolom aksi
                $btn = '<a href="'.url('/penjualan/' . $penjualan->penjualan_id).'" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="'.url('/penjualan/' . $penjualan->penjualan_id . '/edit').'"class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="'. url('/penjualan/'.$penjualan->penjualan_id).'">' . csrf_field() . method_field('DELETE') . '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                return $btn;
            })
        ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
        ->make(true);
    }

    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah penjualan',
            'list' => ['Home', 'penjualan', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah penjualan baru',
        ];

        $user = UserModel::all();
        $barang = BarangModel::all();
        $activeMenu = 'penjualan'; // set menu aktif

        return view('penjualan.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'barang' => $barang,'user' => $user, 'activeMenu' => $activeMenu]);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|integer',
            'user_id' => 'required|integer',
            'pembeli' => 'required|min:3',
            'harga' => 'required',
            'jumlah' => 'required',
            'penjualan_tanggal' => 'required|string|max:100',
            'penjualan_kode' => 'required'
        ]);
        
        $penjualan = PenjualanModel::create([
            'user_id' => $request->user_id, 
            'pembeli' => $request->pembeli, 
            'penjualan_kode' => $request->penjualan_kode,
            'penjualan_tanggal' => $request->penjualan_tanggal 
        ]);

        // dd($penjualan->penjualan_id);

        PenjualanDetailModel::create([
            'penjualan_id' => $penjualan->penjualan_id,
            'barang_id' => $request->barang_id,
            'harga' => $request->harga, 
            'jumlah' => $request->jumlah
        ]);

        return redirect('/penjualan')->with('success', 'Data penjualan berhasil disimpan');
    }

    public function show($id)
    {
        $penjualan = PenjualanDetailModel::with('penjualan')->with('barang')->find($id);

        $breadcrumb = (object) [
            'title' => 'Detail penjualan',
            'list' => ['Home', 'penjualan', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail penjualan',
        ];

        $activeMenu = 'penjualan'; // set menu aktif

        return view('penjualan.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'penjualan' => $penjualan, 'activeMenu' => $activeMenu]);
    
    }
    public function edit($id)
    {
        $penjualan = PenjualanModel::find($id);
        $penjualanD = PenjualanDetailModel::find($id);
        $user = UserModel::all();
        $barang = BarangModel::all();

        $breadcrumb = (object) [
            'title' => 'Edit penjualan',
            'list' => ['Home', 'penjualan', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit penjualan',
        ];

        $activeMenu = 'penjualan'; // set menu aktif

        return view('penjualan.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'penjualanDetail'  => $penjualanD,'penjualan' => $penjualan, 'user' => $user, 'barang' => $barang, 'activeMenu' => $activeMenu]);
    }

    public function update(Request $request, $id, $idDetail)
    {
        $request->validate([
            'barang_id' => 'required|integer',
            'user_id' => 'required|integer',
            'pembeli' => 'required|min:3',
            'harga' => 'required',
            'jumlah' => 'required',
            'penjualan_tanggal' => 'required|string|max:100',
            'penjualan_kode' => 'required|integer'
        ]);

        $penjualan = PenjualanModel::find($id)->update([   
            'user_id' => $request->user_id, 
            'pembeli' => $request->pembeli, 
            
            'penjualan_tanggal' => $request->penjualan_tanggal, 
            'penjualan_kode' => $request->penjualan_kode
        ]);

        PenjualanDetailModel::find($idDetail)->update([
            'barang_id' => $request->barang_id, 
            'harga' => $request->harga, 
            'jumlah' => $request->jumlah, 
        ]);

        return redirect('/penjualan')->with('success', 'Data penjualan berhasil diubah');
    }
    
    public function destroy($id)
    {
        $check = PenjualanModel::find($id);
        if(!$check){
            return redirect('/penjualan')->with('error', 'Data penjualan tidak ditemukan');
        }

        try{
            PenjualanModel::destroy($id);

            return redirect('/penjualan')->with('success', 'Data penjualan berhasil dihapus');
        }catch(\Illuminate\Database\QueryException $e){
            // jika error redirect kembali ke halaman dengan membawa pesan error
            return redirect('/penjualan')->with('error', 'Data penjualan gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }

    public function getHarga($id)
    {
        $barang = BarangModel::findOrFail($id); // Cari barang berdasarkan ID

        return response()->json([
            'harga' => $barang->harga, // Kembalikan harga jual barang dalam respons JSON
        ]);
    }
}
