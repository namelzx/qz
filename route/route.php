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

Route::get('api/index/GetOpenid', 'index/index/getopenid');

Route::group('api/index/', function () {
    Route::post('/usercheck', 'index/index/checkUserbyopenid');
    Route::post('/help/data', 'index/help/PostbyData');
    //所有项目列表
    Route::get('/help/getByList', 'index/help/getByList');
    Route::post('/help/getUserByList', 'index/help/getUserByList');
    Route::get('/help/getDatabyfind', 'index/help/getDatabyfind');
    Route::post('/help/PostByrecord', 'index/help/PostByrecord');
    Route::get('/help/getrecordBylist', 'index/help/getrecordBylist');
    //获取用户捐款信息
    Route::get('/user/getByCecord', 'index/User/getByCecord');
    Route::post('/user/PostByReal', 'index/user/PostByReal');
    Route::get('/user/GetByUserInfo', 'index/user/GetByUserInfo');
    Route::post('/user/PostByCard', 'index/user/PostByCard');
    Route::get('/index/Banner', 'index/index/Banner');
    Route::get('/index/GetCompleteByList', 'index/index/GetCompleteByList');
    Route::get('/index/GetCompleteByfind', 'index/index/GetCompleteByfind');
    Route::get('/index/GetByFind', 'index/index/GetByFind');
    //获取使用教程信息
    Route::get('/index/GetBytutorial', 'index/index/GetBytutorial');
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
    Route::post('/User/SetUserByStatus', 'admin/User/SetUserByStatus');
    Route::post('/User/SoftDelete', 'admin/User/SoftDelete');
    Route::get('/Admin/GetByList', 'admin/Admin/GetByList');
    Route::post('/Admin/PostByUpdate', 'admin/Admin/PostByUpdate');
    Route::get('/Admin/SoftDelete', 'admin/Admin/SoftDelete');
    Route::Post('/Financial/GetRecordByAll', 'admin/Financial/GetRecordByAll');
    Route::get('/Projec/GetByRecord', 'admin/Project/GetByRecord');


    //文章模块
    Route::get('/Article/GetArticleByList', 'admin/Article/GetArticleByList');
    Route::Post('/Article/createArticle', 'admin/Article/createArticle');
    Route::get('/Article/detailArticle', 'admin/Article/detail');
    Route::get('/Article/deleteArticle', 'admin/Article/delete');

});
return [


];
