<?php

namespace Database\Seeders;

use App\Models\Slide;
use Illuminate\Database\Seeder;

class SlidesTableSeeder extends Seeder
{
  public function run(): void
  {
    $slides = [
      [
        'upper_title' => 'Trang web của tôi',
        'title' => 'Trang web của tôi',
        'image' => 'slide1.jpg',
        'link' => '#',
      ],
      [
        'upper_title' => 'Trang web của tôi',
        'title' => 'Trang web của tôi',
        'image' => 'slide2.jpg',
        'link' => '#',
      ],
    ];


    foreach ($slides as $slide) {

      Slide::create($slide);
    } //end of foreach

  } //end of run

}//end of seeder
