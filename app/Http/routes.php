<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*Route::get('/apakabar/{$nama}', function($nama) {
    
    return 'Hallo.. apakabar'.$nama;

});*/

Route::get('halaman_view', function(){
	$data = array(
		'var1' => 'Sepatu',
		'var2' => 'Sandal',
		'var3' => 'Kaos kaki',
		'transaksi' => App\Transaksi::all()
	);
	return view('halaman_view',$data);

});


Route::get('pelanggan/{id}', 'PelangganController@Pelanggan');

Route::get('nama_pelanggan', function () {
	$pelanggan = App\Pelanggan::where('nama','=','Adam')->first();
	echo '<pre>';
	echo $pelanggan->id;
});

Route::get('transaksi',function () {

	$transaksix = App\Transaksi::all();
	foreach ($transaksix as $barang) {
		//$pelanggan = App\Pelanggan::find($barang->id_pelanggan);
		echo $barang->nama." Order by ".$barang->transaksi->nama."<br/>";
	}
});

Route::get('apakabar', function() {
    
    return 'Hallo.. apakabar';

});

Route::get('apakabar/{nama}', function($nama) {
    
    return 'Hallo.. apakabar '.$nama;

});

Route::post('test', function(){
	echo 'POST';
});

Route::get('test', function(){
	echo '<form method="POST" action="test">';
	echo '<input type="submit" value="KIRIM">';
	echo '<input type="hidden" value="DELETE" name="_method">';
	echo '</form>';
});

Route::put('test', function(){
	echo 'PUT';
});

Route::delete('test', function(){
	echo 'DELETE';
});

Route::group(['middleware' => ['web']], function()    
{
	Route::auth(); //ini route instant isinya banyak route untuk kebutuhan auth
	Route::get('/', array('as'=>'admin', 'uses'=> 'AdminController@index'));

});

//Route as admin
Route::group(['middleware' => ['web','auth','level:1']], function()    
{
	
    /*Route::get('/cobamiddleware',  function () {
    	return 'Hallo.. saya punya akses untuk route ini';
	});*/
	
	
	Route::get('/jurusan',array('as'=>'jurusan', 'uses'=> 'Jurusan\JurusanController@index'));
    Route::get('/jurusan/{id}/hapus', array('as'=>'jurusan', 'uses'=> 'Jurusan\JurusanController@hapus'));

	Route::get('/prodi',array('as'=>'prodi', 'uses'=> 'Prodi\ProdiController@index'));
	Route::get('/prodi/{id}/hapus', array('as'=>'prodi', 'uses'=> 'Prodi\ProdiController@hapus'));
	Route::post('/prodi/tambah', array('as'=>'prodi.tambah', 'uses'=> 'Prodi\ProdiController@tambahprodi'));
	Route::get('/prodi/{id}/edit', array('as'=>'prodi.edit', 'uses'=> 'Prodi\ProdiController@editprodi'));
	Route::put('/prodi/{id}/simpanedit', array('as'=>'prodi.simpanedit', 'uses'=> 'Prodi\ProdiController@simpanedit'));

	//jurusan
	Route::get('/jurusan/tambah', array('as'=>'jurusan.tambah', 'uses'=> 'Jurusan\JurusanController@tambah'));
	Route::post('/jurusan/tambahjurusan', array('as'=>'jurusan.tambah.simpan', 'uses'=> 'Jurusan\JurusanController@tambahjurusan'));
	Route::get('/jurusan/{id}/hapus', array('as'=>'jurusan.hapus', 'uses'=> 'Jurusan\JurusanController@hapus'));

});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

/*Route::group(['middleware' => 'web'], function () {
    Route::auth();
	
    //Route::get('/home', 'HomeController@index');
    //

});
*/

