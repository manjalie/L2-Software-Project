<?php

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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
//welcome
Route::get('/', function () {
    return view('welcome');
})->name('/');

Auth::routes();


//==========================register as lecturer==================
Route::get('/register/lecturer', function () {
    return view('auth.lecturerRegister');
})->name('register/lecturer');

//=======================when the user is blocked=========================
Route::get('/blocked', function () {
    return view('blocked');
})->name('blocked');


Route::get('/home', 'HomeController@index')->name('home');

//image uploading
Route::get('image-view','ImageController@index');
Route::post('image-view','ImageController@store');
//document uploading
Route::get('doc-view','DocController@index');
Route::post('doc-view','DocController@store');
//=====================--------------------Students(use middleware as student for authenticate)-------------------------=================
//index(dashboard) of the students
Route::get('/student', 'StudentController@index')->middleware('student')->name('student');
//subject request panel
Route::get('/student/newCourse', 'StudentController@newCourse')->middleware('student')->name('student/newCourse');
//student requesting new caurse
Route::post('requestNewCourse','StudentController@addNewRequest')->middleware('student')->name('requestNewCourse');
//subject request panel
Route::get('/student/availableCourses', 'StudentController@availableCourses')->middleware('student')->name('student/availableCourses');
//subject request panel with subject id
Route::get('/student/newCourse/{id}', 'StudentController@newCourseSelected')->middleware('student')->name('student/newCourse/');
//classrooms of the student
Route::get('/student/classrooms', 'StudentController@classrooms')->middleware('student')->name('student/classrooms');
//classroom request history of the student
Route::get('/student/requestHistory', 'StudentController@requestHistory')->middleware('student')->name('student/requestHistory');
//delete request by student
Route::get('/student/requestHistory/delete/{id}', 'StudentController@deleteRequest')->middleware('student')->name('student/requestHistory/delete/');
//classroom payment history of the student
Route::get('/student/paymentHistory', 'StudentController@paymentHistory')->middleware('student')->name('student/paymentHistory');
//Make payment for requested course
Route::get('/student/paymentHistory/makePayment/{id}', 'StudentController@makePayment')->middleware('student')->name('student/paymentHistory/makePayment/');
//returning payment with payhere callback
Route::post('/payhereReturnNotify', 'StudentController@returnPaymentNotify')->middleware('student')->name('payhereReturnNotify');
//returning payment values with return
Route::get('/payhereReturn', 'StudentController@returnPayment')->middleware('student')->name('payhereReturn');
//student profile detail
Route::get('/student/profile', 'StudentController@profile')->middleware('student')->name('student/profile');
//update password
Route::post('/student/profile/updatePassword', 'StudentController@updatePassword')->middleware('student')->name('student/profile/updatePassword');
//update profile
Route::post('/student/profile/updateProfile', 'StudentController@updateProfile')->middleware('student')->name('student/profile/updateProfile');


//==================================-----------------LECTURER Using middleware as lecturer------------------------==============================
//show dashboard for a lecturer
Route::get('/lecturer', 'LecturerController@index')->middleware('lecturer')->name('lecturer');
//subject request panel for lecturer
Route::get('/lecturer/newCourse', 'LecturerController@newCourse')->middleware('lecturer')->name('lecturer/newCourse');
//lecturer requesting new course
Route::post('/lecturer/requestNewCourse','LecturerController@addNewRequest')->middleware('lecturer')->name('lecturer/requestNewCourse');
//subject request panel
Route::get('/lecturer/availableCourses', 'LecturerController@availableCourses')->middleware('lecturer')->name('lecturer/availableCourses');
//subject request panel with subject id
Route::get('/lecturer/newCourse/{id}', 'LecturerController@newCourseSelected')->middleware('lecturer')->name('lecturer/newCourse/');
//class requests from the students
Route::get('/lecturer/classrooms/requests', 'LecturerController@classRequests')->middleware('lecturer')->name('lecturer/classrooms/requests');
//accepting class request by lecturer
Route::get('/lecturer/classrooms/requests/accept/{id}', 'LecturerController@acceptRequest')->middleware('lecturer')->name('lecturer/classrooms/requests/accept/');
//active classrooms of the lecturer
Route::get('/lecturer/classrooms/all', 'LecturerController@classrooms')->middleware('lecturer')->name('lecturer/classrooms/all');
//Show students relevant to class
Route::get('/lecturer/classrooms/students/{id}', 'LecturerController@showStudents')->middleware('lecturer')->name('lecturer/classrooms/students/');
//courses apply history by lecturer
Route::get('/lecturer/applyHistory', 'LecturerController@applyHistory')->middleware('lecturer')->name('lecturer/applyHistory');
//delete request by lecturer
Route::get('/lecturer/requestHistory/delete/{id}', 'LecturerController@deleteRequest')->middleware('lecturer')->name('lecturer/requestHistory/delete/');
//lecturer profile detail
Route::get('/lecturer/profile', 'LecturerController@profile')->middleware('lecturer')->name('lecturer/profile');
//update password
Route::post('/lecturer/profile/updatePassword', 'LecturerController@updatePassword')->middleware('lecturer')->name('lecturer/profile/updatePassword');
//update profile
Route::post('/lecturer/profile/updateProfile', 'LecturerController@updateProfile')->middleware('lecturer')->name('lecturer/profile/updateProfile');


