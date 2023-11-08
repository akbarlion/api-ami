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
|	https://codeigniter.com/userguide3/general/routing.html
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
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//ADD YOUR ROUTES
// $route['api/master/user_all'] = 'Master/user_all';
$route['api/master/branch'] = 'Audit/divisi_lab';
$route['api/master/departemen'] = 'Audit/departemen';
$route['api/master/status'] = 'Audit/status';
$route['api/master/approval-get'] = 'Audit/approval';
$route['api/master/approval-by-id'] = 'Audit/detail_id';

$route['api/master/event'] = 'Audit/event';
$route['api/master/employee'] = 'Audit/employee';
$route['api/master/add-event'] = 'Audit/add_event';
$route['api/master/select-auditor'] = 'Audit/select_auditor';
$route['api/master/select-auditee'] = 'Audit/select_auditee';
$route['api/master/add-audit'] = 'Audit/add_audit';
$route['api/master/select-audit'] = 'Audit/record_audit';
$route['api/master/add-auditee'] = 'Audit/auditee';
$route['api/master/auditee-file'] = 'Audit/auditee_file';
$route['api/master/preview-file'] = 'Audit/preview';
$route['api/master/approve'] = 'Audit/approve';
$route['api/master/reject'] = 'Audit/reject';
$route['api/master/download'] = 'Audit/download_document';
