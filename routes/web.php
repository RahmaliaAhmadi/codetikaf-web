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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'Admin\LoginController@index')->middleware('StatMiddleware');
Route::post('/login', 'Admin\LoginController@login');
Route::get('/logout', 'Admin\LoginController@logout');
Route::group(['middleware' => 'LoginMiddleware'], function () {

    Route::get('/dashboard', 'Admin\DashboardController@index');
    Route::post('/uploadLatex', 'Admin\DashboardController@uploadLatex')->name('all.uploadLatex');
    Route::post('/togglesShow', 'Admin\DashboardController@switchShow')->name('togglesShow');
    Route::post('/togglesHide', 'Admin\DashboardController@switchHide')->name('togglesHide');

    //Data Role
    Route::resource('data-role', 'Admin\MasterRoleController');

    //Data User
    Route::resource('data-admin', 'Admin\AdminController');
    Route::resource('data-user', 'Admin\UserController');

    //Data Qur'an
    Route::resource('data-juz', 'Admin\MasterSectionController');
    Route::get('data-juz-filter', 'Admin\MasterSectionController@filter')->name('masterSection.filter');

    Route::resource('data-surah', 'Admin\TblSurahController');
    Route::get('/data-surah-json', 'Admin\TblSurahController@json')->name('tblSurah.json');
    Route::get('/data-surah-json2', 'Admin\TblSurahController@json2')->name('tblSurah.json2');
    Route::post('/data-surah-import', 'Admin\TblSurahController@import')->name('tblSurah.import');
    Route::get('/data-surah-export', 'Admin\TblSurahController@templateExport')->name('tblSurah.templateExport');
    Route::get('data-surah-filter', 'Admin\TblSurahController@filter')->name('tblSurah.filter');

    Route::resource('data-ayat', 'Admin\TblVerseController');
    Route::post('/data-ayat-import', 'Admin\TblVerseController@import')->name('tblVerse.import');
    Route::get('/data-ayat-json', 'Admin\TblVerseController@json')->name('tblVerse.json');
    Route::get('/data-ayat-json2', 'Admin\TblVerseController@json2')->name('tblVerse.json2');
    Route::get('/data-ayat-export', 'Admin\TblVerseController@templateExport')->name('tblVerse.templateExport');
    Route::get('data-ayat-filter', 'Admin\TblVerseController@filter')->name('tblVerse.filter');
   
    Route::resource('data-audio', 'Admin\TblVerseAudioController');
    Route::post('/data-audio-import', 'Admin\TblVerseAudioController@import')->name('tblVerseAudio.import');
    Route::get('/data-audio-export', 'Admin\TblVerseAudioController@templateExport')->name('tblVerseAudio.templateExport');

    //Data Tafsir
    Route::resource('data-info-tafsir', 'Admin\MasterInfoInterpretationController');
    Route::get('data-info-tafsir-filter', 'Admin\MasterInfoInterpretationController@filter')->name('masternfoInterpretation.filter');

    Route::resource('data-tafsir', 'Admin\TblInterpretationController');
    Route::post('/data-tafsir-import', 'Admin\TblInterpretationController@import')->name('tblInterpretation.import');
    Route::get('/data-tafsir-export', 'Admin\TblInterpretationController@templateExport')->name('tblInterpretation.templateExport');

    //Data Qori
    Route::resource('data-qori', 'Admin\MasterReciterController');
    Route::get('data-qori-filter', 'Admin\MasterReciterController@filter')->name('masterReciter.filter');
    Route::post('/data-qori-image', 'Admin\MasterReciterController@upload_image')->name('data-qori.image');

    //Data Halaman
    Route::resource('data-halaman', 'Admin\TblPageController');
    Route::post('/data-halaman-image', 'Admin\TblPageController@upload_image')->name('data-halaman.image');
    Route::get('data-halaman-filter', 'Admin\TblPageController@filter')->name('tblPage.filter');
    Route::post('/data-halaman-import', 'Admin\TblPageController@import')->name('tblPage.import');
    Route::get('/data-halaman-export', 'Admin\TblPageController@templateExport')->name('tblPage.templateExport');

    //<!-----Sprint 2----->

    //Data Tema
    Route::resource('data-tema', 'Sprint2\MasterLessonCategoryController');

    //Data Kajian
    Route::resource('data-kajian', 'Sprint2\TblLessonController');
    Route::get('data-kajian-filter', 'Sprint2\TblLessonController@filter')->name('data-kajian.filter');
    Route::post('/data-kajian-image', 'Sprint2\TblLessonController@upload_image')->name('data-kajian.image');
    Route::post('/data-kajian-poster', 'Sprint2\TblLessonController@upload_image_vertical')->name('data-kajian.imageVertical');

    //Data FAQ
    Route::resource('data-faq', 'Sprint2\FaqController');

    //Data Syarat & Ketentuan
    Route::resource('data-syarat-ketentuan', 'Sprint2\TermConditionController');

    //Data Syarat & Ketentuan
    Route::resource('data-campign', 'Sprint2\GeneralInfoController');
    Route::post('/data-campign-image', 'Sprint2\GeneralInfoController@upload_image')->name('data-campign.image');

    //Data Kontak
    Route::resource('data-kontak', 'Sprint2\ContactusController');
    Route::post('/data-kontak-image', 'Sprint2\ContactusController@upload_image')->name('data-kontak.image');

    
});
