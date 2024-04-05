<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index()
    {
        // tambah data dengan Eloquent Model
        // $data = [
        //     'level_id' => 2,
        //     'username' => 'manager_tiga',
        //     'nama' => 'Manager 3',
        //     'password' => Hash::make('12345')
        // ];
        // UserModel::create($data); // menambahkan data ke tabel m_user

        // coba akses user model
        // $user = UserModel::find(1); mengambil id 1 
        
        // $user = UserModel::where('level_id', 1)->first(); mengambil 1 data teratas dgn level_id 1
        
        // $user = UserModel::firstWhere('level_id', 1);
        
        //$user = UserModel::findOr(1, ['username', 'nama'], function () {
        //     abort(404);
        // }); memfilter output dari data yang ingin dicari
        
        // $user = UserModel::findOr(20, ['username', 'nama'], function () {
        //     abort(404);
        // }); tampilan ketika id tidak ada
        
        // $user = UserModel::findOrFail(1); mengambil data dan jika tidak ada akan diberi exception
        
        // $user = UserModel::where('username', 'manager9')->firstOrFail(); tampilan exception

        // $user = UserModel::where('level_id', 2)->count(); menghitung row data yang keluar yang memiliki level id = 2

        // $user = UserModel::firstOrCreate(
        //     [
        //         'username' => 'manager22',
        //         'nama' => 'Manager Dua Dua',
        //         'password' => Hash::make('12345'),
        //         'level_id' => 2
        //     ],
        // ); menambahkan data apabila tidak ada sekaligus menampilkan data tersebut atau hanya menampilkan data jika data tersebut telah direcord dalam table m_user

        // $user = UserModel::firstOrNew(
        //     [
        //         'username' => 'manager33',
        //         'nama' => 'Manager Tiga Tiga',
        //         'password' => Hash::make('12345'),
        //         'level_id' => 2
        //     ],
        // );
        // $user->save(); membuat dan menyimpan data model

        // $user = UserModel::create(
        //     [
        //         'username' => 'manager55',
        //         'nama' => 'Manager55',
        //         'password' => Hash::make('12345'),
        //         'level_id' => 2
        //     ],
        // ); 

        // $user->username = 'manager56';

        // $user->isDirty(); //t karena data pernah berubah
        // $user->isDirty('username'); //t
        // $user->isDirty('nama'); //f
        // $user->isDirty(['nama', 'username']); //t

        // $user->isClean(); //f karena data pernah berubah
        // $user->isClean('username'); //f
        // $user->isClean('nama'); //t
        // $user->isClean(['nama', 'username']); //f

        // $user->save();

        // $user->isDirty(); //false
        // $user->isClean(); //true
        // dd($user->isDirty()); Untuk mengetahui apakah data pernah diuubah atau tidak
        
        // $user = UserModel::create(
        //     [
        //         'username' => 'manager11',
        //         'nama' => 'Manager11',
        //         'password' => Hash::make('12345'),
        //         'level_id' => 2
        //     ],
        // ); 

        // $user->username = 'manager12';
        
        // $user->save();
        
        // $user->wasChanged(); //t karena data pernah berubah
        // $user->wasChanged('username'); //t
        // $user->wasChanged(['username', 'level_id']); //t
        // $user->wasChanged('nama'); //f
        // $user->wasChanged(['nama', 'username']); //t
        // dd($user->wasChanged(['nama', 'username'])); //true untuk cek data pernah diubah atau tidak sejak menjadi data model (blm disave)

        // $user = UserModel::all();
        // $user = UserModel::with('level')->get();
        $breadcrumb = (object) [
            'title' => 'Daftar User',
            'list' => ['Home', 'User']
        ];

        $page = (object) [
            'title' => 'Daftar user yang terdaftar dalam sistem',
        ];

        $activeMenu = 'user'; // set menu aktif

        return view('user.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    // public function tambah()
    // {
    //     $level = LevelModel::get();
    //     return view('user_tambah', ['data' => $level]);
    // }

    // public function tambah_simpan(Request $request)
    // {
    //     UserModel::create([
    //         'username' => $request->username,
    //         'nama' => $request->nama,
    //         'password' => Hash::make('$request->password'),
    //         'level_id' => $request->level_id
    //     ]);

    //     return redirect('/user');
    // }

    // public function ubah($id)
    // {
    //     $user = UserModel::find($id);
    //     return view('user_ubah', ['data' => $user]);
    // }
    
    // public function ubah_simpan($id, Request $request)
    // {
    //     $user = UserModel::find($id);

    //     $user->username = $request->username;
    //     $user->nama = $request->nama;
    //     $user->password = Hash::make('$request->password');
    //     $user->level_id = $request->level_id;

    //     $user->save();

    //     return redirect('/user');
    // }

    // public function hapus($id)
    // {
    //     $user = UserModel::find($id);
    //     $user->delete();

    //     return redirect('/user');
    // }

    // Ambil data user dalam bentuk json untuk datatables
    public function list(Request $request)
    {
        $users = UserModel::select('user_id', 'username', 'nama', 'level_id')->with('level');
        return DataTables::of($users)
            ->addIndexColumn() // menambahkan kolom index / no urut (default namakolom: DT_RowIndex)
            ->addColumn('aksi', function ($user) { // menambahkan kolom aksi
                $btn = '<a href="'.url('/user/' . $user->user_id).'" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="'.url('/user/' . $user->user_id . '/edit').'"class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="'. url('/user/'.$user->user_id).'">' . csrf_field() . method_field('DELETE') . '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                return $btn;
            })
        ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
        ->make(true);
    }

    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah User User',
            'list' => ['Home', 'User', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah user baru',
        ];

        $level = LevelModel::all();
        $activeMenu = 'user'; // set menu aktif

        return view('user.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level, 'activeMenu' => $activeMenu]);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|min:3|unique:m_user,username',
            'nama' => 'required|string|max:100',
            'password' => 'required|min:5',
            'level_id' => 'required|integer'
        ]);

        UserModel::create([
            'username' => $request->username, 
            'nama' => $request->nama, 
            'password' => bcrypt($request->password), 
            'level_id' => $request->level_id 
        ]);

        return redirect('/user')->with('success', 'Data user berhasil disimpan');
    }

    public function show($id)
    {
        $user = UserModel::with('level')->find($id);

        $breadcrumb = (object) [
            'title' => 'Detail User',
            'list' => ['Home', 'User', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail user',
        ];

        $activeMenu = 'user'; // set menu aktif

        return view('user.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'user' => $user, 'activeMenu' => $activeMenu]);
    
    }
    public function edit($id)
    {
        $user = UserModel::find($id);
        $level = LevelModel::all();

        $breadcrumb = (object) [
            'title' => 'Edit User',
            'list' => ['Home', 'User', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit user',
        ];

        $activeMenu = 'user'; // set menu aktif

        return view('user.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'user' => $user, 'level' => $level, 'activeMenu' => $activeMenu]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'username' => 'required|string|min:3|unique:m_user,username,'.$id.',user_id',
            'nama' => 'required|string|max:100',
            'password' => 'required|min:5',
            'level_id' => 'required|integer'
        ]);

        UserModel::find($id)->update([
            'username' => $request->username, 
            'nama' => $request->nama, 
            'password' => $request->password ? bcrypt($request->password) : UserModel::find($id)->password, 
            'level_id' => $request->level_id 
        ]);

        return redirect('/user')->with('success', 'Data user berhasil diubah');
    }
    
    public function destroy($id)
    {
        $check = UserModel::find($id);
        if(!$check){
            return redirect('/user')->with('error', 'Data user tidak ditemukan');
        }

        try{
            UserModel::destroy($id);

            return redirect('/user')->with('success', 'Data user berhasil dihapus');
        }catch(\Illuminate\Database\QueryException $e){
            // jika error redirect kembali ke halaman dengan membawa pesan error
            return redirect('/user')->with('error', 'Data user gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}
