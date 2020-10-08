<?php

namespace Database\Seeders;

use App\Helpers\LinkTarget;
use App\Slide;
use App\Slider;
use Illuminate\Database\Seeder;

class SlidersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sliderDataset = [
            'name' => 'Főoldali',
            'slide_display_duration' => 5,
            'slide_pagination_duration' => 1.5
        ];
        $slidesDataset = [
            ['url' => '#', 'image' => 'fotorex_fejlec_szemelyreszabottszerviz.png', 'open_in' => LinkTarget::SELF_ID, 'position' => 1],
            ['url' => '#', 'image' => 'fotorex_fejlec_koltsegmegtakaritas.png', 'open_in' => LinkTarget::SELF_ID, 'position' => 2]
        ];
        $slider = Slider::where('name', '=', $sliderDataset['name'])->first();
        if ($slider == null) {
            $slider = Slider::create($sliderDataset);
        } else {
            $slider->update($sliderDataset);
        }
        $slider->slides()->delete();
        @mkdir(public_path(Slide::PHOTO_URL_BASE), 02777, true);
        foreach ($slidesDataset as $row) {
            Slide::create(['slider_id' => $slider->id] + $row);
            copy(
                base_path('database'.DIRECTORY_SEPARATOR.'seeds'.DIRECTORY_SEPARATOR.'sliders'.DIRECTORY_SEPARATOR.$row['image']),
                public_path(Slide::PHOTO_URL_BASE).DIRECTORY_SEPARATOR.$row['image']
            );
        }

    }
}
