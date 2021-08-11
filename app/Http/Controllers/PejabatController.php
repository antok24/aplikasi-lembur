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

        $cekpejabat = Pejabat::where('kode_upbjj', Auth::user()->kode_upbjj)->where('status',1)->count();
        
        return view('pejabat.index', compact('pejabats','users','jabatans','cekpejabat'));
    }

    public function simpan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'data' => 'required',
            'kode_jabatan' => 'required',
        ]);

        if($validator->fails()){
            return back()->with('error',$validator->messages()->all()[0])->withErrors($validator)->withInput();
        }
        $datas = json_decode($request->data);

        try {
            $pejabat = new Pejabat;
            $pejabat->kode_upbjj = Auth::user()->kode_upbjj;
            $pejabat->nip = $datas->nip; 
            $pejabat->nama_atasan = $datas->name; 
            $pejabat->kode_jabatan = $request->kode_jabatan;
            $pejabat->status = 1;
            $pejabat->user_create = Auth::user()->name;
            $pejabat->save(); 

            return back()->with('success',''.$pejabat->user->name.' berhasil disimpan sebagai atasan');

        } catch (\Exception $exception) {
            return redirect()->back()
                ->with('error', $exception->getMessage());
        }

    }

    public function delete($id)
    {
        if($id){
            $pejabat= Pejabat::find(base64_decode($id));
            $pejabat->delete();

            return redirect()->back()
                    ->with('success', 'Atasan dengan nama '.$pejabat->user->name.' berhasil di nonaktifkan' );
        }
    }
}