//==================================-----------------------Moderator------------------========================================
//show dashboard for a moderator
Route::get('/moderator', 'ModeratorController@index')->middleware('moderator')->name('moderator');
//lecturer request for new course
Route::get('/moderator/lecturer/requests', 'ModeratorController@lecturerRequests')->middleware('moderator')->name('moderator/lecturer/requests');
//lecturer request approval
Route::get('/moderator/lecturer/requests/accept/{id}', 'ModeratorController@lecturerRequestApproval')->middleware('moderator')->name('moderator/lecturer/requests/accept/');
//cancelling accepted lecturer request
Route::get('/moderator/lecturer/requests/cancel/{id}', 'ModeratorController@lecturerRequestCancel')->middleware('moderator')->name('moderator/lecturer/requests/cancel/');
//lecturers all profiles
Route::get('/moderator/lecturer/allProfiles', 'ModeratorController@lecturerProfiles')->middleware('moderator')->name('moderator/lecturer/allProfiles');
//looking for lecturer profile info
Route::get('/moderator/lecturer/allProfiles/view/{id}', 'ModeratorController@lectureProfile')->middleware('moderator')->name('moderator/lecturer/allProfiles/view/');
//student request for new course
Route::get('/moderator/student/requests', 'ModeratorController@studentRequests')->middleware('moderator')->name('moderator/student/requests');
//student request suggestion for relevant request
Route::get('/moderator/student/requests/suggestion/{requestID}', 'ModeratorController@studentRequestSuggestion')->middleware('moderator')->name('moderator/student/requests/suggestion/');
//updating or creating new request approval model
Route::get('/moderator/student/requests/respondRequest/{requestID}/{lecturerID}', 'ModeratorController@requestingClassFromLecturer')->middleware('moderator')->name('moderator/student/requests/respondRequest/');
//asking payment panel for student request
Route::get('/moderator/student/requests/askPayment/{requestID}', 'ModeratorController@askingPaymentPanel')->middleware('moderator')->name('moderator/student/requests/askPayment/');
//requesting payment from student
Route::post('/moderator/student/requests/askPayment/send', 'ModeratorController@requestPayment')->middleware('moderator')->name('moderator/student/requests/askPayment/send');
//creating classroom panel
Route::get('/moderator/student/requests/createClassroom/{id}', 'ModeratorController@createClassroomPanel')->middleware('moderator')->name('moderator/student/requests/createClassroom/');
//creating new classroom
Route::post('/moderator/student/requests/createClassroom/create', 'ModeratorController@createNewClassroom')->middleware('moderator')->name('moderator/student/requests/createClassroom/create');
//students all profiles
Route::get('/moderator/student/allProfiles', 'ModeratorController@studentProfiles')->middleware('moderator')->name('moderator/student/allProfiles');
//looking for student profile info
Route::get('/moderator/student/allProfiles/view/{id}', 'ModeratorController@studentProfile')->middleware('moderator')->name('moderator/student/allProfiles/view/');
//view classrooms
Route::get('/moderator/classroom', 'ModeratorController@classrooms')->middleware('moderator')->name('moderator/classroom');
// profiles relevant to the classrooms
Route::get('/moderator/classroom/profiles/{id}', 'ModeratorController@classroomsStudents')->middleware('moderator')->name('moderator/classroom/profiles/');
//view payments
Route::get('/moderator/payment', 'ModeratorController@showPayments')->middleware('moderator')->name('moderator/payment');
//view add new course panel
Route::get('/moderator/course/addNew', 'ModeratorController@showAddNewCoursePanel')->middleware('moderator')->name('moderator/course/addNew');
//adding new course to database
Route::post('/moderator/course/addNew/add', 'ModeratorController@addNewCourse')->middleware('moderator')->name('moderator/course/addNew/add');
//view available course panel
Route::get('/moderator/course/all', 'ModeratorController@showCourses')->middleware('moderator')->name('moderator/course/all');
//delete  course
Route::get('/moderator/course/delete/{id}', 'ModeratorController@deleteCourses')->middleware('moderator')->name('moderator/course/delete/');
//moderator profile detail
Route::get('/moderator/profile', 'ModeratorController@profile')->middleware('moderator')->name('moderator/profile');
//update password
Route::post('/moderator/profile/updatePassword', 'ModeratorController@updatePassword')->middleware('moderator')->name('moderator/profile/updatePassword');
//update profile
Route::post('/moderator/profile/updateProfile', 'ModeratorController@updateProfile')->middleware('moderator')->name('moderator/profile/updateProfile');

