<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use App\Models\KategoriModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BarangController extends Controller
{
    public function index(Request $request)
    {
        $breadcrumb = (object) [
            'title' => 'Daftar barang',
            'list' => ['Home', 'barang']
        ];

        $page = (object) [
            'title' => 'Daftar barang yang terdaftar dalam sistem',
        ];

        $kategori = KategoriModel::all();

        $activeMenu = 'barang'; // set menu aktif

        return view('barang.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'kategori' => $kategori, 'activeMenu' => $activeMenu]);
    
    }

    public function list(Request $request)
    {
        $barangs = BarangModel::select('barang_id', 'kategori_id', 'barang_kode','barang_nama', 'harga_beli', 'harga_jual')->with('kategori');

        //filter data
        if($request->kategori_id) {
            $barangs->where('kategori_id', $request->kategori_id);
        }

        return DataTables::of($barangs)
            ->addIndexColumn() // menambahkan kolom index / no urut (default barang_namakolom: DT_RowIndex)
            ->addColumn('aksi', function ($barang) { // menambahkan kolom aksi
                $btn = '<a href="'.url('/barang/' . $barang->barang_id).'" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="'.url('/barang/' . $barang->barang_id . '/edit').'"class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="'. url('/barang/'.$barang->barang_id).'">' . csrf_field() . method_field('DELETE') . '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                return $btn;
            })
        ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
        ->make(true);
    }

    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah barang barang',
            'list' => ['Home', 'barang', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah barang baru',
        ];

        $kategori = KategoriModel::all();
        $activeMenu = 'barang'; // set menu aktif

        return view('barang.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'kategori' => $kategori, 'activeMenu' => $activeMenu]);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required|integer',
            'barang_kode' => 'required|string|min:3|unique:m_barang,barang_kode',
            'barang_nama' => 'required|string|max:100',
            'harga_beli' => 'required',
            'harga_jual' => 'required',
            'image' => 'required|file|image|max:500'
        ]);
        // dd($request->kategori_id);

        $hashedFoto =$request->image->store('public/barang');
        $path = str_replace('public', 'storage', $hashedFoto);

        BarangModel::create([
            'kategori_id' => $request->kategori_id, 
            'barang_kode' => $request->barang_kode, 
            'barang_nama' => $request->barang_nama, 
            'harga_beli' => $request->harga_beli,  
            'harga_jual' => $request->harga_jual,
            'image' => isset($hashedFoto) ? $path : null 
        ]);

        return redirect('/barang')->with('success', 'Data barang berhasil disimpan');
    }

    public function show($id)
    {
        $barang = BarangModel::with('kategori')->find($id);

        $breadcrumb = (object) [
            'title' => 'Detail barang',
            'list' => ['Home', 'barang', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail barang',
        ];

        $activeMenu = 'barang'; // set menu aktif

        return view('barang.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'barang' => $barang, 'activeMenu' => $activeMenu]);
    
    }
    public function edit($id)
    {
        $barang = BarangModel::find($id);
        $kategori = KategoriModel::all();

        $breadcrumb = (object) [
            'title' => 'Edit barang',
            'list' => ['Home', 'barang', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit barang',
        ];

        $activeMenu = 'barang'; // set menu aktif

        return view('barang.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'barang' => $barang, 'kategori' => $kategori, 'activeMenu' => $activeMenu]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kategori_id' => 'required|integer',
            'barang_kode' => 'required|string|min:3|unique:m_barang,barang_kode,'.$id.',barang_id',
            'barang_nama' => 'required|string|max:100',
            'harga_beli' => 'required',
            'harga_jual' => 'required',
            'image' => 'required|file|image|max:500'
        ]);

        $hashedFoto =$request->image->store('public/barang');
        $path = str_replace('public', 'storage', $hashedFoto);

        BarangModel::find($id)->update([
            'kategori_id' => $request->kategori_id,
            'barang_kode' => $request->barang_kode, 
            'barang_nama' => $request->barang_nama, 
            'harga_beli' => $request->harga_beli,  
            'harga_jual' => $request->harga_jual,
            'image' => isset($hashedFoto) ? $path : null
        ]);

        return redirect('/barang')->with('success', 'Data barang berhasil diubah');
    }
    
    public function destroy($id)
    {
        $check = BarangModel::find($id);
        if(!$check){
            return redirect('/barang')->with('error', 'Data barang tidak ditemukan');
        }

        try{
            BarangModel::destroy($id);

            return redirect('/barang')->with('success', 'Data barang berhasil dihapus');
        }catch(\Illuminate\Database\QueryException $e){
            // jika error redirect kembali ke halaman dengan membawa pesan error
            return redirect('/barang')->with('error', 'Data barang gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}
