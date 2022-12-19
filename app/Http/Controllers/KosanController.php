<?php

namespace App\Http\Controllers;

use App\Models\Kosan;
use Illuminate\Http\Request;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\KosanExport;
use Illuminate\Support\Facades\Session;

class KosanController extends Controller
{
    public function index(Request $request){

        if($request->has('search')){
            $data = Kosan::where('nama','LIKE','%' .$request->search.'%')->paginate(5);
            Session::put('halaman_url', request()->fullUrl());
        }else{
            $data = Kosan::paginate(5);
            Session::put('halaman_url', request()->fullUrl());
        }
        return view('datakosan',compact('data'));
    }

    public function tambahkosan(){
        return view('tambahdata');
    }

    public function insertdata(Request $request){
        $this->validate($request,[
            'nama' => 'required|min:7|max:25',
            'notelpon' => 'required|min:11|max:13',
        ]);

        $data = Kosan::create($request->all());
        if($request->hasFile('foto')){
            $request->file('foto')->move('fotopegawai/', $request->file('foto')->getClientOriginalName());
            $data->foto = $request->file('foto')->getClientOriginalName();
            $data->save();
        }
        return redirect()->route('kosan')->with('success',' Data Berhasil Di Tambahkan ');
    }

    public function tampilkandata($id){

        $data = Kosan::find($id);
        //dd($data);

        return view('tampildata', compact('data'));
    }

    public function updatedata(Request $request, $id){
        $data = Kosan::find($id);
        $data->update($request->all());
        if(session('halaman_url')){
            return Redirect(session('halaman_url'))->with('success',' Data Berhasil Di Update ');
        }

        return redirect()->route('kosan')->with('success',' Data Berhasil Di Update ');

    }

    public function delete($id){
        $data = Kosan::find($id);
        $data->delete();
        return redirect()->route('kosan')->with('success',' Data Berhasil Di Hapus ');
    }

    public function exportpdf(){
        $data = Kosan::all();

        view()->share('data', $data);
        $pdf = PDF::loadview('datakosan-pdf');
        return $pdf->download('data.pdf');
    }

    public function exportexcel(){
        return Excel::download(new KosanExport, 'dataanakkos.xlsx');
    }
}
