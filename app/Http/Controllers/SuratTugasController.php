<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\SuratTugas;
use App\SuratTugasDetail;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class SuratTugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $surattugas = SuratTugas::where('status', 0)->get();

        return view('surattugas.create', compact('surattugas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nomor_surat_tugas' => 'required|unique:t_surat_tugas',
            'tanggal_kegiatan' => 'required',
            'nama_kegiatan' => 'required',
        ]);

        if($validator->fails()){
            return back()->with('error',$validator->messages()->all()[0])->withErrors($validator)->withInput();
        }

        try {
            $st = new SuratTugas;
            $st->nomor_surat_tugas = $request->nomor_surat_tugas;
            $st->nama_kegiatan = $request->nama_kegiatan;
            $st->tanggal_kegiatan = $request->tanggal_kegiatan;
            $st->kode_upbjj = Auth::user()->kode_upbjj;
            $st->penanda_tangan = Auth::user()->nip_atasan;
            $st->user_create = Auth::user()->name;
            $st->save();

            return redirect()->route('surattugas.addpegawai',base64_encode($st->id))
                        ->with('success', 'Surat Tugas Lembur berhasil di buat, Silahkan tambahkan pegawai yang bertugas');

        } catch (\Exception $exception) {
            return redirect()->back()
                ->with('error', $exception->getMessage());
        }
    }

    public function addpegawai($id)
    {
        $st = SuratTugas::findOrfail(base64_decode($id));

        $pegawais = User::where('kode_upbjj', Auth::user()->kode_upbjj)->orderBy('name', 'ASC')->get();

        $stdetail = SuratTugasDetail::where('nomor_surat_tugas', $st->nomor_surat_tugas)->get();

        return view('surattugas.addpegawai', compact('st','pegawais', 'stdetail'));
    }

    public function simpanaddpegawai(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'data' => 'required',
        ]);

        if($validator->fails()){
            return back()->with('error',$validator->messages()->all()[0])->withErrors($validator)->withInput();
        }

        $st = SuratTugas::find($id);
        
        $cektanggal = SuratTugasDetail::where('tanggal_kegiatan',$st->tanggal_kegiatan)->where('nip',json_decode($request->data)->nip)->count();

        if($cektanggal > 0 ){
            return back()->with('error',''.json_decode($request->data)->name.' sudah ditugaskan pada tanggal '.$st->tanggal_kegiatan.'');
        }else{
            $stdetail = new SuratTugasDetail;
            $stdetail->kode_upbjj = $st->kode_upbjj;
            $stdetail->nomor_surat_tugas = $st->nomor_surat_tugas;
            $stdetail->nip = json_decode($request->data)->nip;
            $stdetail->tanggal_kegiatan = $st->tanggal_kegiatan;
            $stdetail->user_create = Auth::user()->name;
            $stdetail->save();

            return redirect()->route('surattugas.addpegawai',base64_encode($st->id))
                            ->with('success', 'Pegawai berhasil ditugaskan'); 
        }     
        
    }

    public function deletepegawai($id)
    {
        if($id){
            $stdetail= SuratTugasDetail::find($id);
            $stdetail->delete();

            return redirect()->back()
                        ->with('success', 'Pegawai berhasil dibatalkan tugas');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
