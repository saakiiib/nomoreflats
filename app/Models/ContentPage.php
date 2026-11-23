<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ContentPage extends Model {protected $fillable=['slug','title','type','excerpt','body','meta_title','meta_description','is_published','indexable','published_at'];protected $casts=['is_published'=>'boolean','indexable'=>'boolean','published_at'=>'datetime'];}
