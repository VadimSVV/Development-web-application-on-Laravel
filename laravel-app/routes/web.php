<?php

use Illuminate\Support\Facades\Route;

//---------------------------------------------------------------------
Auth::routes();
Route::get('/home', 'HomeController@index');
//ajax
Route::post('ajax', 'AjaxController@postIndex');
Route::post('/ajax/public/{id}/', 'Ajax\MenuController@postPublics');
Route::post('ajax/showCatalog', 'AjaxController@postCatalog');
Route::post('ajax/showArticle', 'AjaxController@postArticle');
Route::post('/ajax/addAnswer', 'AjaxController@postAnswer');
Route::post('/ajax/register', 'Ajax\MenuController@postRegister');
Route::post('/ajax/common/{id}/{into}', 'Ajax\MenuController@postCommon');
Route::group(['middleware' => ['auth']], function () {
Route::get('/delete/{id}', 'PublicController@getPublicDelete');
//for student
Route::get('work/delete/{id}','Student\CourseController@getDelete');
Route::get('work/edit/{id}','Student\CourseController@getEdit');
Route::get('lab/delete/{id}','Student\LabController@getDelete');
Route::post('lab/edit/{id}','Student\LabController@postEdit')->middleware('teacher');
Route::post('student/work/','Ajax\StudentController@postWork');
Route::post('student/work/edit/{id}','Student\CourseController@postEdit');
Route::post('/course/into/{id?}', 'Student\CourseController@postInto');
Route::post('addCourse', 'Student\CourseController@addCourse');
// for user
Route::get('home/edit', 'HomeController@edit');
Route::get('home/edit/{id}','HomeController@getOne');
Route::get('home/projects', 'Auth\ProjectController@getIndex');
Route::get('home/students', 'Auth\GroupController@getGroups');
Route::get('/profile', 'Auth\ProfileController@getIndex');
Route::get('course/add/{cat_id}/{course_id}','Auth\CourseController@getAdd');
// ajax
Route::get('/home/ajax/group','Ajax\GrController@getIndex');
Route::post('/ajax/into/', 'Ajax\MenuController@postInto');
Route::post('/ajax/work/', 'Ajax\LabsController@postForm');
Route::post('/ajax/editArticle', 'AjaxController@postEditArticle');
Route::post('/ajax/editMaterial','AjaxController@postMaterial');
Route::post('/ajax/editCatalog', 'AjaxController@postEditCatalog');
Route::post('/ajax/addPublic', 'AjaxController@postPublic');
Route::post('/ajax/editCatalogStudent', 'Ajax\StudentController@postEditCatalog');
// post
Route::post('home/edit/{id}','HomeController@postOne');
Route::post('home/group/add', 'Auth\GroupController@postGroup');
Route::post('/profile', 'Auth\ProfileController@postIndex');
Route::post('home/project','Auth\ProjectController@postIndex');
Route::post('addCatalog/{catalog?}', 'FormController@addCatalog');
Route::post('addArticle', 'FormController@addArticle');
Route::post('editArticle', 'FormController@editArticle');
Route::post('materials/link/{url}', 'MaterialController@postLink');
Route::post('materials/lists/{id}', 'MaterialController@postList');
Route::post('/form/into/{id?}', 'FormController@postInto');
Route::get('/{chapter}/{cat}/{art}/edit', 'Auth\EditController@getArticle');
Route::post('/{chapter}/{cat}/{art}', 'Auth\EditController@postArticle');
Route::post('lab/{id}','Ajax\LabsController@postAdd');
Route::post('/ajax/course', 'Ajax\CourseController@postAll');
//files
Route::get('delete/{id}', 'UploaderController@getDelete');
Route::post('laravel-filemanager/upload','UploaderController@postFirst');
Route::post('/uploader', 'LibsController@getUpload');
});
Route::post('/ajax/labs/', 'Ajax\LabsController@postCourse');
//othes
Route::get('/', 'IndexController@getChapt'); //controller for main page
Route::get('projects','ProjectController@getAll');
Route::get('project/{id}','ProjectController@getOne');
Route::get('/conference', 'ConferenceController@getIndex');
Route::get('/eruds', 'ThesesController@getEruds'); //controller for theses
Route::get('/theses', 'ThesesController@getIndex'); //controller for theses
Route::get('/links', 'LinkController@getIndex');
Route::get('/lists', 'ListController@getIndex');
Route::get('/courses', 'ThesesController@getCourses');
Route::get('/course/{id}', 'WorkController@getCourse');
Route::get('/lab/{id}', 'WorkController@getCourse');

Route::get('/media/{name}','MediaController@getOne');
Route::get('/publics/add/{catalolg_id}/{public_id}', 'PublicController@getIndex');
Route::get('/document/doc/{url}','DocsController@getDoc'); //in doc
Route::get('/document/pdf/{url}','DocsController@getPdf'); //in pdf
Route::get('/document/html/{url}','DocsController@getHtml'); //in html
Route::get('/course/doc/{id}','DocsController@getCourseDoc');
Route::get('/course/html/{id}','DocsController@getCourseHtml');
Route::get('/articles', 'ThesesController@getArticles');
Route::get('/keywords','KeyController@getAll');
Route::get('/authors','AuthorController@getAll');
Route::get('/author/{name}','AuthorController@getOne');
Route::get('/user/{id}', 'UserController@getOne');
Route::get('key/{id}','KeyController@getIndex');
Route::get('/page/{url}','PageController@getIndex');
Route::get('/{chapter}', 'IndexController@getChapt'); //chapters of erud
Route::get('/{chapter}/{cat}', 'IndexController@getCat'); //chapter and catalog
Route::get('/{chapter}/{cat}/{art}', 'IndexController@getArt');
Route::post('backend/upload','UploaderController@files');


Route::get('/', function () {
    return view('welcome');
});
