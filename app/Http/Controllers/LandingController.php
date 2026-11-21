<?php
namespace App\Http\Controllers;
use App\Models\LandingPage;
use Illuminate\Http\Request;
class LandingController {
 public function show(Request $request,string $slug){
  $page=LandingPage::where('slug',$slug)->where('is_active',true)->firstOrFail();
  return response()->view('landing.show',compact('page'))->header('X-Robots-Tag',$page->indexable?'index, follow':'noindex, follow');
 }
}
