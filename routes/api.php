<?php

Route::post('login', 'UsersController@login');
Route::post('register', 'UsersController@register');
Route::group(['middleware' => 'jwt.auth'], function () {
    Route::post('logout', 'UsersController@logout');
    Route::get('listPost', 'PostsController@listPost');
    Route::get('postsOfUser', 'PostsController@postsOfUser');
    Route::post('createPost', 'PostsController@createPost');
    Route::post('updatePost', 'PostsController@updatePost');
    Route::get('deletePost', 'PostsController@deletePost');
});
