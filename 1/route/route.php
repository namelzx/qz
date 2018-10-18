<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

Route::get('think', function () {
    return 'hello,ThinkPHP5!';
});

Route::get('hello/:name', 'index/hello');
Route::post('api/index/pay', 'index/help/Upay');

Route::group('api/index/', function () {
    Route::post('/usercheck', 'index/index/checkUserbyopenid');
    Route::post('/help/data', 'index/help/PostbyData');
    Route::get('/help/getByList', 'index/help/getByList');
    Route::post('/help/getUserByList', 'index/help/getUserByList');
    Route::post('/help/getDatabyfind', 'index/help/getDatabyfind');
    Route::post('/help/PostByrecord', 'index/help/PostByrecord');
    Route::post('/help/getrecordBylist', 'index/help/getrecordBylist');
    Route::post('/user/getByCecord', 'index/user/getByCecord');
    Route::post('/user/PostByReal', 'index/user/PostByReal');
    Route::get('/user/GetByUserInfo', 'index/user/GetByUserInfo');
    Route::get('/index/Banner', 'index/index/Banner');
    Route::get('/index/GetCompleteByList', 'index/index/GetCompleteByList');
    Route::get('/index/GetByFind', 'index/index/GetByFind');



});
Route::group('api/admin/', function () {
    Route::post('/login', 'admin/login/login');
    Route::get('/Projec/GetTheraiseByList', 'admin/Project/GetTheraiseByList');
    Route::get('/Projec/SoftDelete', 'admin/Project/SoftDelete');
    Route::post('/Projec/EditStatus', 'admin/Project/EditStatus');
    Route::get('/Projec/FetchProject', 'admin/Project/FetchProject');
    Route::get('/Projec/FetchComplete', 'admin/Project/FetchComplete');
    Route::post('/Projec/CompleteByPost', 'admin/Project/CompleteByPost');
    Route::post('/Projec/PostByUpdate', 'admin/Project/PostByUpdate');
    Route::post('/Projec/upload', 'admin/Project/upload');
    Route::get('/User/GetByList', 'admin/User/GetByList');
    Route::post('/User/PostByUpdate', 'admin/User/PostByUpdate');
    Route::post('/User/SoftDelete', 'admin/User/SoftDelete');
    Route::get('/Admin/GetByList', 'admin/Admin/GetByList');
    Route::post('/Admin/PostByUpdate', 'admin/Admin/PostByUpdate');
    Route::get('/Admin/SoftDelete', 'admin/Admin/SoftDelete');
    Route::Post('/Financial/GetRecordByAll', 'admin/Financial/GetRecordByAll');
    Route::get('/Projec/GetByRecord', 'admin/Project/GetByRecord');


});
return [


];
