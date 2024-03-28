<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

        $user = UserModel::with('level')->get();
        return view('user', ['data' => $user]);
    }

    public function tambah()
    {
        $level = LevelModel::get();
        return view('user_tambah', ['data' => $level]);
    }

    public function tambah_simpan(Request $request)
    {
        UserModel::create([
            'username' => $request->username,
            'nama' => $request->nama,
            'password' => Hash::make('$request->password'),
            'level_id' => $request->level_id
        ]);

        return redirect('/user');
    }

    public function ubah($id)
    {
        $user = UserModel::find($id);
        return view('user_ubah', ['data' => $user]);
    }
    
    public function ubah_simpan($id, Request $request)
    {
        $user = UserModel::find($id);

        $user->username = $request->username;
        $user->nama = $request->nama;
        $user->password = Hash::make('$request->password');
        $user->level_id = $request->level_id;

        $user->save();

        return redirect('/user');
    }

    public function hapus($id)
    {
        $user = UserModel::find($id);
        $user->delete();

        return redirect('/user');
    }
}
