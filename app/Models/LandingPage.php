<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class LandingPage extends Model {
 protected $fillable=['slug','city','headline','subheadline','intro','meta_title','meta_description','faq_text','callout_note','is_active','indexable'];
 protected $casts=['is_active'=>'boolean','indexable'=>'boolean'];
}
