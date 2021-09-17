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
Route::middleware('front.data.share')->group(function (){
    Route::get('/', 'FrontController@index')->name('index');
    Route::get('/resume', 'FrontController@resume')->name('resume');
    Route::get('/blog', 'FrontController@blog')->name('blog');
    Route::get('/portfolyo', 'FrontController@portfolyo')->name('portfolyo');
    Route::get('/portfolyo/{id}', 'FrontController@portfolyoDetail')->name('portfolyo.detail')->whereNumber('id');
    Route::get('/iletisim', 'FrontController@iletisim')->name('iletisim');
});


Route::prefix('admin')->middleware('auth')->group(function (){
    Route::get('/', 'AdminController@index')->name('admin.index');

    Route::prefix('/education')->group(function (){
        Route::get('/list', 'EducationController@list')->name('admin.education.list');
        Route::post('/change-status', 'EducationController@changeStatus')->name('admin.education.changeStatus');
        Route::post('/delete', 'EducationController@delete')->name('admin.education.delete');
        Route::get('/add', 'EducationController@addShow')->name('admin.education.add');
        Route::post('/add', 'EducationController@add');
    });

    Route::prefix('/experience')->group(function (){
        Route::get('/list', 'ExperienceController@list')->name('admin.experience.list');
        Route::get('/add', 'ExperienceController@addShow')->name('admin.experience.add');
        Route::post('/add', 'ExperienceController@add');
        Route::post('/change-status', 'ExperienceController@changeStatus')->name('admin.experience.changeStatus');
        Route::post('/delete', 'ExperienceController@delete')->name('admin.experience.delete');
    });

    Route::prefix('/design-skills')->group(function (){
        Route::get('/list', 'DesignSkillsController@list')->name('admin.designSkills.list');
        Route::get('/add', 'DesignSkillsController@addShow')->name('admin.designSkills.add');
        Route::post('/add', 'DesignSkillsController@add');
        Route::post('/change-status', 'DesignSkillsController@changeStatus')->name('admin.designSkills.changeStatus');
        Route::post('/delete', 'DesignSkillsController@delete')->name('admin.designSkills.delete');
    });

    Route::prefix('/code-skills')->group(function (){
        Route::get('/list', 'CodeSkillsController@list')->name('admin.codeSkills.list');
        Route::get('/add', 'CodeSkillsController@addShow')->name('admin.codeSkills.add');
        Route::post('/add', 'CodeSkillsController@add');
        Route::post('/change-status', 'CodeSkillsController@changeStatus')->name('admin.codeSkills.changeStatus');
        Route::post('/delete', 'CodeSkillsController@delete')->name('admin.codeSkills.delete');
    });

    Route::prefix('/skills')->group(function (){
        Route::get('/list', 'SkillsController@list')->name('admin.skills.list');
        Route::get('/add', 'SkillsController@addShow')->name('admin.skills.add');
        Route::post('/add', 'SkillsController@add');
        Route::post('/change-status', 'SkillsController@changeStatus')->name('admin.skills.changeStatus');
        Route::post('/delete', 'SkillsController@delete')->name('admin.skills.delete');
    });

    Route::get('personal-information', 'PersonalInformationController@index')->name('personalInformation.index');
    Route::post('personal-information', 'PersonalInformationController@update');

    Route::prefix('/social-media')->group(function () {
        Route::get('/list', 'SocialMediaController@list')->name('admin.socialMedia.list');
        Route::get('/add', 'SocialMediaController@addShow')->name('admin.socialMedia.add');
        Route::post('/add', 'SocialMediaController@add');
        Route::post('/change-status', 'SocialMediaController@changeStatus')->name('admin.socialMedia.changeStatus');
        Route::post('/delete', 'SocialMediaController@delete')->name('admin.socialMedia.delete');
    });

    Route::resource('portfolyo','PortfolyoController');
    Route::post('portfolyo/change-status','PortfolyoController@changeStatus')->name('portfolyo.changeStatus');
    Route::get('portfolyo/images/{id}','PortfolyoController@showImages')->name('portfolyo.showImages')->whereNumber('id');
    Route::post('portfolyo/images/{id}','PortfolyoController@newImage')->name('portfolyo.newImage')->whereNumber('id');
    Route::delete('portfolyo/images/{id}','PortfolyoController@deleteImage')->name('portfolyo.deleteImage')->whereNumber('id');
    Route::put('portfolyo/images/{id}','PortfolyoController@featureImage')->name('portfolyo.featureImage')->whereNumber('id');
    Route::post('portfolyo/images/{id}/change-status','PortfolyoController@changeStatusImage')->name('portfolyo.changeStatusImage')->whereNumber('id');

    Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });

});


Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