//============================================Administrator===========================================
//show dashboard for a administrator
Route::get('/admin', 'AdminController@index')->middleware('admin')->name('admin');
//lecturers all profiles
Route::get('/admin/lecturer/allProfiles', 'AdminController@lecturerProfiles')->middleware('admin')->name('admin/lecturer/allProfiles');
//looking for lecturer profile info
Route::get('/admin/lecturer/allProfiles/view/{id}', 'AdminController@lectureProfile')->middleware('admin')->name('admin/lecturer/allProfiles/view/');
//block lecturer
Route::get('/admin/lecturer/allProfiles/block/{id}', 'AdminController@blockLecturer')->middleware('admin')->name('admin/lecturer/allProfiles/block/');
//unblock lecturer
Route::get('/admin/lecturer/allProfiles/unblock/{id}', 'AdminController@unblockLecturer')->middleware('admin')->name('admin/lecturer/allProfiles/unblock/');
//students all profiles
Route::get('/admin/student/allProfiles', 'AdminController@studentProfiles')->middleware('admin')->name('admin/student/allProfiles');
//looking for student profile info
Route::get('/admin/student/allProfiles/view/{id}', 'AdminController@studentProfile')->middleware('admin')->name('admin/student/allProfiles/view/');
//block student
Route::get('/admin/student/allProfiles/block/{id}', 'AdminController@blockStudent')->middleware('admin')->name('admin/student/allProfiles/block/');
//unblock student
Route::get('/admin/student/allProfiles/unblock/{id}', 'AdminController@unblockStudent')->middleware('admin')->name('admin/student/allProfiles/unblock/');
//view add new course panel
Route::get('/admin/course/addNew', 'AdminController@showAddNewCoursePanel')->middleware('admin')->name('admin/course/addNew');
//adding new course to database
Route::post('/admin/course/addNew/add', 'AdminController@addNewCourse')->middleware('admin')->name('admin/course/addNew/add');
//view available course panel
Route::get('/admin/course/all', 'AdminController@showCourses')->middleware('admin')->name('admin/course/all');
//delete  course
Route::get('/admin/course/delete/{id}', 'AdminController@deleteCourses')->middleware('admin')->name('admin/course/delete/');
//view classrooms
Route::get('/admin/classroom', 'AdminController@classrooms')->middleware('admin')->name('admin/classroom');
// profiles relevant to the classrooms
Route::get('/admin/classroom/profiles/{id}', 'AdminController@classroomsStudents')->middleware('admin')->name('admin/classroom/profiles/');
//view payments
Route::get('/admin/payment', 'AdminController@showPayments')->middleware('admin')->name('admin/payment');

//moderator all profiles
Route::get('/admin/moderator/allProfiles', 'AdminController@moderatorProfiles')->middleware('admin')->name('admin/moderator/allProfiles');
//looking for moderator profile info
Route::get('/admin/moderator/allProfiles/view/{id}', 'AdminController@moderatorProfile')->middleware('admin')->name('admin/moderator/allProfiles/view/');
//block moderator
Route::get('/admin/moderator/allProfiles/block/{id}', 'AdminController@blockModerator')->middleware('admin')->name('admin/moderator/allProfiles/block/');
//unblock moderator
Route::get('/admin/moderator/allProfiles/unblock/{id}', 'AdminController@unblockModerator')->middleware('admin')->name('admin/moderator/allProfiles/unblock/');
//view add new moderator panel
Route::get('/admin/moderator/addNew', 'AdminController@showAddNewModeratorPanel')->middleware('admin')->name('admin/moderator/addNew');
//adding new moderator to database
Route::post('/admin/moderator/addNew/add', 'AdminController@addNewModerator')->middleware('admin')->name('admin/moderator/addNew/add');
