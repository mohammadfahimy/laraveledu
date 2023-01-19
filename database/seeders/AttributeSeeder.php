<?php

namespace Database\Seeders;

use App\Models\Attribute;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $attr = [
            'قرمز' => [
                'slug' => 'red'
            ],
            'بنفش' => [
                'slug' => 'purple'
            ],
            'نارنجی' => [
                'slug' => 'orange'
            ]
        ];

        foreach($attr as $key => $val)
        {
            Attribute::create([
                'name' => $key,
                'slug' => $val['slug']
            ]);
        }
    }
}
