<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Upbjj;
use Illuminate\Support\Facades\Validator;

class UPBJJController extends Controller
{
 
    public function index()
    {
        $upbjj = Upbjj::get();
       
        return view('upbjj.index', compact('upbjj'));
    }

    public function create()
    {
        return view('upbjj.create');
    }

    public function simpan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_upbjj' => 'required|unique:mupbjj',
            'nama_upbjj' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
        ]);

        if($validator->fails()){
            return back()->with('error',$validator->messages()->all()[0])->withErrors($validator)->withInput();
        }
        
        $upbjj = new Upbjj;
        $upbjj->kode_upbjj = $request->kode_upbjj;
        $upbjj->nama_upbjj = $request->nama_upbjj;
        $upbjj->alamat = $request->alamat;
        $upbjj->no_telp = $request->no_telp;
        $upbjj->save();
        
        return back()->with('success', 'Data berhasil di Simpan');
    }

    public function edit($id)
    {
        $upbjj = Upbjj::find(base64_decode($id));

        return view('upbjj.edit', compact('upbjj'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'alamat' => 'required',
            'no_telp' => 'required',
        ]);

        if($validator->fails()){
            return back()->with('error',$validator->messages()->all()[0])->withErrors($validator)->withInput();
        }
        
        $upbjj = Upbjj::find($id);
        $upbjj->alamat = $request->alamat;
        $upbjj->no_telp = $request->no_telp;
        $upbjj->update();
        
        return back()->with('success', 'Data berhasil di Update');
    }

    public function destroy($kode_upbjj)
    {
        $userlogin = Auth::user()->group;
        if($userlogin != 1 && $userlogin != 2){
            abort(404);
        }else{
            $upbjj = Upbjj::find($kode_upbjj);
            $upbjj->delete();
            return view('upbjj.index')->with('success','Data Berhasil dihapus!');
        }
    }
}
