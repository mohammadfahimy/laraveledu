<?php

namespace Database\Factories;

use App\Models\Image;
use App\Models\SliderImage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $imageable = $this->imageable();
        for($i=0;$i < 4;$i++){
            $src_url[]= $this->faker->url();
        }
     
        return [
            'imageable_type' => $imageable ,
            'imageable_id'    => $imageable::factory(),
            'thumbnail_url' => $this->faker->url(),
            'source_url' => json_encode($src_url),
        ];
    }

    private function imageable()
    {
       return $this->faker->randomElement([
            Image::class,
            SliderImage::class
        ]);
    }
}
