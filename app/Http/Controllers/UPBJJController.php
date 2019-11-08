<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Upbjj;

class UPBJJController extends Controller
{
 
    public function index()
    {
        $userlogin = Auth::user()->group;
        if($userlogin != 1 && $userlogin != 2){
            abort(404);
        }else{
            $upbjj = DB::SELECT(
                    "SELECT * FROM mupbjj
                    ");
            return view('upbjj.index', compact('upbjj'));
        }
    }

    public function create()
    {
        $userlogin = Auth::user()->group;
        if($userlogin != 1 && $userlogin != 2){
            abort(404);
        }else{
            return view('upbjj.create');
        }
    }

    public function store(Request $request)
    {
        $userlogin = Auth::user()->group;
        if($userlogin != 1 && $userlogin != 2){
            abort(404);
        }else{

            date_default_timezone_set("Asia/Bangkok");

            $request->validate([
                'kode_upbjj' => 'required|unique:kode_upbjj',
                'nama_upbjj' => 'required',
                'alamat' => 'required',
                'no_telp' => 'required'
                
            ]);

            Upbjj::create($request->all());
            return redirect()->route('upbjj.index')
                            ->with('success', 'UPBJJ Berhasil ditambahkan');
        }
    }

    public function edit($kode_upbjj)
    {
        $TropusX = Auth::user()->group;
        if($TropusX != 1 && $TropusX != 2){
            abort(404);
        }else{
            $id = decrypt($kode_upbjj);
            $upbjj = DB::SELECT(
                    "SELECT * FROM mupbjj WHERE kode_upbjj='$id'
                    ");
            return view('upbjj.edit', compact('upbjj'));
        }
    }

    public function updatex(Request $request)
    {
        $TropusX = Auth::user()->group;
        if($TropusX != 1 && $TropusX != 2){
            abort(404);
        }else{
            date_default_timezone_set("Asia/Bangkok");
            $upbjj = Upbjj::find($request->kode_upbjj);
            $upbjj->nama_upbjj = $request->get('nama_upbjj');
            $upbjj->alamat = $request->get('alamat');
            $upbjj->no_telp = $request->get('no_telp');
            $upbjj->save();
            return back()->with('success', 'Data berhasil di Update');
        }
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
