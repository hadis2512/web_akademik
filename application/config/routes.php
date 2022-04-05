<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
|	$route['default_controller'] = 'welcome';
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
$route['default_controller'] = 'login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
// Admin Page
$route['admin-login'] = 'superadmin/Login/index';
$route['admin-home'] = 'superadmin/Login/home';
$route['admin-add-mahasiswa'] = 'superadmin/Master_data/add_mahasiswa';
$route['admin-add-dosen'] = 'superadmin/Master_data/add_karyawan';
$route['admin-data-mahasiswa'] = 'superadmin/master_data/data_mahasiswa';
$route['admin-data-dosen'] = 'superadmin/master_data/data_karyawan';
$route['admin-data-formulir'] = 'superadmin/master_data/data_formulir';
// end Admin Page

// User Page
$route['login'] = 'user/u_auth/index';
$route['Login'] = 'user/u_auth/index';
// Mahasiswa
$route['Mahasiswa-home'] = 'user/User/Mahasiswa';
$route['Pengajuan-Form'] = 'user/User/Pengajuan_form';
$route['createSurat/(:any)'] = 'user/User/Create_surat/$1';
$route['Buat-Surat/(:any)'] = 'user/User/Buat_surat/$1';

// end Mahasiswa
$route['Dosen-home'] = 'user/User/Dosen';
$route['Pengajuan-Form-Dosen'] = 'user/User/Pengajuan_form_dosen';
// end User Page
