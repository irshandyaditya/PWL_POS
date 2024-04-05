<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use App\Models\StokModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class StokController extends Controller
{
    public function index(Request $request)
    {
        $breadcrumb = (object) [
            'title' => 'Daftar stok',
            'list' => ['Home', 'stok']
        ];

        $page = (object) [
            'title' => 'Daftar stok yang terdaftar dalam sistem',
        ];

        $barang = BarangModel::all();
        $user = UserModel::all();

        $activeMenu = 'stok'; // set menu aktif

        return view('stok.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'user' => $user,  'barang' => $barang, 'activeMenu' => $activeMenu]);
    
    }

    public function list(Request $request)
    {
        $stoks = StokModel::select('stok_id', 'barang_id', 'user_id', 'stok_tanggal','stok_jumlah')->with('user')->with('barang');

        //filter data
        if($request->barang_id) {
            $stoks->where('barang_id', $request->barang_id);
        }

        return DataTables::of($stoks)
            ->addIndexColumn() // menambahkan kolom index / no urut (default stok_namakolom: DT_RowIndex)
            ->addColumn('aksi', function ($stok) { // menambahkan kolom aksi
                $btn = '<a href="'.url('/stok/' . $stok->stok_id).'" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="'.url('/stok/' . $stok->stok_id . '/edit').'"class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="'. url('/stok/'.$stok->stok_id).'">' . csrf_field() . method_field('DELETE') . '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                return $btn;
            })
        ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
        ->make(true);
    }

    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah stok',
            'list' => ['Home', 'stok', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah stok baru',
        ];

        $user = UserModel::all();
        $barang = BarangModel::all();
        $activeMenu = 'stok'; // set menu aktif

        return view('stok.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'barang' => $barang,'user' => $user, 'activeMenu' => $activeMenu]);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|integer',
            'user_id' => 'required|integer',
            'stok_tanggal' => 'required|string|max:100',
            'stok_jumlah' => 'required|integer'
        ]);
        // dd($request->user_id);
        StokModel::create([
            'barang_id' => $request->barang_id, 
            'user_id' => $request->user_id, 
            'stok_tanggal' => $request->stok_tanggal, 
            'stok_jumlah' => $request->stok_jumlah
        ]);

        return redirect('/stok')->with('success', 'Data stok berhasil disimpan');
    }

    public function show($id)
    {
        $stok = StokModel::with('user')->with('barang')->find($id);

        $breadcrumb = (object) [
            'title' => 'Detail stok',
            'list' => ['Home', 'stok', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail stok',
        ];

        $activeMenu = 'stok'; // set menu aktif

        return view('stok.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'stok' => $stok, 'activeMenu' => $activeMenu]);
    
    }
    public function edit($id)
    {
        $stok = StokModel::find($id);
        $user = UserModel::all();
        $barang = BarangModel::all();

        $breadcrumb = (object) [
            'title' => 'Edit stok',
            'list' => ['Home', 'stok', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit stok',
        ];

        $activeMenu = 'stok'; // set menu aktif

        return view('stok.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'stok' => $stok, 'user' => $user, 'barang' => $barang, 'activeMenu' => $activeMenu]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'barang_id' => 'required|integer',
            'user_id' => 'required|integer',
            'stok_tanggal' => 'required|string|max:100',
            'stok_jumlah' => 'required|integer'
        ]);

        StokModel::find($id)->update([
            'barang_id' => $request->barang_id, 
            'user_id' => $request->user_id, 
            'stok_tanggal' => $request->stok_tanggal, 
            'stok_jumlah' => $request->stok_jumlah
        ]);

        return redirect('/stok')->with('success', 'Data stok berhasil diubah');
    }
    
    public function destroy($id)
    {
        $check = StokModel::find($id);
        if(!$check){
            return redirect('/stok')->with('error', 'Data stok tidak ditemukan');
        }

        try{
            StokModel::destroy($id);

            return redirect('/stok')->with('success', 'Data stok berhasil dihapus');
        }catch(\Illuminate\Database\QueryException $e){
            // jika error redirect kembali ke halaman dengan membawa pesan error
            return redirect('/stok')->with('error', 'Data stok gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}
