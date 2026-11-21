<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
 public function up(): void { Schema::create('landing_pages',function(Blueprint $t){$t->id();$t->string('slug')->unique();$t->string('city');$t->string('headline');$t->text('subheadline')->nullable();$t->text('intro')->nullable();$t->string('meta_title')->nullable();$t->string('meta_description',320)->nullable();$t->text('faq_text')->nullable();$t->string('callout_note')->nullable();$t->boolean('is_active')->default(true);$t->boolean('indexable')->default(false);$t->timestamps();}); }
 public function down():void {Schema::dropIfExists('landing_pages');}
};
