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
use Carbon\Carbon;

class LemburController extends Controller
{
    public static $kon = 'mysql';
    public static $con = 'mysql2';

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
        date_default_timezone_set("Asia/Bangkok");
        $request->validate([
            'namapegawai' => 'required',
            'nip' => 'required',
            'nip_atasan' => 'required',
            'tgl_lembur' => 'required',
            'kegiatan' => 'required',
            'uraiankegiatan' => 'required',
            'satuan' => 'required',
            'masuk' => 'required',
            'pulang' => 'required',
            'totaljam' => 'required',
            'status' => 'required',
            'volume' => 'required',
            'kode_upbjj' => 'required',
            'user_id' => 'required'
        ]);

        Lembur::create($request->all());
        return redirect()->route('lembur.create')
                        ->with('success', 'Kegiatan Lembur Anda berhasil di simpan');
    }

    public function edit($id)
    {
        $result = Lembur::find($id);
        return view('lembur.edit', compact('result'));
    }

    
    public function update(Request $request)
    {
       date_default_timezone_set("Asia/Bangkok");
       $lembur = Lembur::findOrfail($request->id);
       $lembur->update($request->all());
       return back()->with('success', 'Data berhasil di Validasi');

    }

    public function updatelembur(Request $request)
    {
        date_default_timezone_set("Asia/Bangkok");
        $lembur = Lembur::findOrfail($request->id);
        $lembur->update($request->all());
        return back()->with('success', 'Data Lembur anda berhasil di update');
    }

    public function destroy($id)
    {
        $lembur = Lembur::find($id);
        $lembur->delete();
        return back()->with('success','Data Berhasil dihapus!');
    }

    public function editlembur()
    {
        return view('lembur.index_edit');
    }

    public function editsearch()
    {
        $nip = Auth::user()->nip;
        $result = DB::SELECT(
                "SELECT * FROM tlembur
                WHERE nip='$nip'
                AND status='0'
                ");
 
        return view('lembur.index_edit', compact('result'));
    }

    public function editaja($id)
    {
        $result = Lembur::find(decrypt($id));
 
        return view('lembur.edit_lembur', compact('result'));
    }

    public function search(Request $request)
    {
        $kode_upbjj = Auth::user()->kode_upbjj;
        $result = Lembur::when($request->cari, function ($query) use ($request) {
            $query->where('nip', 'LIKE', "%{$request->cari}%")->where('status', 1)->orderBy('created_at', 'desc');
        })->paginate(100);
 
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
        return view('lembur.peragaan');
    }

    public function peragaanupbjj()
    {
        $kode_upbjj = Auth::user()->kode_upbjj;
        $result = DB::SELECT( 
                "SELECT c.nip, a.namapegawai, a.tgl_lembur, a.masuk, a.pulang, a.totaljam, a.kegiatan, a.uraiankegiatan, a.volume, a.satuan, b.status_verifikasi
                 FROM tlembur a
                 LEFT JOIN m_statusverifikasi b ON a.status=b.kode_verifikasi
                 LEFT JOIN users c ON a.nip=c.nip
                 WHERE a.kode_upbjj='$kode_upbjj' 
                 AND b.kode_verifikasi='1'
                 ");
        return view('lembur.peragaanupbjj', compact('result'));

    }

    public function peragaanuser()
    {
        $LotusX = Auth::user()->group;
        if($LotusX != 1 && $LotusX != 2 && $LotusX != 3 && $LotusX != 4 && $LotusX != 5 && $LotusX != 6 && $LotusX != 7 && $LotusX != 8 ){
            abort(404);
        }else{

        $kode_upbjj = Auth::user()->kode_upbjj;
        $nip = Auth::user()->nip;
        $result = DB::SELECT( 
                "SELECT c.nip, a.namapegawai, a.tgl_lembur, a.masuk, a.pulang, a.totaljam, a.kegiatan, a.uraiankegiatan, a.volume, a.satuan, b.status_verifikasi
                 FROM tlembur a
                 LEFT JOIN m_statusverifikasi b ON a.status=b.kode_verifikasi
                 LEFT JOIN users c ON a.nip=c.nip
                 WHERE a.nip='$nip'
                 AND a.kode_upbjj='$kode_upbjj' 
                 AND a.status='1'
                 ORDER BY a.tgl_lembur ASC
                 ");
        return view('lembur.peragaanupbjj', compact('result'));
        }
    }

    public function laporan()
    {
        $LotusX = Auth::user()->group;
        if($LotusX != 1 && $LotusX != 2 && $LotusX != 4 && $LotusX != 5){
            abort(404);
        }else{

        $upbjj = Auth::user()->kode_upbjj;
        $nipatasan = Auth::user()->nip;
        $result = DB::SELECT( 
                "SELECT a.id, a.kode_upbjj, a.nip, a.nip_atasan, a.namapegawai, a.tgl_lembur, a.masuk, a.pulang, a.totaljam, a.kegiatan, a.uraiankegiatan, a.volume, a.satuan, b.status_verifikasi, a.user_id
                 FROM tlembur a
                 LEFT JOIN m_statusverifikasi b ON a.status=b.kode_verifikasi
                 WHERE a.kode_upbjj='$upbjj'
                 AND a.nip_atasan='$nipatasan'
                 AND a.status='0'
                 ");
        return view('lembur.laporan', compact('result'));
        }
    }

    public function export()
    {
        return Excel::download(new LemburExport, 'Lembur.xlsx');
    }

    public function exportquery(Request $request) 
    {
       // return Excel::download(new LemburQueryExport($request->kode_upbjj), 'Lembur_query.xlsx');
    }

    public function changepasswordx($id)
    {
        $LotusX = Auth::user()->group;
        if($LotusX != 1 && $LotusX != 2 && $LotusX != 3 && $LotusX != 4 && $LotusX != 5 && $LotusX != 6 && $LotusX != 7 && $LotusX != 8 ){
            abort(404);
        }else{

        $user = User::find($id);
        return view('password.edit', compact('user'));
        }
    }

    public function importlemburindex()
    {
        return view('lembur.import_lembur');
    }

    public function importlembur(Request $request)
    {
        //VALIDASI
        $this->validate($request, [
            'file' => 'required|mimes:xls,xlsx'
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file'); //GET FILE
            Excel::import(new LemburImport, $file); //IMPORT FILE
            return redirect()->back()->with(['success' => 'Import Data peserta lembur Berhasil']);
        }  
        return redirect()->back()->with(['error' => 'Data Gagal ! Silahkan import ulang']);
    }

    public function mlemburindex()
    {
        $LotusX = Auth::user()->group;
        if($LotusX != 1 && $LotusX != 2){
            abort(404);
        }else{
            return view('lembur.master_index');
        }
    }

    public function mlemburindexsearch(Request $request)
    {
        $kode_upbjj = Auth::user()->kode_upbjj;
        $request = Input::get('cari');
        $result = DB::SELECT(
                "SELECT * FROM tlembur
                WHERE kode_upbjj='$kode_upbjj'
                AND nip='$request'
                ");
 
        return view('lembur.master_index', compact('result'));
    }

    public function masteredit($id)
    {
        $LotusX = Auth::user()->group;
        if($LotusX != 1 && $LotusX != 2){
            abort(404);
        }else{

        $result = Lembur::find(decrypt($id));
        return view('lembur.master_edit_lembur', compact('result'));
        }
    }

    public function ragaindex()
    {
        $LotusX = Auth::user()->group;
        if($LotusX != 1 && $LotusX != 2){
            abort(404);
        }else{
            return view('peragaan.raga_validasi');
        }
    }

    public function ragaindexsearch()
    {
        $LotusX = Auth::user()->group;
        if($LotusX != 1 && $LotusX != 2){
            abort(404);
        }else{
            date_default_timezone_set("Asia/Bangkok");
            $request = Input::get('cari');
            $upbjj = Auth::user()->kode_upbjj;
            $result = DB::SELECT(
                    "SELECT * FROM tlembur
                    WHERE status='$request'
                    AND kode_upbjj='$upbjj'
                    ");
     
            return view('peragaan.raga_validasi', compact('result'));
        }
    }
}
