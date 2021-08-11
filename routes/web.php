<?php


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
	Route::get('editlembur/delete/{id}', 'LemburController@deletelembur')->name('lembur.deletelembur');
	
	Route::get('/lembur-tervalidasi', 'LemburController@formsearch')->name('tervalidasi.form');
	Route::get('/lembur-tervalidasi/search', 'LemburController@search')->name('tervalidasi.search');

	Route::get('/rekaplembur', 'LemburController@peragaanuser')->name('lembur.rekap');
	Route::get('rekap-lembur-pegawai', 'LemburController@laporan');
	Route::get('rekap-lembur-pegawai/{id}', 'LemburController@validasi')->name('lembur.validasi');
	Route::get('rekap-lembur-pegawai/gagal/{id}', 'LemburController@gagalvalidasi')->name('lembur.gagalvalidasi');
	Route::get('peragaan-lembur', 'LemburController@peragaan')->name('lembur.peragaan');
	Route::post('peragaan-lembur', 'LemburController@peragaanlembur')->name('lembur.peragaanlembur');

	Route::get('/MasterEditLembur','LemburController@mlemburindex')->name('mastereditlembur');
	Route::get('/MasterEditLembur/search','LemburController@mlemburindexsearch')->name('mastereditlembur.cari');
	Route::get('/lembur/batalvalidasi/{id}', 'LemburController@batalvalidasi')->name('lembur.batalvalidasi');

	Route::get('/lembur/print/{id}', 'LemburController@cetak')->name('lembur.print');

	Route::resource('user', 'UserController');
	Route::get('/user/{id}/mXaD', 'UserController@edit');
	Route::post('/userupdate/{id}', 'UserController@updateuser');
	Route::get('/ChangePasswordUserApp/{id}', 'UserController@userchange');
	Route::post('/ChangePasswordUserAppUpdated/{id}', 'UserController@changeupdateuser');

	Route::get('pejabat', 'PejabatController@index')->name('pejabat');
	Route::post('pejabat/simpan', 'PejabatController@simpan')->name('pejabat.simpan');
	Route::get('pejabat/hapus/{id}', 'PejabatController@delete')->name('pejabat.delete');

	Route::get('upbjj', 'UPBJJController@index')->name('upbjj.index');
	Route::get('upbjj/create', 'UPBJJController@create')->name('upbjj.create');
	Route::post('upbjj/simpan', 'UPBJJController@simpan')->name('upbjj.simpan');
	Route::get('upbjj/{id}', 'UPBJJController@edit')->name('upbjj.edit');
	Route::post('upbjj/{id}', 'UPBJJController@update')->name('upbjj.update');
	Route::post('UpbjjUpdated/{id}', 'UPBJJController@updatex');

	Route::resource('surattugas', 'SuratTugasController');
	Route::get('surattugas/addpetugas/{id}', 'SuratTugasController@addpegawai')->name('surattugas.addpegawai');
	Route::get('surattugas/showpetugas/{id}', 'SuratTugasController@showpetugas')->name('surattugas.showpetugas');
	Route::post('surattugas/addpetugas/{id}', 'SuratTugasController@simpanaddpegawai')->name('surattugas.simpanaddpegawai');
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
