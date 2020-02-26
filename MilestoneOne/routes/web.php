<?php

/*
 * |--------------------------------------------------------------------------
 * | Web Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register web routes for your application. These
 * | routes are loaded by the RouteServiceProvider within a group which
 * | contains the "web" middleware group. Now create something great!
 * |
 */
Route::get('/', function ()
{
    return view('welcome');
});

// Routes to the login page view.
Route::get('/welcome', function ()
{
    return view('login.login');
});

// Routes to the registration page view.
Route::get('/registration', function ()
{
    return view('registration.registration');
});

// Routes to the registerstatus page view.
Route::get('/registerstatus', function ()
{
    return view('registration.registerstatus');
});

Route::get('/home', function ()
{
    return view('home.home');
});

/* ------------- Get History Routes -------------- */
Route::get('/addJobHistory', function ()
{
    return view('portfolio.addJobHistory');
});

Route::get('/addEducationHistory', function ()
{
    return view('portfolio.addEducation');
});

Route::get('/addSkillHistory', function ()
{
    return view('portfolio.addSkill');
});
/* ------------------------------------------------ */


Route::post('/users', 'UserController@onUsersPull');

// Routes to the controller method onLogin from login page after entering credentials.
Route::post('/login', 'UserController@onLogin');

// Routes to the controller method onRegister from Registration page after entering credentials.
Route::post('/register', 'UserController@onRegister');

Route::post('/userEdit', 'UserController@onEdit');

Route::post('/adminEdit', 'AdminController@onEdit');

Route::post('/adminDelete', 'AdminController@onRemoval');

Route::post('/adminSuspend', 'AdminController@onSuspension');

Route::post('/viewProfile', 'UserController@onNavigate');

// Certain values had to be passed from the previous view. 
Route::get('/displayUsers', 'AdminController@onUsersPull');

Route::get('/profile', 'UserController@onProfile');

/* ------------------- Portfolio Add Routes ---------------------- */
Route::post('/addJob', 'PortfolioController@onAddWorkExperience');

Route::post('/addEducation', 'PortfolioController@onAddEducation');

Route::post('/addSkill', 'PortfolioController@onAddSkill');

/* ------------------- Portfolio Delete Routes -------------------- */
Route::post('/userJobDelete', 'PortfolioController@onJobRemoval');

Route::post('/userSkillDelete', 'PortfolioController@onSkillRemoval');

Route::post('/userEducationDelete', 'PortfolioController@onEducationRemoval');

/* -------------------- Portfolio Edit Routes --------------------- */
Route::post('/userRouteJobEdit', 'PortfolioController@onRouteJobEdit');

Route::post('/userRouteSkillEdit', 'PortfolioController@onRouteSkillEdit');

Route::post('/userRouteEducationEdit', 'PortfolioController@onRouteEducationEdit');

Route::post('/editJob', 'PortfolioController@onJobEdit');

Route::post('/editEducation', 'PortfolioController@onEducationEdit');

Route::post('/editSkill', 'PortfolioController@onSkillEdit');

/* ---------------------- Portfolio Personal Routes ----------------------- */
Route::get('/myportfolio', 'PortfolioController@onPersonalPortfolioRetrieval');

/* ---------------------- Admin Job Posting Routes ------------------------ */
// Route to view all jobs available: 
Route::get('/viewJobs', 'AdminController@onViewJobList');

// Route to Add a Job: 
Route::post('/jobPost', function()
{
    return view('job.addJobForm');
});

Route::post('/addJobPost', 'AdminController@onJobAddition');