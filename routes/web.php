<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'App\\Http\\Controllers\\Admin\\'], function () {
    // ======================= Home ===============================
    Route::resource('dashboard', 'DashboardController');
    // ======================= SLIDER ===============================
    Route::resource('sliders', 'SliderController', ['parameters' => ['sliders' => 'item']]);
    // ======================= CATEGORY =================================
    Route::resource('categories', 'CategoryController', ['parameters' => ['categories' => 'item']]);
    // ======================= ARTICLE =================================
    Route::resource('articles', 'ArticleController', ['parameters' => ['articles' => 'item']]);
});
