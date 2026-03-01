<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name_en'=>'Yemeni Food','name_ar'=>'أكلات يمنية'],
            ['name_en'=>'Saudi Food','name_ar'=>'أكلات سعودية'],
            ['name_en'=>'Syrian Food','name_ar'=>'أكلات شامية'],
        ];

        foreach ($categories as $c){
            Category::create($c);
        }
 


        $products = [
            [
                'name_en'=>'Mandi',
                'name_ar'=>'مندي',
                'description_en'=>'Traditional Yemeni dish cooked in a tandoor.',
                'description_ar'=>'طبق يمني تقليدي يتم طهيه في التنور.',
                'photo'=>'mandi.jpg',
                'is_featured'=>1,
                'category'=>'Yemeni Food'
            ],
            [
                'name_en'=>'Madbi',
                'name_ar'=>'مظبي',
                'description_en'=>'Charcoal grilled lamb with spices.',
                'description_ar'=>'لحم مشوي على الجمر مع بهارات خاصة.',
                'photo'=>'madbi.jpg',
                'is_featured'=>1,
                'category'=>'Saudi Food'
            ],
            [
                'name_en'=>'Kabsa',
                'name_ar'=>'كبسة',
                'description_en'=>'Saudi spiced rice with meat.',
                'description_ar'=>'أرز متبل سعودي مع اللحم.',
                'photo'=>'kabsa.jpg',
                'is_featured'=>2,
                'category'=>'Saudi Food'
            ],
            [
                'name_en'=>'Biryani',
                'name_ar'=>'برياني',
                'description_en'=>'Spicy rice with chicken or meat.',
                'description_ar'=>'أرز متبل مع دجاج أو لحم.',
                'photo'=>'biryani.jpg',
                'is_featured'=>2,
                'category'=>'Syrian Food'
            ],
        ];

        foreach ($products as $p){
            $category = Category::where('name_en',$p['category'])->first();

            Product::create([
                'name_en'=>$p['name_en'],
                'name_ar'=>$p['name_ar'],
                'description_en'=>$p['description_en'],
                'description_ar'=>$p['description_ar'],
                'photo'=>$p['photo'],
                'is_featured'=>$p['is_featured'],
                'category_id'=>$category->id,
            ]);
        }

   }
}