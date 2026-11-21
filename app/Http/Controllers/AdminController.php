<?php
namespace App\Http\Controllers;
use App\Models\LandingPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
class AdminController {
 private function guard(Request $r):void {if(!$r->session()->get('nmf_admin'))abort(403);}
 public function loginForm(){return view('admin.login');}
 public function login(Request $r){$data=$r->validate(['email'=>'required|email','password'=>'required|string']);$key='nmf-admin:'.$r->ip();if(RateLimiter::tooManyAttempts($key,5))return back()->withErrors(['email'=>'Too many attempts. Try later.']);
 $hash=config('nmf.admin_password_hash','');$ok=hash_equals((string)config('nmf.admin_email'),$data['email'])&&$hash!==''&&Hash::check($data['password'],$hash);
 if(!$ok){RateLimiter::hit($key,300);return back()->withErrors(['email'=>'Invalid credentials.']);}
 RateLimiter::clear($key);$r->session()->regenerate();$r->session()->put('nmf_admin',true);return redirect('/admin/landing-pages');}
 public function logout(Request $r){$r->session()->invalidate();$r->session()->regenerateToken();return redirect('/admin/login');}
 public function index(Request $r){$this->guard($r);return view('admin.index',['pages'=>LandingPage::orderBy('city')->get()]);}
 public function edit(Request $r,LandingPage $page){$this->guard($r);return view('admin.edit',compact('page'));}
 public function create(Request $r){$this->guard($r);return view('admin.edit',['page'=>new LandingPage]);}
 public function save(Request $r,?LandingPage $page=null){$this->guard($r);$data=$r->validate(['city'=>'required|string|max:100','slug'=>'required|alpha_dash|max:180|unique:landing_pages,slug,'.($page?->id??'NULL'), 'headline'=>'required|string|max:255','subheadline'=>'nullable|string|max:1500','intro'=>'nullable|string|max:5000','meta_title'=>'nullable|string|max:255','meta_description'=>'nullable|string|max:320','faq_text'=>'nullable|string|max:5000','callout_note'=>'nullable|string|max:255']);$data['is_active']=$r->boolean('is_active');$data['indexable']=$r->boolean('indexable');if($page){$page->update($data);}else{LandingPage::create($data);}return redirect('/admin/landing-pages')->with('status','Saved');}
}
