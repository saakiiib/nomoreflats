<?php
namespace App\Http\Controllers;
use App\Models\ContentPage;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
class ContentAdminController {
 private function guard(Request $r):void {if(!$r->session()->get('nmf_admin'))abort(403);}
 public function index(Request $r){$this->guard($r);return view('admin.content-index',['items'=>ContentPage::orderByDesc('updated_at')->get()]);}
 public function create(Request $r){$this->guard($r);return view('admin.content-edit',['item'=>new ContentPage]);}
 public function edit(Request $r,ContentPage $item){$this->guard($r);return view('admin.content-edit',compact('item'));}
 public function save(Request $r,?ContentPage $item=null){$this->guard($r);$data=$r->validate(['title'=>'required|string|max:255','slug'=>['required','regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/','max:180',Rule::unique('content_pages','slug')->ignore($item?->id)],'type'=>'required|in:page,post','excerpt'=>'nullable|string|max:600','body'=>'nullable|string|max:100000','meta_title'=>'nullable|string|max:255','meta_description'=>'nullable|string|max:320']);$data['is_published']=$r->boolean('is_published');$data['indexable']=$r->boolean('indexable');if($data['is_published']&&!($item?->published_at))$data['published_at']=now();if($item){$item->update($data);}else{ContentPage::create($data);}return redirect('/admin/content')->with('status','Content saved successfully.');}
}
