<?php

namespace App\Http\Controllers;

use App\Jabatan;
use App\Pejabat;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PejabatController extends Controller
{
    public function index()
    {
        $users = User::where('kode_upbjj', Auth::user()->kode_upbjj)->get();
        $pejabats = Pejabat::where('kode_upbjj', Auth::user()->kode_upbjj)->where('status',1)->get();
        $jabatans = Jabatan::get();
        
        return view('pejabat.index', compact('pejabats','users','jabatans'));
    }

    public function simpan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nomor_surat_tugas' => 'required|unique:t_surat_tugas',
            'tanggal_kegiatan' => 'required',
            'nama_kegiatan' => 'required',
        ]);

        if($validator->fails()){
            return back()->with('error',$validator->messages()->all()[0])->withErrors($validator)->withInput();
        }
    }
}
