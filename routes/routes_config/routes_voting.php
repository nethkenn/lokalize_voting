    <?php
Route::any('/',"LoginController@index");
Route::any('/layout',"AdminController@");
Route::any('/results',"ResultsController@results");

Route::any('/voters', "EmployeeController@index");
Route::any('/voters/vote/getcandidateinfo', "EmployeeController@getcandidateinfo");
Route::any('/voters/submit_votes', "EmployeeController@submit_votes");

Route::any('/admin', "AdminController@admin");
Route::any('/admin/approve/getcandidateinfo', "AdminController@getcandidateinfo");
Route::any('/admin/submit_votes', "AdminController@submit_votes");
Route::any('/admin/import', "AdminController@import_template");
Route::any('/admin/send_password', "AdminController@send_password");
Route::any('/admin/send_updates', "AdminController@send_updates");
Route::any('/admin/send_test_email', "AdminController@send_test_email");

Route::any('/login',"LoginController@login");
Route::any('/login_submit',"LoginController@login_submit");
Route::any('/logout',"LoginController@logout");

// Route::any('/logout', function () {
//     Toastr::info('Successfuly Logout!', 'Thank You!');
//     return view('index');
// });






