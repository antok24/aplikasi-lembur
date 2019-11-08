<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\SDM;
use App\Pendidikan;
use App\Pekerjaan;
use App\User;
use App\StatusValidasi;
use App\export\LemburbulanReport;
use PDF;
use App\Exports\LemburExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\Imports\LemburImport;
use App\Exports\LemburQueryExport;
use Carbon\Carbon;

class PendidikanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function form()
    {
        $nip = Auth::user()->nip;
        $result = DB::SELECT("SELECT * FROM t_riwayat_pendidikan WHERE nip='$nip' order by tahun asc");
        
        return view('pendidikan.form', compact('result'));
    }

    public function formedit($id)
    {
        $idd = decrypt($id);
        $edit = Pendidikan::find($idd);

        $nip = Auth::user()->nip;
        $result = DB::SELECT("SELECT * FROM t_riwayat_pendidikan WHERE nip='$nip'");

        return view('pendidikan.form', compact('edit','result'));
    }

    public function hapus($id)
    {       
        $hapus = Pendidikan::find($id);
        $hapus->delete();
        return back()->with('success','Data Berhasil dihapus!');
    }

    public function simpan(Request $request)
    {
        date_default_timezone_set("Asia/Bangkok");
        $rules = array(
            'jenjang' => 'required',
            'pendidikan' => 'required',
            'tahun' => 'required',
            'kabko' => 'required',
        );

        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            return Redirect::to('study/form')
                ->withErrors($validator)
                ->withInput();
        }else{
            $pendidikan = new Pendidikan;
            $pendidikan->jenjang = Input::get('jenjang');
            $pendidikan->pendidikan = Input::get('pendidikan');
            $pendidikan->tahun = Input::get('tahun');
            $pendidikan->kabko = Input::get('kabko');
            $pendidikan->nip = Input::get('nip');
            $pendidikan->user_create = Input::get('user_create');

            $pendidikan->save();
            return redirect()->route('study.form')
                        ->with('success', 'Data Pendidikan Baru berhasil disimpan');
        }
    }

    public function update(Request $request)
    {
        date_default_timezone_set("Asia/Bangkok");
        $request->validate([
            'pendidikan' => 'required',
            'tahun' => 'required',
            'user_update' => 'required'
        ]);

        $pendidikan = Pendidikan::find($request->id);
        $pendidikan->pendidikan = $request->pendidikan;
        $pendidikan->jenjang = $request->jenjang;
        $pendidikan->tahun = $request->tahun;
        $pendidikan->kabko = $request->kabko;
        $pendidikan->user_update = $request->user_update;
        $pendidikan->save();
        return redirect()->route('study.form')->with('success', 'Data Pendidikan Anda berhasil diperbarui');
    }
}
