<?php

namespace App\Http\Controllers;

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

        $user = UserModel::firstOrNew(
            [
                'username' => 'manager33',
                'nama' => 'Manager Tiga Tiga',
                'password' => Hash::make('12345'),
                'level_id' => 2
            ],
        );
        $user->save();

        return view('user', ['data' => $user]);
    }
}
