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
use App\User;
use App\StatusValidasi;
use PDF;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use File;

class SDMController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function form()
    {
        $nip = Auth::user()->nip;
        $result = DB::SELECT("SELECT * FROM t_riwayat_pengembangan_sdm WHERE nip='$nip'");
        return view('sdm.form', compact('result'));
    }

    public function formedit($id)
    {
        $idd = decrypt($id);
        $edit = SDM::find($idd);

        $nip = Auth::user()->nip;
        $result = DB::SELECT("SELECT * FROM t_riwayat_pengembangan_sdm WHERE nip='$nip'");

        return view('sdm.form', compact('edit','result'));
    }

    public function hapus($id)
    {       
        $hapus = SDM::find($id);
        $hapus->delete();
        return back()->with('success','Data Berhasil dihapus!');
    }

    public function simpan(Request $request)
    {
        date_default_timezone_set("Asia/Bangkok");
        $rules = array(
            'nama_kegiatan' => 'required',
            'waktu' => 'required|max:100',
            'pelatih' => 'required|max:100',
            'kabko' => 'required|max:50',
            'file' => 'required',
        );

        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            return Redirect::to('sdm/form')
                ->withErrors($validator)
                ->withInput();
        } else{

        $file = $request->file('file');

        // menyimpan file dengan nama
        $nama_file = time()."_".$file->getClientOriginalName();
        // isi dengan nama folder tempat kemana menyimpan file
        $tujuan_upload = 'FileSDM';
        $file->move($tujuan_upload,$nama_file);
        
            $sdm = new SDM;
            $sdm->nama_kegiatan = Input::get('nama_kegiatan');
            $sdm->pelatih = Input::get('pelatih');
            $sdm->waktu = Input::get('waktu');
            $sdm->kabko = Input::get('kabko');
            $sdm->file = $nama_file;
            $sdm->nip = Input::get('nip');
            $sdm->user_create = Input::get('user_create');

            $sdm->save();
        return redirect()->route('sdm.form')
                        ->with('success', 'Data Pengembangan SDM berhasil disimpan');
        }
    }

    public function update(Request $request)
    {
        date_default_timezone_set("Asia/Bangkok");
        $rules = array(
            'nama_kegiatan' => 'required',
            'waktu' => 'required|max:100',
            'pelatih' => 'required|max:100',
            'kabko' => 'required|max:50',
        );

        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            return Redirect::to('sdm/form')
                ->withErrors($validator)
                ->withInput();
        } else{

            $sdm = SDM::find($request->id);
            $sdm->nama_kegiatan = $request->nama_kegiatan;
            $sdm->waktu = $request->waktu;
            $sdm->pelatih = $request->pelatih;
            $sdm->kabko = $request->kabko;
            $sdm->user_update = $request->user_update;
            $sdm->save();
            return redirect()->route('sdm.form')->with('success', 'Data Pengembangan SDM Anda berhasil diperbarui');
        }
    }

    public function peragaan()
    {
        $nip = Auth::user()->nip;

        $pendidikan = DB::SELECT("SELECT * FROM t_riwayat_pendidikan WHERE nip='$nip' ORDER BY tahun ASC");

        $pekerjaan = DB::SELECT("SELECT * FROM t_riwayat_pekerjaan WHERE nip='$nip'");

        $sdm = DB::SELECT("SELECT * FROM t_riwayat_pengembangan_sdm WHERE nip='$nip'");

        return view('sdm.peragaan', compact('pendidikan','pekerjaan','sdm'));
    }

    public function cetak()
    {
        $nip = Auth::user()->nip;
        $pendidikan = DB::SELECT("SELECT * FROM t_riwayat_pendidikan WHERE nip='$nip' ORDER BY tahun ASC");

        $pekerjaan = DB::SELECT("SELECT * FROM t_riwayat_pekerjaan WHERE nip='$nip'");

        $sdm = DB::SELECT("SELECT * FROM t_riwayat_pengembangan_sdm WHERE nip='$nip'");

            $view  = \View::make('sdm.cetak',['sdm' => $sdm , 'pendidikan' => $pendidikan , 'pekerjaan' => $pekerjaan])->render();
            $pdf   = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view)->setPaper('a4', 'portrait');
            
            return $pdf->stream(".Pdf");
    }
}
