<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    public function fileUpload(){
        return view('file-upload');
    }

    public function prosesFileUpload(Request $request){
        // dump($request->berkas);
        // return "Pemrosesan file upload di sini";

        // if ($request->hasFile('berkas')) {
        //     echo "path(): ".$request->berkas->path();
        //     echo "<br>";
        //     echo "extension(): ".$request->berkas->extension();
        //     echo "<br>";
        //     echo "getClientOriginalExtension(): ". $request->berkas->getClientOriginalExtension();
        //     echo "<br>";
        //     echo "getMimeType(): ". $request->berkas->getMimeType();
        //     echo "<br>";
        //     echo "getClientOriginalName(): ". $request->berkas->getClientOriginalName();
        //     echo "<br>";
        //     echo "getSize(): ". $request->berkas->getSize();
        // }
        // else {
        //     echo "Tidak ada berkas yang diupload";
        // }

        // $request->validate([
        //     'berkas'=>'required|file|image|max:500',
        // ]);
        // $extfile=$request->berkas->getClientOriginalName();
        // $namaFile='web-'.time().".".$extfile;
        // $path = $request->berkas->stoerAs('public',$namaFile);

        // $pathBaru=asset('storage/'.$namaFile);
        // // $path = $request->berkas->stoerAs('uploads',$namaFile);
        // echo "proses upload berhasil, data disimpan pada: $path";
        // $namaFile=$request->berkas->getClientOriginalName();
        // $path = $request->berkas->storeAs('uploads',$namaFile);
        // $path = $request->berkas->storeAs('uploads','berkas');
        // $path = $request->berkas->store('uploads'); //store digunakan untuk menggenerate nama acak untuk file upload 
        // echo "proses upload berhasil, file berada di: $path";
        // echo $request->berkas->getClientOriginalName()."lolos validasi";
        // echo "<br>";
        // echo "Tampilkan link: <a href='$pathBaru'>$pathBaru</a>";

        $request->validate([
            'berkas'=>'required|file|image|max:500',
        ]);
        $extfile=$request->berkas->getClientOriginalName();
        $namaFile='web-'.time().".".$extfile;

        $path = $request->berkas->move('gambar',$namaFile);
        $path = str_replace("\\","//",$path);
        echo "Variabel path berisi:$path <br>";

        $pathBaru = asset('gambar/'.$namaFile);
        echo "proses upload berhasil, data di simpan pada:$path";
        echo "<br>";
        echo "Tampilakan link:<a href='$pathBaru'>$pathBaru</a>";
    }

    public function fileUploadTugas(){
        return view('file-upload-tugas');
    }

    public function prosesFileUploadTugas(Request $request){
        $request->validate([
            'nama'=>'required|string|max:255',
            'berkas'=>'required|file|image|max:5000',
        ]);
        $nama = $request->nama;
        $extFile = $request->berkas->getClientOriginalExtension();
        $namaFile = $nama.".".$extFile;

        $path = $request->berkas->move('gambar', $namaFile);
        $path = str_replace("\\","//",$path);
        
        $pathBaru = asset('gambar/'. $namaFile);
        echo "Gambar berhasil di upload ke <a href='$pathBaru'>$namaFile</a><br>";
        echo "<img src='$pathBaru' alt='$namaFile' width='150px'>";
    }
}
