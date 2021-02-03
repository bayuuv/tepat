<?php

use Illuminate\Support\Facades\Route;


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

// tampilan frontend
Route::get('/', 'OrganisasiController@index');

Route::get('/kontak', 'OrganisasiController@kontak');

Route::get('/cek-status', 'OrganisasiController@status');

Route::get('detail-video/{id_galeri}/{slug}','OrganisasiController@detail_video');

Route::prefix('berita')->group(function(){

    Route::get('/', 'OrganisasiController@berita');

    Route::get('detail-berita/{id_berita}/{slug}','OrganisasiController@detailBerita');

});

Route::prefix('galeri-foto')->group(function(){

    Route::get('/', 'OrganisasiController@galeri_foto');

    Route::get('detail-foto/{id_galeri}/{slug}','OrganisasiController@detail_foto');

});

Route::prefix('struktur')->group(function(){
    
    Route::get('/', 'OrganisasiController@struktur');
    
    Route::get('pilih_kesatu/{id_level}', 'OrganisasiController@pilihKesatu');
    
    Route::get('dpc/{id_dpc}', 'OrganisasiController@strukturDPC');
    
    Route::get('/level/{id_level}/wil/{id_wil}', 'OrganisasiController@strukturPac');

    Route::get('/level/{id_level}/wil/{id_wil}/pac/{id_pac}', 'OrganisasiController@strukturPacWil');
    
});

// akhir frontend

Route::get('logout', 'LoginController@logout');

Route::prefix('login')->group(function(){
    
    Route::get('/', 'LoginController@index');

    Route::post('/login-process', 'LoginController@loginProcess');

});

Route::get('dashboard', 'DashboardController@index');

Route::get('dashboard/change-password', 'ChangePasswordController@index');

Route::post('dashboard/update-password', 'ChangePasswordController@update');

Route::prefix('dpp')->group(function(){

    Route::get('/', 'DppController@index');

    Route::get('add', 'DppController@add');
   
    Route::post('store', 'DppController@store');

    Route::get('edit/{id_dewan}', 'DppController@edit');

    Route::post('update', 'DppController@update');

    Route::delete('delete/{id_dewan}', 'DppController@delete');

});

Route::prefix('dpc')->group(function(){

    Route::get('/', 'DpcController@index');
    
    Route::get('add', 'DpcController@add');
   
    Route::post('store', 'DpcController@store');

    Route::get('edit/{id_dewan}', 'DpcController@edit');

    Route::post('update', 'DpcController@update');

    Route::delete('delete/{id_dewan}', 'DpcController@delete');

});

Route::prefix('pac')->group(function(){

    Route::get('/', 'PacController@index');

    Route::get('add', 'PacController@add');
   
    Route::post('store', 'PacController@store');

    Route::get('edit/{id_pac}', 'PacController@edit');

    Route::post('update', 'PacController@update');

    Route::delete('delete/{id_pac}', 'PacController@delete');
    
    Route::get('sortir-dpc/{id_dewan}', 'PacController@sortirDPC');
});

Route::prefix('jabatan')->group(function(){

    Route::get('/', 'JabatanController@index');
   
    Route::get('add', 'JabatanController@add');

    Route::post('store', 'JabatanController@store');

    Route::get('edit/{id_jabatan}', 'JabatanController@edit');

    Route::post('update', 'JabatanController@update');

    Route::delete('delete/{id_jabatan}', 'JabatanController@delete');

});

Route::prefix('sub-jabatan')->group(function(){

    Route::get('/', 'SubJabatanController@index');
   
    Route::get('add', 'SubJabatanController@add');

    Route::post('store', 'SubJabatanController@store');

    Route::get('edit/{id_sub_jabatan}', 'SubJabatanController@edit');

    Route::post('update', 'SubJabatanController@update');

    Route::delete('delete/{id_sub_jabatan}', 'SubJabatanController@delete');

});

