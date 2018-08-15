<?php
Route::any('/',"AdminController@index");

Route::any('/employee', "EmployeeController@index");
Route::any('/employee/vote/getcandidateinfo', "EmployeeController@getcandidateinfo");
Route::any('/employee/submit_votes', "EmployeeController@submit_votes");

Route::any('/admin', "AdminController@admin");
Route::any('/admin/approve/getcandidateinfo', "AdminController@getcandidateinfo");
Route::any('/admin/submit_votes', "AdminController@submit_votes");