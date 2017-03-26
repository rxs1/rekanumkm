<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welco	$route['default_controlletez/$12';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['user/common_user/akuntansi/(:num)'] = 'user/common_user/akuntansi/allJurnal/$1';

$route['user/common_user/bukubesar/(:num)'] = 'user/common_user/bukubesar/semuaBukubesar/$1';
//---AJAX PROSES HTML---//


//---Jurnal Pembelian---//
$route['user/common_user/akuntansi/jurnal_pembelian/(:num)/(:num)'] = 'user/common_user/akuntansi/jurnalPembelian/$1/$2';
$route['user/common_user/akuntansi/tambahTransaksiJurnalPembelian/(:num)/(:num)'] = 'user/common_user/akuntansi/tambahTransaksiJurnalPembelian/$1/$2';
$route['user/common_user/akuntansi/editTransaksiJurnalPembelian/(:num)/(:num)/(:num)'] = 'user/common_user/akuntansi/editTransaksiJurnalPembelian/$1/$2/$3';
$route['user/common_user/akuntansi/jurnal_pembelian/hapus/(:num)'] = 'user/common_user/akuntansi/deleteJurnalPembelian/$1';

//---Jurnal Pengeluaran Kas---//
$route['user/common_user/akuntansi/jurnal_pengeluaran_kas/(:num)/(:num)'] = 'user/common_user/akuntansi/jurnalPengeluaranKas/$1/$2';
$route['user/common_user/akuntansi/tambahTransaksiJurnalPengeluaran/(:num)/(:num)'] = 'user/common_user/akuntansi/tambahTransaksiJurnalPengeluaran	/$1/$2';
$route['user/common_user/akuntansi/jurnal_pengeluaran_kas/hapus/(:num)'] = 'user/common_user/akuntansi/deleteJurnalPengeluaranKas/$1';




