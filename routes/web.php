<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\SuratTugasController;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes(['verify' => true]);


Route::middleware('auth')->group(function(){

	Route::get('/', 'LemburController@create')->name('create');
	Route::get('home','HomeController@index')->name('home');
	Route::resource('lembur', 'LemburController');
	Route::get('/editlembur', 'LemburController@editshow')->name('lembur.editshow');
	Route::get('/editlembur/{id}', 'LemburController@editlembur')->name('lembur.editlembur');
	Route::post('/LemburUpdate/{id}', 'LemburController@updatelembur');
	Route::get('/ImportLembur', 'LemburController@importlemburindex');
	Route::post('/ImportLemburX', 'LemburController@importlembur');
	Route::post('/lembur/search', 'LemburController@search');
	Route::get('/lembur/{id}/print', 'LemburController@cetak');
	Route::get('/RekapLembur', 'LemburController@peragaanuser');
	Route::get('peragaan-lembur-upbjj', 'LemburController@peragaanupbjj');
	Route::get('rekap-lembur-pegawai', 'LemburController@laporan');
	Route::get('rekap-lembur-pegawai/{id}', 'LemburController@validasi')->name('lembur.validasi');
	Route::get('rekap-lembur-pegawai/gagal/{id}', 'LemburController@gagalvalidasi')->name('lembur.gagalvalidasi');
	Route::get('/excel', 'LemburController@export');
	Route::get('/MasterEditLembur','LemburController@mlemburindex');
	Route::post('/MasterEditLembur/search','LemburController@mlemburindexsearch');
	Route::get('/MasterEditLembur/{id}', 'LemburController@masteredit');
	Route::get('/RagaValidasi','LemburController@ragaindex');
	Route::post('/RagaValidasi/search','LemburController@ragaindexsearch');

	Route::resource('user', 'UserController');
	Route::get('/user/{id}/mXaD', 'UserController@edit');
	Route::post('/userupdate/{id}', 'UserController@updateuser');
	Route::get('/ChangePasswordUserApp/{id}', 'UserController@userchange');
	Route::post('/ChangePasswordUserAppUpdated/{id}', 'UserController@changeupdateuser');

	Route::resource('upbjj', 'UPBJJController');
	Route::get('UpbjjUpdatedX/{id}', 'UPBJJController@edit');
	Route::post('UpbjjUpdated/{id}', 'UPBJJController@updatex');

	Route::resource('surattugas', 'SuratTugasController');
	Route::get('surattugas/addpegawai/{id}', 'SuratTugasController@addpegawai')->name('surattugas.addpegawai');
	Route::post('surattugas/addpegawai/{id}', 'SuratTugasController@simpanaddpegawai')->name('surattugas.simpanaddpegawai');
	Route::get('surattugas/updatestatusst/{id}', 'SuratTugasController@updatestatusst')->name('surattugas.updatestatusst');
	Route::get('surattugas/deletepegawai/{id}', 'SuratTugasController@deletepegawai')->name('surattugas.deletepegawai');
	Route::get('surattugas/cetak/{id}', 'SuratTugasController@cetak')->name('surattugas.cetak');

	Route::group(['prefix'=>'study'], function(){
		Route::get('form', 'PendidikanController@form')->name('study.form');
		Route::get('/form/{id}', 'PendidikanController@formedit')->name('study.formedit');
		Route::get('/hapus/{id}', 'PendidikanController@hapus')->name('study.hapus');
		Route::post('/form/simpan', 'PendidikanController@simpan');
		Route::post('/form/update/{id}', 'PendidikanController@update');
	});

	Route::group(['prefix'=>'jobs'], function(){
		Route::get('form', 'PekerjaanController@form')->name('jobs.form');
		Route::get('/form/{id}', 'PekerjaanController@formedit')->name('jobs.formedit');
		Route::get('/hapus/{id}', 'PekerjaanController@hapus')->name('jobs.hapus');
		Route::post('/form/simpan', 'PekerjaanController@simpan');
		Route::post('/form/update/{id}', 'PekerjaanController@update');

	});

	Route::group(['prefix'=>'sdm'], function(){
		Route::get('form', 'SDMController@form')->name('sdm.form');
		Route::get('/form/{id}', 'SDMController@formedit')->name('sdm.formedit');
		Route::get('/hapus/{id}', 'SDMController@hapus')->name('sdm.hapus');
		Route::post('/form/simpan', 'SDMController@simpan');
		Route::post('/form/update/{id}', 'SDMController@update');
		Route::get('peragaan-data-pribadi','SDMController@peragaan')->name('sdm.peragaan');
		Route::get('/cetak', 'SDMController@cetak');
	});

});
