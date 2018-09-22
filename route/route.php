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

Route::group('api/index/', function () {
    Route::post('/usercheck', 'index/index/checkUserbyopenid');
    Route::post('/help/data', 'index/help/PostbyData');
    Route::post('/help/getByList', 'index/help/getByList');
    Route::post('/help/getDatabyfind', 'index/help/getDatabyfind');
    Route::post('/help/PostByrecord', 'index/help/PostByrecord');
    Route::post('/help/getrecordBylist', 'index/help/getrecordBylist');
    Route::post('/user/getByCecord', 'index/user/getByCecord');
});
return [


];
