<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\LandingPage;
class DatabaseSeeder extends Seeder {
 public function run(): void { foreach (['Chesterfield','Sheffield','Dronfield','Nottingham','Derby','Mansfield','Matlock','Buxton'] as $city){
 $slug='mobile-tyre-fitting-'.strtolower($city);
 LandingPage::firstOrCreate(['slug'=>$slug],[
 'city'=>$city,'headline'=>'24/7 Mobile Tyre Fitting in '.$city,
 'subheadline'=>'Mobile tyre fitting at your home, workplace or roadside location across '.$city.'.',
 'intro'=>'No More Flats is a Chesterfield-based mobile tyre fitting service covering '.$city.' and surrounding areas. Call or WhatsApp to check availability and obtain a quote.',
 'meta_title'=>'Mobile Tyre Fitting '.$city.' | No More Flats',
 'meta_description'=>'Need mobile tyre fitting in '.$city.'? No More Flats provides 24/7 roadside tyre assistance. Call 07400 799942 to confirm availability.',
 'is_active'=>true,'indexable'=>false]); } }
}
