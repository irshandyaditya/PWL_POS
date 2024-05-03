<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // jika user sudah ada
        if ($user) {
            // jika user memiliki level admin
            if ($user->level_id == '1') {
                return redirect()->intended('admin');
            }
            // jika level manager
            else if ($user->level == '2') {
                return redirect()->intended('manager');
            }
        }
        return view('login');
    }
    //
    public function proses_login(Request $request)
    {
        // kita buat validasi pada saat tombol login di klik
        // validasinya username dan password wajib diisi
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // ambil data request username & password saja
        $credential = $request->only('username','password');

        // dd(Auth::attempt($credential));
        // cek jika data username dan password valid (sesuai) dengan data
        if(!Auth::attempt($credential)){
            // kalau berhasil simpan data usernya di varible $user
            $user = Auth::user();

            // cek lagi jika level user admin maka arahkan ke halaman admin
            if($user->level_id == '1'){
                return redirect()->intended('admin');
            }

            // tapi jika level usernya user biasa maka arahkan ke halaman user
            else if($user->level_id == '2'){
                return redirect()->intended('manager');
            }
            // jika belum ada role maka ke halaman /
            return redirect()->intended('/');
        }
        // jika ga ada data user yang valid maka kembalikan lagi ke halaman login
        // pastikan kirim pesan error juga kalau login gagal ya
        return redirect('login')
            ->withInput()
            ->withErrors(['login_gagal' => 'Pastikan kembali username dan password yang dimasukkan sudah benar']);
    }

    public function register()
    {
        // tampilkan view register
        return view('register');
    }

    public function proses_register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'username' => 'required|unique:m_user',
            'password' => 'required'
        ]);


        // mengembalikan ke halaman register kalo gagal
        if ($validator->fails()){
            return redirect('/register')
                ->withErrors($validator)
                ->withInput();
        }
        // kalo berhasil
        $request['level_id'] = '2';
        $request['password'] = Hash::make($request->password);

        //masukkan data
        UserModel::create($request->all());

        return redirect()->route('login');
    }    

    public function logout(Request $request)
    {
        // menghapus session
        $request->session()->flush();
        // jalan kan juga fungsi logout pada auth
        Auth::logout();
        return Redirect('login');
    }
}
