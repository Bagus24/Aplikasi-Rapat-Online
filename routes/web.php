<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('/email', function () {
    return view('pesanemail');
});

// Routes Users

Auth::routes();
// Auth::routes(['verify' => true]);
// Route::view('/home', 'home')->middleware('auth');
Route::get('/home', 'HomeController@index')->name('home');


//laporan perbulan
Route::resource('laporan-perbulan', 'LaporanPerbulanController');
Route::get('laporanperbulan/cari', 'LaporanPerbulanController@show');
Route::get('carilaporanperbulan', 'LaporanPerbulanController@cari');

//laporan pertahun
Route::resource('laporan-pertahun', 'LaporanPertahunController');
Route::get('laporanpertahun/cari', 'LaporanPertahunController@show');
Route::get('carilaporanpertahun', 'LaporanPertahunController@cari');

// Akun Peserta
Route::resource('akun', 'AkunPesertaController');

// Profil Peserta
Route::resource('profil', 'ProfilController');
Route::post('profil/update-foto/{id}', 'ProfilController@editFoto');

// Agenda Rapat
Route::resource('agenda-rapat', 'AgendaPesertaController');

// Ruangan Rapat
Route::resource('ruangan-rapat', 'RuanganPesertaController');
Route::get('ruangan-rapat/cari', 'RuanganPesertaController@show');

// WEBRTC
Route::get('room/join/{kode}', 'RuanganPesertaController@joinRoom');
Route::get('messages', 'RuanganPesertaController@fetchMessages');
Route::post('messages', 'RuanganPesertaController@sendMessage');

// Notula
Route::resource('notula-rapat', 'NotulaPesertaController');
Route::get('notula-rapat/cari', 'NotulaPesertaController@show');
Route::get('cetak-notula/{id}', 'NotulaPesertaController@cetak');

Route::resource('notifikasi', 'NotifikasiController');






// Routes Admin

// Route::get('/home', 'HomeController@index')->name('home');
Route::get('/login/admin', 'Auth\LoginController@showAdminLoginForm');
// Route::get('/register/admin', 'Auth\RegisterController@showAdminRegisterForm');
Route::post('/login/admin', 'Auth\LoginController@adminLogin')->name('login.admin');;
// Route::post('/register/admin', 'Auth\RegisterController@createAdmin');
Route::view('/admin', 'admin.welcome');
Route::view('/home/admin', 'admin.home');

// Akun Controller
Route::resource('akun-peserta', 'AkunController');
Route::get('akun-peserta/cari', 'AkunController@show');
Route::post('akun-peserta/reset/{id}', 'AkunController@reset');

// Data Peserta
Route::resource('peserta', 'PesertaController');
Route::post('peserta/update-foto/{id}', 'PesertaController@editFoto');
Route::get('peserta/cari', 'PesertaController@show');

// Ruangan
Route::resource('ruangan', 'RuanganController');
Route::get('ruangan/cari', 'RuanganController@show');

// Jenis Rapat
// Route::resource('jenisrapat', 'JenisrapatController');
// Route::get('jenisrapat/cari', 'JenisrapatController@show');

// Agenda
Route::resource('agenda', 'AgendaController');
Route::get('agenda/cari', 'AgendaController@show');


// Akun Admin
Route::resource('akun-admin', 'AdminController');
Route::post('akun-admin/katasandi/{id}', 'AdminController@gantiKatasandi');

//notula
Route::resource('notula', 'NotulaController');
Route::get('notula/cari', 'NotulaController@show');
Route::get('notula-cetak/{id}', 'NotulaController@cetak');

// Laporan
// Route::get('cetaklaporan', 'CetaklaporanController@cetak');

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});













