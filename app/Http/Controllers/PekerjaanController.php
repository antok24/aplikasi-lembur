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

class PekerjaanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function form()
    {
        $nip = Auth::user()->nip;
        $result = DB::SELECT("SELECT * FROM t_riwayat_pekerjaan WHERE nip='$nip'");

        return view('pekerjaan.form', compact('result'));
    }

    public function formedit($id)
    {
        $idd = decrypt($id);
        $edit = Pekerjaan::find($idd);

        $nip = Auth::user()->nip;
        $result = DB::SELECT("SELECT * FROM t_riwayat_pekerjaan WHERE nip='$nip'");

        return view('pekerjaan.form', compact('edit','result'));
    }

    public function hapus($id)
    {       
        $hapus = Pekerjaan::find($id);
        $hapus->delete();
        return back()->with('success','Data Berhasil dihapus!');
    }

    public function simpan(Request $request)
    {
        date_default_timezone_set("Asia/Bangkok");
        
        $rules = array(
            'unit_kerja' => 'required',
            'jabatan' => 'required|max:100',
            'nomor_sk' => 'required|max:100',
            'waktu' => 'required|max:50',
            'keterangan' => 'required|max:100',
        );

        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            return Redirect::to('jobs/form')
                ->withErrors($validator)
                ->withInput();
        } else{
            $pekerjaan = new Pekerjaan;
            $pekerjaan->unit_kerja = Input::get('unit_kerja');
            $pekerjaan->jabatan = Input::get('jabatan');
            $pekerjaan->nomor_sk = Input::get('nomor_sk');
            $pekerjaan->waktu = Input::get('waktu');
            $pekerjaan->keterangan = Input::get('keterangan');
            $pekerjaan->nip = Input::get('nip');
            $pekerjaan->user_create = Input::get('user_create');

            $pekerjaan->save();
            return redirect()->route('jobs.form')
                        ->with('success', 'Data Pekerjaan berhasil disimpan');
        }
    }

    public function update(Request $request)
    {
        date_default_timezone_set("Asia/Bangkok");
        $request->validate([
            'unit_kerja' => 'required',
            'jabatan' => 'required',
            'user_update' => 'required'
        ]);

        $pekerjaan = Pekerjaan::find($request->id);
        $pekerjaan->unit_kerja = $request->unit_kerja;
        $pekerjaan->jabatan = $request->jabatan;
        $pekerjaan->nomor_sk = $request->nomor_sk;
        $pekerjaan->waktu = $request->waktu;
        $pekerjaan->keterangan = $request->keterangan;
        $pekerjaan->user_update = $request->user_update;
        $pekerjaan->save();
        return redirect()->route('jobs.form')->with('success', 'Data Pekerjaan Anda berhasil diperbarui');
    }
}
