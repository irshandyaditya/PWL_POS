<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    //
    public function fileUpload()
    {
        return view('file-upload');
    }

    public function fileUploadRename()
    {
        return view('file-upload-rename');
    }

    public function prosesFileUpload(Request $request)
    {
        // dump($request->berkas);
        // return 'Pemrosesan file upload di sini';

        // if($request->hasFile('berkas'))
        // {
        //     echo 'path(): ' . $request->berkas->path();
        //     echo '<br>';
        //     echo 'extension(): ' . $request->berkas->extension();
        //     echo '<br>';
        //     echo 'getClientOriginalExtension(): ' . $request->berkas->getClientOriginalExtension();
        //     echo '<br>';
        //     echo 'getMimeType(): ' . $request->berkas->getMimeType();
        //     echo '<br>';
        //     echo 'getClientOriginalName(): ' . $request->berkas->getClientOriginalName();
        //     echo '<br>';
        //     echo 'getSize(): ' . $request->berkas->getSize();
        // }
        // else
        // {
        //     echo "Tidak ada berkas yang diupload";
        // }
        $request->validate([
            'berkas' => 'required|file|image|max:500',
        ]);
        $extFile = $request->berkas->getClientOriginalName();
        $namaFile = 'web-' . time() . "." . $extFile;
        $path = $request->berkas->move('gambar', $namaFile);
        $path = str_replace('\\', "//", $path);
        echo "Variabel path berisi:$path <br>";

        $pathBaru = asset('gambar/'.$namaFile);
        echo "proses upload berhasil, data disimpan pada: $path";
        echo "<br>";
        echo "Tampilkan link:<a href='$pathBaru'>$pathBaru</a>";
        // echo $request->berkas->getClientOriginalName() . " lolos validasi";
        
        // $pathBaru = asset('storage/'.$namaFile);
        // echo "proses upload berhasil, data disimpan pada: $path";
        // echo "<br>";
        // echo "Tampilkan link:<a href='$pathBaru'>$pathBaru</a>";
    }

    public function prosesFileUploadRename(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'berkas' => 'required|file|image|max:500',
        ]);
        $extensionFile = $request->berkas->getClientOriginalExtension();
        $namaFile = $request->nama . "." . $extensionFile;
        $path = $request->berkas->move('gambar', $namaFile);
        $path = str_replace('\\', "//", $path);
        // echo "Variabel path berisi:$path <br>";

        $pathBaru = asset('gambar/'.$namaFile);
        echo "Gambar berhasil di upload ke $namaFile";
        echo "<br>";
        echo "<img src='$pathBaru'>";
        // echo $request->berkas->getClientOriginalName() . " lolos validasi";
        
        // $pathBaru = asset('storage/'.$namaFile);
        // echo "proses upload berhasil, data disimpan pada: $path";
        // echo "<br>";
        // echo "Tampilkan link:<a href='$pathBaru'>$pathBaru</a>";
    }
}
