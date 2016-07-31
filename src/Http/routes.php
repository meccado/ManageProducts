<?php

Route::group(['namespace' 	=> 'App\Http\Controllers',
							'middleware' 	=> ['web', 'throttle'],
 							], function(){
			//'prefix'=>'api/v1',
			Route::group(['prefix' =>  'admin',
                          // 'middleware' 	=> ['auth', 'admin'],
	 					 'namespace' 	=> 'Admin'],
                         function(){
                      		Route::resource('brands', 'BrandController', ['only' => ['index', 'show','create', 'store', 'edit', 'update', 'destroy']]);
                      		Route::resource('products', 'ProductController', ['only' => ['index', 'show','create', 'store', 'edit', 'update', 'destroy']]);
                      		Route::resource('categories', 'CategoryController', ['only' => ['index', 'show','create', 'store', 'edit', 'update', 'destroy']]);
													Route::post('products/{products}/upload', ['as' => 'admin.products.upload', 'uses' => 'ProductController@upload']);
													Route::get('products/{products}/image-upload', ['as' => 'admin.products.image-upload', 'uses' => 'ProductController@getUpload']);
			});
});

View::composer('*', function ($view) {
  $categories			= \App\Category::where('parent_id', '=', 0)->get();//
		if(!$categories){
			$categories 	= [];
		}
		$brands					= \App\Brand::with('products')->get();
		if(!$brands){
			$brands 			= [];
		}
    $view->with(compact('categories', 'brands'));
});
