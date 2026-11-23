<?php
namespace App\Http\Controllers;
use App\Models\ContentPage;
class ContentController {
 public function page(string $slug){$page=ContentPage::where('type','page')->where('slug',$slug)->where('is_published',true)->firstOrFail();return response()->view('content.show',compact('page'))->header('X-Robots-Tag',$page->indexable?'index, follow':'noindex, follow');}
 public function blog(){return view('content.blog',['posts'=>ContentPage::where('type','post')->where('is_published',true)->orderByDesc('published_at')->orderByDesc('id')->paginate(12)]);}
 public function post(string $slug){$page=ContentPage::where('type','post')->where('slug',$slug)->where('is_published',true)->firstOrFail();return response()->view('content.show',compact('page'))->header('X-Robots-Tag',$page->indexable?'index, follow':'noindex, follow');}
}
