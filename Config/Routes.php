<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'EmployeeController::index', ['as' => 'dashboard']);
$routes->get('/login', 'LoginController::index', ['as' => 'login']);
$routes->post('/login', 'LoginController::store', ['as' => 'login.store']);
$routes->get('/login/destroy', 'LoginController::destroy', ['as' => 'login.destroy']);
$routes->get('/recoverypassword', 'PasswordController::index', ['as' => 'password.recovery']);
$routes->post('/recoverypassword', 'PasswordController::recovery', ['as' => 'password.store']);
$routes->get('/newpassword/(:segment)', 'PasswordController::new/$1', ['as' => 'password.new']);
$routes->post('/newpassword', 'PasswordController::store', ['as' => 'newpassword.store']);




//Employee
$routes->get('/employees/(:num)', 'EmployeeController::index/$1', ['as' => 'employee.list']);
$routes->get('/employees', 'EmployeeController::index', ['as' => 'employees']);
$routes->get('/employees/new', 'EmployeeController::create');
$routes->post('/employees/new', 'EmployeeController::store');


$routes->get('employee/view/(:any)', 'EmployeeController::view/$1');
$routes->post('employee/view/(:any)', 'EmployeeController::update/$1');


$routes->post('employee/imageupdt', 'EmployeeController::imageupdater');

$routes->get('matcher', 'MatcherController::index');
$routes->post('matcher', 'MatcherController::view');


$routes->get('jobroles/new', 'JobRoleController::create');
$routes->get('jobroles', 'JobRoleController::index');
$routes->post('jobroles/new', 'JobRoleController::store');
$routes->post('jobroles/new/questionarie', 'JobRoleController::store2');


$routes->get('recruitment/candidates(:num)', 'CandidateController::index/$1');
$routes->get('recruitment/candidates', 'CandidateController::index');

$routes->get('candidate/view/(:any)', 'CandidateController::view/$1');
$routes->post('candidate/view/(:any)', 'CandidateController::update/$1');


$routes->get('recruitment/vacancies(:num)', 'RecruitmentController::index/$1');
$routes->get('recruitment/vacancies', 'RecruitmentController::index', ['as' => 'vacancies']);

$routes->get('/vacancie/status/(:num)', 'RecruitmentController::changeStatus/$1');


$routes->get('recruitment/vacancies/new', 'RecruitmentController::create');
$routes->post('recruitment/vacancies/new', 'RecruitmentController::store');

$routes->get('jobroles/view/(:any)', 'JobRoleController::view/$1');
$routes->post('jobroles/view/(:any)', 'JobRoleController::update/$1');


$routes->get('department(:num)', 'DepartmentController::index/$1');
$routes->get('department', 'DepartmentController::index', ['as' => 'department']);



$routes->get('department/new', 'DepartmentController::create');
$routes->post('department/new/', 'DepartmentController::store');

$routes->get('department/view/(:any)', 'DepartmentController::view/$1');
$routes->post('department/view/(:any)', 'DepartmentController::update/$1');




$routes->get('reports/complete/(:any)', 'ReportController::completeview/$1');
$routes->get('reports/simplify/(:any)', 'ReportController::simplifyview/$1');


$routes->get('company', 'CompanyController::view');
$routes->post('dados/company', 'CompanyController::update');
$routes->post('settings/company', 'CompanyController::updatelp');

$routes->get('vacancie/edit/(:any)', 'RecruitmentController::view/$1');
$routes->post('vaga/filtered(:any)', 'RecruitmentController::vervaga/$1');
$routes->post('vaga/(:any)', 'RecruitmentController::update/$1');


$routes->get('vaga/(:any)', 'RecruitmentController::vervaga/$1');



$routes->get('person/status', 'EmployeeController::status');
$routes->get('person/type', 'EmployeeController::effective');

$routes->get('jobroles/questionarie/(:any)', 'JobRoleController::questionarie/$1');


$routes->post('check-slug', 'CompanyController::checkSlug');


$routes->post('person/toggleFavorite/(:segment)', 'CandidateController::toggleFavorite/$1');


$routes->get('treinamentos', 'CoursesController::index');


$routes->get('candidato/(:any)', 'CandidateController::vercandidato/$1');
$routes->post('candidato/(:any)', 'CandidateController::update/$1');
$routes->post('anotacoes', 'CandidateController::updatenote/$1');


$routes->post('update-step', 'RecruitmentController::updateStep');
$routes->post('update-classification', 'RecruitmentController::updateClassification');
$routes->post('recruitment/save_anotacao', 'RecruitmentController::updateNotes');

$routes->post('new-interview', 'RecruitmentController::newInterview');


$routes->get('loginasadmin/(:any)', 'AdminController::index/$1');


$routes->get('printcurriculo/(:any)', 'CandidateController::curriculo/$1');