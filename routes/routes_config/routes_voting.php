<?php
Route::any('/',"LoginController@index");

Route::any('/employee', "EmployeeController@index");
Route::any('/employee/vote/getcandidateinfo', "EmployeeController@getcandidateinfo");
Route::any('/employee/submit_votes', "EmployeeController@submit_votes");

Route::any('/admin', "AdminController@admin");
Route::any('/admin/approve/getcandidateinfo', "AdminController@getcandidateinfo");
Route::any('/admin/submit_votes', "AdminController@submit_votes");
Route::any('/admin/import_data_modal/import_template', "AdminController@import_template");

Route::any('/login',"LoginController@login");
Route::any('/login_submit',"LoginController@login_submit");
Route::any('/logout',"LoginController@logout");






