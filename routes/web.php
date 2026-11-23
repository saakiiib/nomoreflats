<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Models\LandingPage;
use App\Models\ContentPage;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\ContentAdminController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\AdminController;
Route::get('/',fn()=>response(file_get_contents(resource_path('views/legacy/index.html')),200,['Content-Type'=>'text/html; charset=UTF-8']));
Route::get('/index.html',fn()=>redirect('/',301));
foreach (['about-us','areas-covered','contact','cookie-policy','disclaimer','faq','privacy-policy','services','terms-and-conditions','mobile-tyre-fitting-buxton','mobile-tyre-fitting-chesterfield','mobile-tyre-fitting-derby','mobile-tyre-fitting-dronfield','mobile-tyre-fitting-mansfield','mobile-tyre-fitting-matlock','mobile-tyre-fitting-nottingham','mobile-tyre-fitting-sheffield'] as $name){Route::get('/'.$name.'.html',fn()=>response(file_get_contents(resource_path('views/legacy/'.$name.'.html')),200,['Content-Type'=>'text/html; charset=UTF-8']));}
Route::get('/lp/{slug}',[LandingController::class,'show'])->where('slug','[a-z0-9-]+');
Route::get('/sitemap.xml',function(){
 $base=rtrim(config('app.url'),' /');
 $paths=['/','/services.html','/areas-covered.html','/about-us.html','/contact.html','/faq.html','/privacy-policy.html','/terms-and-conditions.html','/cookie-policy.html','/disclaimer.html'];
 foreach(['chesterfield','sheffield','dronfield','nottingham','derby','mansfield','matlock','buxton'] as $city)$paths[]='/mobile-tyre-fitting-'.$city.'.html';
 try{foreach(LandingPage::where('is_active',true)->where('indexable',true)->pluck('slug') as $slug)$paths[]='/lp/'.$slug;foreach(ContentPage::where('is_published',true)->where('indexable',true)->get(['slug','type']) as $content)$paths[]=($content->type==='post'?'/blog/':'/pages/').$content->slug;$paths[]='/blog';}catch(\Throwable $e){}
 $xml='<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
 foreach($paths as $p)$xml.='<url><loc>'.htmlspecialchars($base.$p,ENT_XML1).'</loc></url>';
 return response($xml.'</urlset>',200,['Content-Type'=>'application/xml; charset=UTF-8']);
});
Route::get('/admin/login',[AdminController::class,'loginForm']);
Route::post('/admin/login',[AdminController::class,'login']);
Route::post('/admin/logout',[AdminController::class,'logout']);
Route::get('/admin/landing-pages',[AdminController::class,'index']);
Route::get('/admin/landing-pages/create',[AdminController::class,'create']);
Route::get('/admin/landing-pages/{page}/edit',[AdminController::class,'edit']);
Route::post('/admin/landing-pages',[AdminController::class,'save']);
Route::put('/admin/landing-pages/{page}',[AdminController::class,'save']);

// V3 content management. These routes do not alter existing HTML or advertising URLs.
Route::get('/blog',[ContentController::class,'blog']);
Route::get('/blog/{slug}',[ContentController::class,'post'])->where('slug','[a-z0-9-]+');
Route::get('/pages/{slug}',[ContentController::class,'page'])->where('slug','[a-z0-9-]+');
Route::get('/admin/content',[ContentAdminController::class,'index']);
Route::get('/admin/content/create',[ContentAdminController::class,'create']);
Route::get('/admin/content/{item}/edit',[ContentAdminController::class,'edit']);
Route::post('/admin/content',[ContentAdminController::class,'save']);
Route::put('/admin/content/{item}',[ContentAdminController::class,'save']);
