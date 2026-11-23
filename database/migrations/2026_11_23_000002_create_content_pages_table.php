<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
 public function up():void { Schema::create('content_pages',function(Blueprint $t){$t->id();$t->string('slug')->unique();$t->string('title');$t->string('type')->default('page');$t->string('excerpt',600)->nullable();$t->longText('body')->nullable();$t->string('meta_title')->nullable();$t->string('meta_description',320)->nullable();$t->boolean('is_published')->default(false);$t->boolean('indexable')->default(true);$t->timestamp('published_at')->nullable();$t->timestamps();}); }
 public function down():void {Schema::dropIfExists('content_pages');}
};
