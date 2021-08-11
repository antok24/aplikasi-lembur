<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Jabatan;
use App\Pejabat;
use App\Upbjj;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = User::where('kode_upbjj', Auth::user()->kode_upbjj)->get();
        return view('user.index', ['user' => $user]);
    }

    public function create()
    {
        $upbjj = Upbjj::where('kode_upbjj', Auth::user()->kode_upbjj)->get();
        $pejabat = Pejabat::where('status', 1)->where('kode_upbjj', Auth::user()->kode_upbjj)->get();

        return view('user.create', compact('upbjj', 'pejabat'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nip' => 'required|unique:users',
            'name' => 'required',
            'nip_atasan' => 'required',
            'kode_upbjj' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|string|min:6|confirmed'
        ]);

        if($validator->fails()){
            return back()->with('error',$validator->messages()->all()[0])->withErrors($validator)->withInput();
        }

        User::create([
            'nip' => $request->nip,
            'name' => $request->name,
            'nip_atasan' => $request->nip_atasan,
            'email' => $request->email,
            'kode_upbjj' => $request->kode_upbjj,
            'password' => bcrypt($request->password)
            ]);
        return redirect()->route('user.create')
                        ->with('success', 'User Baru berhasil dibuat');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $upbjj = Upbjj::get();
        $pejabat = Pejabat::where('status', 1)->where('kode_upbjj', Auth::user()->kode_upbjj)->get();
        $user = User::find(decrypt($id));

        return view('user.edit', compact('user','upbjj', 'pejabat'));
    }

    public function updateuser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nip' => 'required',
            'name' => 'required',
            'nip_atasan' => 'required',
            'kode_upbjj' => 'required',
            'email' => 'required',
        ]);

        if($validator->fails()){
            return back()->with('error',$validator->messages()->all()[0])->withErrors($validator)->withInput();
        }

        $user = User::find($request->id);
        $user->nip = $request->get('nip');
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->nip_atasan = $request->get('nip_atasan');
        $user->update();

        return redirect()->route('user.index')
                        ->with('success', 'Data berhasil di Update');
    }

    public function userchange($id)
    {
        $userlogin = Auth::user()->group;
        if($userlogin != 1 && $userlogin != 2 && $userlogin != 3 && $userlogin != 4 && $userlogin != 5 && $userlogin != 6 && $userlogin != 7 && $userlogin != 8 ){
            abort(404);
        }else{
            $user = User::find(decrypt($id));
            return view('password.edit', compact('user'));
        }
    }

    public function changeupdateuser(Request $request)
    {
        $userlogin = Auth::user()->group;
        if($userlogin != 1 && $userlogin != 2 && $userlogin != 3 && $userlogin != 4 && $userlogin != 5 && $userlogin != 6 && $userlogin != 7 && $userlogin != 8 ){
            abort(404);
        }else{
            date_default_timezone_set("Asia/Bangkok");
            $user = User::find($request->id);
            $user->nip = $request->get('nip');
            $user->name = $request->get('name');
            $user->email = $request->get('email');
            $user->password = bcrypt($request->get('password'));
            $user->save();
            return back()->with('success', 'User anda berhasil di update');
        }
    }

    public function destroy($id)
    {
        $userlogin = Auth::user()->group;
        if($userlogin != 1 && $userlogin != 2){
            abort(404);
        }else{
            $user = User::find($id);
            $user->delete();
            return redirect()->route('user.index')
                            ->with('success', 'User berhasil di hapus');
        }
    }
}
