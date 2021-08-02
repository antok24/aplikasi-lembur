<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Lembur;
use App\User;
use App\StatusValidasi;
use App\export\LemburbulanReport;
use PDF;
use App\Exports\LemburExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\Imports\LemburImport;
use App\Exports\LemburQueryExport;
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

    public function index()
    {
        return view('lembur.index');
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
        $lemburs = Lembur::where('status_validasi', 0)->get();

        return view('lembur.index_edit', compact('lemburs'));
    }

    public function editlembur($id)
    {
        $lembur = Lembur::find(base64_decode($id));
 
        return view('lembur.create', compact('lembur'));
    }

    public function search(Request $request)
    {
        $result = DB::table('t_lembur AS a')
        ->leftJoin('t_surat_tugas_detail AS b', 'a.id_surat_tugas_detail','=','b.id')
        ->leftJoin('t_surat_tugas AS c', 'b.nomor_surat_tugas', '=','c.nomor_surat_tugas')
        ->leftJoin('users AS d', 'a.nip','=','d.nip')
        ->where('a.kode_upbjj', Auth::user()->kode_upbjj)
        ->where('a.status_validasi', 1)
        ->where('d.nip', Auth::user()->nip)
        ->whereMonth('b.tanggal_kegiatan','=',$request->data )
        ->whereYear('b.tanggal_kegiatan','=',$request->tahun)
        ->select('a.id','d.name','a.nip','b.tanggal_kegiatan','a.masuk','a.pulang','totaljam','c.nama_kegiatan','a.uraian_kegiatan','a.volume','a.satuan')
        ->get();
 
        return view('lembur.index', compact('result'));
    }

    public function search1()
    {
        $cari = Input::get('kode_upbjj');
        if($cari != ""){
            $result = DB::table('tlembur')
                        ->join('m_statusverifikasi','tlembur.status','m_statusverifikasi.kodeverifikasi') 
                        ->where('kode_upbjj', 'LIKE', '%' .$cari. '%')->get();
            if(count($result)>0)
                return view('lembur.index')->withDetails($result)->withQuery($cari);
        }
        return view('lembur.index')->withMessage('Data Tidak ditemukan!');
    }

    public function cetak(Request $request,$id)
    {
        $LotusX = Auth::user()->group;
        if($LotusX != 1 && $LotusX != 2 && $LotusX != 3 && $LotusX != 4 && $LotusX != 5 && $LotusX != 6 && $LotusX != 7 && $LotusX != 8 ){
            abort(404);
        }else{

            $id = decrypt($id);
            $lembur = DB::SELECT(
                    "SELECT a.id, a.nip, a.namapegawai, a.nip_atasan, a.tgl_lembur, a.kegiatan, a.uraiankegiatan, a.satuan, a.volume, a.masuk, a.pulang, a.totaljam, b.name
                    FROM tlembur a
                    LEFT JOIN users b ON a.nip_atasan=b.nip
                    WHERE a.id='$id'
                    ");
            $view  = \View::make('lembur.cetak',['lembur' => $lembur])->render();
            $pdf   = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view)->setPaper('a4', 'portrait');
            
            return $pdf->stream($id.".Pdf");    
        }
    }

    public function peragaan()
    {
        $surattugas = SuratTugas::where('status', 1)->where('kode_upbjj', Auth::user()->kode_upbjj)->get();

        return view('lembur.peragaan', [
            'surattugas' => $surattugas
        ]);
    }

    public function peragaanlembur(Request $request)
    {
        $surattugas = SuratTugas::where('status', 1)->where('kode_upbjj', Auth::user()->kode_upbjj)->get();

        $datas = DB::table('t_surat_tugas AS a')
        ->leftJoin('t_surat_tugas_detail AS b', 'a.nomor_surat_tugas','=','b.nomor_surat_tugas')
        ->leftJoin('users AS c', 'b.nip','=','c.nip')
        ->leftJoin('t_lembur AS d', 'b.id', '=', 'd.id_surat_tugas_detail')
        ->where('a.nomor_surat_tugas',$request->data)
        ->where('b.kode_upbjj', Auth::user()->kode_upbjj)
        ->orderBy('b.tanggal_kegiatan', 'ASC')
        ->get();
        
        return view('lembur.peragaan', [
            'datas' => $datas,
            'surattugas' => $surattugas
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

    public function exportquery(Request $request) 
    {
       
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

    public function mlemburindexsearch(Request $request)
    { 
        return view('lembur.master_index', compact('result'));
    }

    public function masteredit($id)
    {
        $result = Lembur::find(decrypt($id));
        return view('lembur.master_edit_lembur', compact('result'));
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
