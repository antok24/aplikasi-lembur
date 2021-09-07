<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Lembur;
use App\User;
use App\StatusValidasi;
use App\Masa;
use App\export\LemburbulanReport;
use PDF;
use App\Exports\LemburExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\SuratTugas;
use App\SuratTugasDetail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class LemburController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('lembur.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'data' => 'required',
            'masuk' => 'required',
            'pulang' => 'required',
            'totaljam' => 'required',
            'volume' => 'required',
            'satuan' => 'required',
            'uraian_kegiatan' => 'required',
        ]);

        if($validator->fails()){
            return back()->with('error',$validator->messages()->all()[0])->withErrors($validator)->withInput();
        }

        try {

            $datas = json_decode($request->data);

            DB::transaction(function() use($datas, $request) {
                $lembur = new Lembur;
                $lembur->kode_upbjj = $datas->kode_upbjj;
                $lembur->nip = $datas->nip;
                $lembur->id_surat_tugas_detail = $datas->id;
                $lembur->uraian_kegiatan = $request->uraian_kegiatan;
                $lembur->satuan = $request->satuan;
                $lembur->volume = $request->volume;
                $lembur->masuk = $request->masuk;
                $lembur->pulang = $request->pulang;
                $lembur->totaljam = $request->totaljam;
                $lembur->user_create = Auth::user()->name;
                $lembur->save();

                $stdetail = SuratTugasDetail::find($datas->id);
                $stdetail->status = 1;
                $stdetail->update();            
            });

            return redirect()->route('lembur.create')
                        ->with('success', 'Laporan Lembur Anda berhasil di simpan');

        } catch (\Exception $exception) {
            return redirect()->back()
                ->with('error', $exception->getMessage());
        }
    }

    public function edit($id)
    {
        $result = Lembur::find($id);
        return view('lembur.edit', compact('result'));
    }
    
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'masuk' => 'required',
            'pulang' => 'required',
            'totaljam' => 'required',
            'volume' => 'required',
            'satuan' => 'required',
            'uraian_kegiatan' => 'required',
        ]);

        if($validator->fails()){
            return back()->with('error',$validator->messages()->all()[0])->withErrors($validator)->withInput();
        }

        try {
            $lembur = Lembur::find($id);
            $lembur->uraian_kegiatan = $request->uraian_kegiatan;
            $lembur->satuan = $request->satuan;
            $lembur->volume = $request->volume;
            $lembur->masuk = $request->masuk;
            $lembur->pulang = $request->pulang;
            $lembur->totaljam = $request->totaljam;
            $lembur->user_update = Auth::user()->name;
            $lembur->update();

            return redirect()->back()
                        ->with('success', 'Laporan Lembur Anda berhasil di perbarui');

        } catch (\Exception $exception) {
            return redirect()->back()
                ->with('error', $exception->getMessage());
        }

    }

    public function destroy($id)
    {
        $lembur = Lembur::find($id);
        $lembur->delete();
        return back()->with('success','Data Berhasil dihapus!');
    }

    public function editshow()
    {
        $lemburs = Lembur::where('nip', Auth::user()->nip)->where('status_validasi', 0)->orWhere('status_validasi', 2)->get();

        return view('lembur.index_edit', compact('lemburs'));
    }

    public function editlembur($id)
    {
        $lembur = Lembur::find(base64_decode($id));
 
        return view('lembur.create', compact('lembur'));
    }

    public function formsearch()
    {
        $masa = Masa::where('status', 1)->where('kode_upbjj', Auth::user()->kode_upbjj)->get();
        
        return view('lembur.index',[
            'masa' => $masa,
        ]);
    }

    public function search()
    {
        $key = Input::all();

        if ($key) {
            $masa = Masa::where('status', 1)->where('kode_upbjj', Auth::user()->kode_upbjj)->get();

            $result = DB::table('t_lembur AS a')
            ->leftJoin('t_surat_tugas_detail AS b', 'a.id_surat_tugas_detail','=','b.id')
            ->leftJoin('t_surat_tugas AS c', 'b.nomor_surat_tugas', '=','c.nomor_surat_tugas')
            ->leftJoin('users AS d', 'a.nip','=','d.nip')
            ->where('a.kode_upbjj', Auth::user()->kode_upbjj)
            ->where('a.status_validasi', 1)
            ->where('d.nip', Auth::user()->nip)
            ->whereMonth('b.tanggal_kegiatan','=',Input::get('data') )
            ->whereYear('b.tanggal_kegiatan','=',Input::get('tahun'))
            ->select('a.id','d.name','a.nip','b.tanggal_kegiatan','a.masuk','a.pulang','totaljam','c.nama_kegiatan','a.uraian_kegiatan','a.volume','a.satuan')
            ->get();
    
            return view('lembur.index', compact('result','masa'));
        }
        return redirect()->back();
    }

    public function cetak($id)
    {
        if ($id) {
            $lembur = DB::table('t_lembur AS a')
            ->leftJoin('t_surat_tugas_detail AS b', 'a.id_surat_tugas_detail','=','b.id')
            ->leftJoin('t_surat_tugas AS c', 'b.nomor_surat_tugas', '=','c.nomor_surat_tugas')
            ->leftJoin('users AS d', 'a.nip','=','d.nip')
            ->leftJoin('t_pejabat AS e', 'd.nip_atasan','=','e.nip')
            ->where('a.id', base64_decode($id))
            ->select('a.id','d.name','a.nip','b.tanggal_kegiatan','a.masuk','a.pulang','totaljam','c.nama_kegiatan','a.uraian_kegiatan','a.volume','a.satuan','d.nip_atasan','e.nama_atasan')
            ->get();

            $view  = \View::make('lembur.cetak',['lembur' => $lembur])->render();
            $pdf   = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view)->setPaper('a4', 'portrait');
            
            return $pdf->stream($id.".Pdf");
        }
            return redirect()->back()->with('warning', 'ID tidak ditemukan');
         
    }

    public function peragaan()
    {
        $surattugas = SuratTugas::where('status', 1)->where('kode_upbjj', Auth::user()->kode_upbjj)->orderBy('id', 'desc')->get();

        return view('lembur.peragaan', [
            'surattugas' => $surattugas
        ]);
    }

    public function peragaanlembur(Request $request)
    {
        $surattugas = SuratTugas::where('status', 1)->where('kode_upbjj', Auth::user()->kode_upbjj)->orderBy('id','desc')->get();

        $datas = DB::table('t_surat_tugas AS a')
        ->leftJoin('t_surat_tugas_detail AS b', 'a.nomor_surat_tugas','=','b.nomor_surat_tugas')
        ->leftJoin('users AS c', 'b.nip','=','c.nip')
        ->leftJoin('t_lembur AS d', 'b.id', '=', 'd.id_surat_tugas_detail')
        ->where('a.nomor_surat_tugas',$request->data)
        ->where('b.kode_upbjj', Auth::user()->kode_upbjj)
        ->select('b.nomor_surat_tugas','a.nama_kegiatan','b.tanggal_kegiatan','c.name','b.status', 'd.status_validasi')
        ->orderBy('b.tanggal_kegiatan', 'ASC')
        ->get();
        
        return view('lembur.peragaan', [
            'datas' => $datas,
            'surattugas' => $surattugas
        ]);
    }

    public function peragaanperbulan()
    {
        $masa = Masa::where('kode_upbjj', Auth::user()->kode_upbjj)->orderBy('masa', 'desc')->get();

        return view('lembur.peragaan_perbulan', [
            'masa' => $masa
        ]);
    }

    public function peragaanlemburperbulan(Request $request)
    {
        $masa = Masa::where('kode_upbjj', Auth::user()->kode_upbjj)->orderBy('masa', 'desc')->get();

        $datas = DB::table('t_surat_tugas AS a')
        ->leftJoin('t_surat_tugas_detail AS b', 'a.nomor_surat_tugas','=','b.nomor_surat_tugas')
        ->leftJoin('users AS c', 'b.nip','=','c.nip')
        ->leftJoin('t_lembur AS d', 'b.id', '=', 'd.id_surat_tugas_detail')
        ->whereMonth('b.tanggal_kegiatan','=',Input::get('data'))
        ->whereYear('b.tanggal_kegiatan','=',Input::get('tahun'))
        ->where('b.kode_upbjj', Auth::user()->kode_upbjj)
        ->select('b.nomor_surat_tugas','a.nama_kegiatan','b.tanggal_kegiatan','c.name','b.status', 'd.status_validasi')
        ->orderBy('b.tanggal_kegiatan', 'ASC')
        ->get();
        
        return view('lembur.peragaan_perbulan', [
            'datas' => $datas,
            'masa' => $masa
        ]);
    }


    public function peragaanuser()
    {
        $result = DB::table('t_lembur AS a')
        ->leftJoin('t_surat_tugas_detail AS b', 'a.id_surat_tugas_detail','=','b.id')
        ->leftJoin('t_surat_tugas AS c', 'b.nomor_surat_tugas', '=','c.nomor_surat_tugas')
        ->leftJoin('users AS d', 'a.nip','=','d.nip')
        ->where('a.kode_upbjj', Auth::user()->kode_upbjj)
        ->where('a.status_validasi', 1)
        ->where('d.nip', Auth::user()->nip)
        ->select('a.id','d.name','a.nip','b.tanggal_kegiatan','a.masuk','a.pulang','totaljam','c.nama_kegiatan','a.uraian_kegiatan','a.volume','a.satuan','a.status_validasi')
        ->get();
        
        return view('lembur.peragaanupbjj', compact('result'));
    }

    public function laporan()
    {
        $result = DB::table('t_lembur AS a')
        ->leftJoin('t_surat_tugas_detail AS b', 'a.id_surat_tugas_detail','=','b.id')
        ->leftJoin('t_surat_tugas AS c', 'b.nomor_surat_tugas', '=','c.nomor_surat_tugas')
        ->leftJoin('users AS d', 'a.nip','=','d.nip')
        ->where('a.kode_upbjj', Auth::user()->kode_upbjj)
        ->where('a.status_validasi', 0)
        ->where('d.nip_atasan', Auth::user()->nip)
        ->select('a.id','d.name','a.nip','b.tanggal_kegiatan','a.masuk','a.pulang','totaljam','c.nama_kegiatan','a.uraian_kegiatan','a.volume','a.satuan')
        ->get();

        return view('lembur.laporan', compact('result'));
    }

    public function validasi($id)
    {
        if($id){
            $lembur = Lembur::find(base64_decode($id));
            $lembur->status_validasi = 1;
            $lembur->catatan_atasan = 'Oke';
            $lembur->update();

            return redirect()->back()->with('success', 'Data Lembur berhasil divalidasi');
        }
    }

    public function gagalvalidasi($id)
    {
        if($id){
            $lembur = Lembur::find(base64_decode($id));
            $lembur->status_validasi = 2;
            $lembur->catatan_atasan = 'Mohon diperbaiki lagi';
            $lembur->update();

            return redirect()->back()->with('warning', 'Data Lembur digagalkan validasinya');
        }
    }

    public function changepasswordx($id)
    {
        
        $user = User::find($id);
        return view('password.edit', compact('user'));
    }

    public function mlemburindex()
    {
        return view('lembur.master_index');
    }

    public function mlemburindexsearch()
    {
        $key = Input::get('key');

        if ($key) {
            $result = DB::table('t_lembur AS a')
            ->leftJoin('t_surat_tugas_detail AS b', 'a.id_surat_tugas_detail','=','b.id')
            ->leftJoin('t_surat_tugas AS c', 'b.nomor_surat_tugas', '=','c.nomor_surat_tugas')
            ->leftJoin('users AS d', 'a.nip','=','d.nip')
            ->where('a.kode_upbjj', Auth::user()->kode_upbjj)
            ->where('a.status_validasi', 1)
            ->where(function ($query) use ($key) {
                $query->where('a.nip', 'like','%'.$key.'%')
                    ->orWhere('d.name', 'like','%'.$key.'%');
            })
            ->select('a.id','d.name','a.nip','b.tanggal_kegiatan','a.masuk','a.pulang','totaljam','c.nama_kegiatan','a.uraian_kegiatan','a.volume','a.satuan','a.status_validasi')
            ->orderBy('b.tanggal_kegiatan', 'desc')
            ->get();
            
            return view('lembur.master_index', compact('result'));
        }
            return redirect()->back();
    }

    public function batalvalidasi($id)
    {
        if ($id) {
            $result = Lembur::findOrfail(base64_decode($id));
            $result->status_validasi = 0;
            $result->user_update = Auth::user()->name;
            $result->update();

            return redirect()->back()->with('warning', 'Data Lembur digagalkan validasinya');
        }
    }

    public function deletelembur($id)
    {
        DB::transaction(function() use($id) {
            $lembur = Lembur::findOrfail(base64_decode($id));

            $stdetail = SuratTugasDetail::where('id',$lembur->id_surat_tugas_detail)->first();
            $stdetail->status = 0;
            $stdetail->save();

            $lembur->delete();
        });

        return redirect()->route('lembur.editshow')->with(['success' => 'Lembur berhasil di hapus']);
    }
}
