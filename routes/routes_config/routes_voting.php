<?php
Route::any('/employee', "EmployeeController@index");
Route::any('/employee/vote/getcandidateinfo', "EmployeeController@getcandidateinfo");
Route::any('/employee/submit_votes', "EmployeeController@submit_votes");