<?php

namespace Database\Seeders;

use App\Models\WorkingHour;
use Illuminate\Database\Seeder;

// php artisan db:seed --class=WorkingHoursSeeder
class WorkingHoursSeeder extends Seeder
{
    public function run(): void
    {
        WorkingHour::truncate();

        $rows = [
            ['day_ar'=>'الاثنين – الثلاثاء','day_en'=>'Monday – Tuesday',   'day_index'=>1,'open_time'=>'11:00','close_time'=>'23:00','note_ar'=>'الغداء · العشاء',              'note_en'=>'Lunch · Dinner',               'sort_order'=>1],
            ['day_ar'=>'الأربعاء – الخميس', 'day_en'=>'Wednesday – Thursday','day_index'=>3,'open_time'=>'11:00','close_time'=>'00:00','note_ar'=>'الغداء · العشاء',              'note_en'=>'Lunch · Dinner',               'sort_order'=>2],
            ['day_ar'=>'الجمعة',            'day_en'=>'Friday',              'day_index'=>5,'open_time'=>'09:00','close_time'=>'01:00','note_ar'=>'الإفطار · الغداء · العشاء',   'note_en'=>'Breakfast · Lunch · Dinner',  'sort_order'=>3],
            ['day_ar'=>'السبت',             'day_en'=>'Saturday',            'day_index'=>6,'open_time'=>'09:00','close_time'=>'01:00','note_ar'=>'الإفطار · الغداء · العشاء',   'note_en'=>'Breakfast · Lunch · Dinner',  'sort_order'=>4],
            ['day_ar'=>'الأحد',             'day_en'=>'Sunday',              'day_index'=>0,'open_time'=>'11:00','close_time'=>'23:00','note_ar'=>'الغداء · العشاء',              'note_en'=>'Lunch · Dinner',               'sort_order'=>5],
            ['day_ar'=>'رمضان المبارك',     'day_en'=>'Ramadan',             'day_index'=>-1,'open_time'=>null, 'close_time'=>null,  'note_ar'=>'تابعونا على السوشيال ميديا',  'note_en'=>'Follow us on social media',   'sort_order'=>6,'is_ramadan'=>1],
        ];

        foreach ($rows as $row) {
            WorkingHour::create(array_merge(['is_active'=>1,'is_ramadan'=>0], $row));
        }
    }
}
