<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'ورزشی' => [
                'slug' => 'sport'
            ],
            'مدلباس' => [
                'slug' => 'modl'
            ],
            'کوه‌نوردی' => [
                'slug' => 'kooh'
            ],
            'خانه‌آشپزخانه' => [
                'slug' => 'kitchenhome'
            ]
        ];
        foreach($categories as $nameCat  => $dataCat){
            Category::create([
                'title' => $nameCat,
                'slug'  => $dataCat['slug']
            ]);
        }
    }
}
