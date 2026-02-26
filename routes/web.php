<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\beritaManakarra;
use App\Http\Controllers\plnMamuju;
Route::get('/', [beritaManakarra::class, 'getBerita']);
Route::get('/alertCustomer', [plnMamuju::class, 'alertCustomer']);
Route::get('/rating',[plnMamuju::class, 'scanQR'])->middleware('adminBlok');
Route::get('/alur/layanan',[plnMamuju::class, 'alurLayanan']);
Route::get('cetakqr/{id}',[plnMamuju::class, 'cetakQR'])->middleware('isAdmin');
Route::get('/download/pdf/{query} ',[plnMamuju::class, 'downloadPDF'])->middleware('isAdmin');
Route::get('rating/customer',[plnMamuju::class, 'addRating'])->middleware('adminBlok','cekRole');
Route::get('dashboard/admin',[plnMamuju::class, 'dashboardAdmin'])->middleware('isAdmin');
Route::post('rating/customer/simpan',[plnMamuju::class, 'submitRating'])->name('submit.rating')->middleware('cekRole');
Route::post('/cekrole',[plnMamuju::class, 'cekRole'])->name('cek.role');
Route::post('/buattoken',[plnMamuju::class, 'generateToken'])->name('generate.token')->middleware('adminBlok','cekRole');
Route::post('/buatkunjungan',[plnMamuju::class, 'createKunjungan'])->name('create.kunjungan')->middleware('adminBlok','cekRole');
Route::post('/buatakun/petugas',[plnMamuju::class, 'addPetugas'])->name('create.petugas');
Route::get('/filter/rating',[plnMamuju::class, 'filterRating'])->name('filter.rating')->middleware('isAdmin');
Route::get('/create/token/petugas',[plnMamuju::class, 'tokenPetugas'])->middleware('isAdmin');
Route::get('/pdfAlurLayanan/{id}',[plnMamuju::class, 'layanan']);
Route::get('/logout/admin',[plnMamuju::class, 'logOut']);
Route::get('/logout/petugas',[plnMamuju::class, 'logOutPetugas']);
Route::get('/berita/pln',[beritaManakarra::class, 'allBerita']);
Route::get('/search/berita/{search}',[beritaManakarra::class, 'searchBerita']);
Route::put('/update/wa/cs',[plnMamuju::class, 'updateCS'])->middleware('isAdmin');
Route::put('/update/petugas/pln',[plnMamuju::class, 'updatePetugas'])->middleware('isAdmin');
Route::delete('/delete/petugas',[plnMamuju::class, 'menghapusPetugas'])->middleware('isAdmin');