Route::prefix('pengurus')->group(function(){
   
    // Route::post('fetch', 'PengurusController@fetch');

    Route::get('get-anggota/{no_anggota}', 'PengurusController@getAnggota');

    Route::get('dpp', 'PengurusController@dpp');

    Route::get('add-dpp', 'PengurusController@dpp_add');

    Route::get('edit-dpp/{no_anggota}', 'PengurusController@dpp_edit');
    
    Route::post('update-dpp', 'PengurusController@dppStore');
    
    Route::get('delete-dpp/{no_anggota}', 'PengurusController@dppDelete');
    
    Route::post('dpp/store', 'PengurusController@dppStore');

    Route::get('dpc', 'PengurusController@dpc');

    Route::get('add-dpc', 'PengurusController@dpc_add');

    Route::get('edit-dpc/{no_anggota}', 'PengurusController@dpc_edit');
    
    Route::post('update-dpc', 'PengurusController@dpcStore');
    
    Route::get('delete-dpc/{no_anggota}', 'PengurusController@dpcDelete');
    
    Route::post('dpc/store', 'PengurusController@dpcStore');

    Route::get('dpc/wil/{wil}', 'PengurusController@dpcWil');

    Route::get('pac', 'PengurusController@pac');

    Route::get('add-pac', 'PengurusController@pac_add');
    
    Route::post('pac/store', 'PengurusController@pacStore');

    Route::get('edit-pac/{no_anggota}', 'PengurusController@pac_edit');
    
    Route::post('update-pac', 'PengurusController@pacStore');
    
    Route::get('delete-pac/{no_anggota}', 'PengurusController@pacDelete');

    Route::get('pac/wil/{wil}', 'PengurusController@pacWil');

    Route::get('pac/wil/{wil}/unit/{un}', 'PengurusController@pacWilUnit');
    

});

Route::prefix('anggota')->group(function(){

    Route::get('/', 'AnggotaController@index');
    //edit by @bayuuv
    Route::post('/getList', 'AnggotaController@getList');

    Route::get('add', 'AnggotaController@add');
    
    Route::post('store', 'AnggotaController@store');
    
    Route::get('edit/{no_anggota}', 'AnggotaController@edit');
    
    Route::post('update', 'AnggotaController@update');
    
    Route::delete('delete/{no_anggota}/{foto}/{ktp}', 'AnggotaController@delete');
    
    Route::get('update-active/{no_anggota}', 'AnggotaController@updateActive');

    Route::get('update-non-active/{no_anggota}', 'AnggotaController@updateDeadActive');

    Route::get('export_excel/{pilih_kesatu?}/{pilih_kedua?}', 'AnggotaController@exportExcel');
    
    Route::get('get/{sortir_anggota}', 'AnggotaController@sortirAnggota');
    
    Route::get('pilih_kesatu/{id_level}', 'AnggotaController@pilihKesatu');
    
    Route::get('dpc/{id_dpc}', 'AnggotaController@anggotaDPC');
    
    Route::get('pac/{id_pac}', 'AnggotaController@anggotaPac');
    
    Route::get('view_pdf/{no_anggota}', 'AnggotaController@viewPdf');
    
    Route::get('download-one-pdf/{no_anggota}', 'AnggotaController@downloadOnePdf');
    
    Route::get('download-pdf/{pilih_kesatu?}/{pilih_kedua?}', 'AnggotaController@downloadPDF');

    Route::get('pilihYayasan', 'AnggotaController@pilihYayasan');
    
    Route::get('wilayah/{id}', 'AnggotaController@wilayah');

    Route::get('unit/{id}', 'AnggotaController@unit');
    
    Route::get('unitwilayah/', 'AnggotaController@unitwilayah');

    Route::get('wil/{wil}', 'AnggotaController@wil');

    Route::get('wil2/{wil}', 'AnggotaController@wil2');

});

Route::prefix('setting-pages/web-profile')->group(function(){

    Route::get('/', 'WebProfileController@index');

    Route::post('update', 'WebProfileController@update');

    Route::get('informasi-web', 'WebProfileController@informasiWeb');
    
    Route::post('informasi-web/update', 'WebProfileController@informasiWebUpdate');

});

Route::prefix('setting-pages/galeri')->group(function(){

    Route::get('/', 'GaleriController@index');

    Route::get('add', 'GaleriController@add');

    Route::post('store', 'GaleriController@store');    

    Route::get('edit/{id_galeri}', 'GaleriController@edit');

    Route::post('update', 'GaleriController@update');

    Route::delete('delete/{id_galeri}/{cover}', 'GaleriController@delete');

});

Route::prefix('setting-pages/berita')->group(function(){

    Route::get('/', 'BeritaController@index');

    Route::get('add', 'BeritaController@add');

    Route::post('store', 'BeritaController@store');    

    Route::get('edit/{id_berita}', 'BeritaController@edit');

    Route::post('update', 'BeritaController@update');

    Route::delete('delete/{id_berita}/{gambar}', 'BeritaController@delete');

});

Route::prefix('setting-pages/banner')->group(function(){

    Route::get('/', 'BannerController@index');

    Route::get('add', 'BannerController@add');

    Route::post('store', 'BannerController@store');    

    Route::get('edit/{id_banner}', 'BannerController@edit');

    Route::post('update', 'BannerController@update');

    Route::delete('delete/{id_banner}/{gambar}', 'BannerController@delete');

});
