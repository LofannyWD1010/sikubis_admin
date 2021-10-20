<?php

Route::redirect('/', '/login');

Route::redirect('/home', '/admin');

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    
    Route::get('/', 'HomeController@index')->name('home');

    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');

    Route::resource('permissions', 'PermissionsController');

    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');

    Route::resource('roles', 'RolesController');

    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');

    Route::resource('users', 'UsersController');

    Route::delete('products/destroy', 'ProductsController@massDestroy')->name('products.massDestroy');

    Route::resource('products', 'ProductsController');

    Route::delete('laporans/destroy', 'SipsController@massDestroy')->name('laporans.massDestroy');
    
    Route::resource('laporans', 'SipsController');

    Route::delete('pencairans/destroy', 'PencairanController@massDestroy')->name('pencairans.massDestroy');

    Route::patch('pencairans/update_saldo_cair/{id}', 'PencairanController@update_saldo_cair')->name('pencairans.update_saldo_cair');
    
    Route::resource('pencairans', 'PencairanController');

    Route::delete('pesanans/destroy', 'PesananController@massDestroy')->name('pesanans.massDestroy');
    
    Route::patch('pesanans/update_detail_pesanan/{id_pesanan}', 'PesananController@update_detail_pesanan')->name('pesanans.update_detail_pesanan');
    
    Route::resource('pesanans', 'PesananController');

    Route::delete('requests/destroy', 'RequestController@massDestroy')->name('requests.massDestroy');

    Route::patch('requests/update_request_penjual/{id_pengguna}', 'RequestController@update_request_penjual')->name('requests.update_request_penjual');
    
    Route::resource('requests', 'RequestController');

    Route::delete('transaksis/destroy', 'TransaksiController@massDestroy')->name('transaksis.massDestroy');
    
    Route::resource('transaksis', 'TransaksiController');

    Route::delete('akuns/destroy', 'AkunController@massDestroy')->name('akuns.massDestroy');
    
    Route::resource('akuns', 'AkunController');

    Route::delete('saldomasuks/destroy', 'SaldoMasukController@massDestroy')->name('saldomasuks.massDestroy');
    
    Route::resource('saldomasuks', 'SaldoMasukController');

    Route::delete('saldocairs/destroy', 'SaldoCairController@massDestroy')->name('saldocairs.massDestroy');
    
    Route::resource('saldocairs', 'SaldoCairController');

    Route::delete('keuntungans/destroy', 'KeuntunganController@massDestroy')->name('keuntungans.massDestroy');
    
    Route::resource('keuntungans', 'KeuntunganController');

    Route::delete('laporansikubiss/destroy', 'LaporanSikubisController@massDestroy')->name('laporansikubiss.massDestroy');
    
    Route::get('laporansikubiss/show_range', 'LaporanSikubisController@show_range')->name('laporansikubiss.show_range');
    
    Route::get('laporansikubiss/show_weekly', 'LaporanSikubisController@show_weekly')->name('laporansikubiss.show_weekly');
    
    Route::resource('laporansikubiss', 'LaporanSikubisController');

    Route::delete('laporanpemasukans/destroy', 'LaporanPemasukanController@massDestroy')->name('laporanpemasukans.massDestroy');

    Route::get('laporanpemasukans/show_range', 'LaporanPemasukanController@show_range')->name('laporanpemasukans.show_range');
    
    Route::get('laporanpemasukans/show_weekly', 'LaporanPemasukanController@show_weekly')->name('laporanpemasukans.show_weekly');
    
    Route::resource('laporanpemasukans', 'LaporanPemasukanController');

    Route::delete('laporanpengeluarans/destroy', 'LaporanPengeluaranController@massDestroy')->name('laporanpengeluarans.massDestroy');

    Route::get('laporanpengeluarans/show_range', 'LaporanPengeluaranController@show_range')->name('laporanpengeluarans.show_range');
    
    Route::get('laporanpengeluarans/show_weekly', 'LaporanPengeluaranController@show_weekly')->name('laporanpengeluarans.show_weekly');
    
    Route::resource('laporanpengeluarans', 'LaporanPengeluaranController');

    Route::delete('fakultass/destroy', 'FakultasController@massDestroy')->name('fakultass.massDestroy');

    Route::resource('fakultass', 'FakultasController');

    Route::get('/jurusan/create/{fakultas}', 'JurusanController@createJurusan');

    Route::delete('jurusans/destroy', 'JurusanController@massDestroy')->name('jurusans.massDestroy');
    
    Route::resource('jurusans', 'JurusanController');

    Route::get('/civitasakademika/create/{jurusan}', 'CivitasAkademikaController@createCivitas');

    Route::delete('civitasakademikas/destroy', 'CivitasAkademikaController@massDestroy')->name('civitasakademikas.massDestroy');
    
    Route::resource('civitasakademikas', 'CivitasAkademikaController');

});
