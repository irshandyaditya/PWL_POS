<?php

namespace App\Http\Controllers;

use App\DataTables\KategoriDataTable;
use App\Http\Requests\StorePostRequest;
use App\Models\KategoriModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    public function index(KategoriDataTable $dataTable)
    {
        // $data = [
        //     'kategori_kode' => 'SNK',
        //     'kategori_nama' => 'Snack/Makanan Ringan',
        //     'created_at' => now()
        // ];
        // DB::table('m_kategori')->insert($data);
        // return 'Insert data baru berhasil';

        // $row = DB::table('m_kategori')->where('kategori_kode', 'SNK')->update(['kategori_nama' => 'Camilan']);
        // return 'Update data berhasil. Jumlah data yang diupdate: ' . $row . ' baris';

        // $row = DB::table('m_kategori')->where('kategori_kode', 'SNK')->delete();
        // return 'Delete data berhasil. Jumlah data yang dihapus: ' . $row . ' baris';

        // $data = DB::table('m_kategori')->get();

        return $dataTable->render('kategori.index');
    }

    public function create()
    {
        return view('kategori.create');
    }
    
    public function store(StorePostRequest $request): RedirectResponse
    {
        // the incoming request
        // $validated = $request->validate([
        //     'kategori_kode' => 'bail|required|unique:m_kategori|max:10',
        //     'kategori_nama' => 'required',
        // ]);

        // KategoriModel::create($validated);

        //alternate validate
        // $validateData = $request->validateWithBag('post', [
        //     'title' => ['required', 'unique:posts', 'max:255'],
        //     'body' => ['required'],
        // ]);

        // retrieve data
        $validated = $request->validated();

        
        // retrieve a portion of the validated data
        $validated = $request->safe()->only(['kategori_kode', 'kategori_nama']);
        // $validated = $request->safe()->except(['kategori_kode', 'kategori_nama']);

        // store the post
        KategoriModel::create($validated);

        return redirect('/kategori');
    }

    public function edit($id)
    {
        $kategori = KategoriModel::find($id);
        return view('kategori.edit', ['data' => $kategori]);
    }

    public function edit_simpan($id, Request $request)
    {
        $kategori = KategoriModel::find($id);

        $kategori->kategori_kode = $request->kodeKategori;
        $kategori->kategori_nama = $request->namaKategori;
        
        $kategori->save();
        
        return redirect('/kategori');
    }

    public function hapus($id)
    {
        $kategori = KategoriModel::find($id);
        $kategori->delete();

        return redirect('/kategori');
    }
}
