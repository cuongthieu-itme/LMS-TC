<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

class CoursesTableSeeder extends Seeder
{
  public function run(): void
  {
    $courses = [
      [
        'title' => 'Dự án 1',
        'short_description' => 'Đây là văn bản ví dụ có thể được thay thế bằng văn bản khác',
        'description' => 'Đây là văn bản ví dụ có thể được thay thế bằng văn bản khác',
        'image' => 'course1.jpg',
      ],
      [
        'title' => 'Dự án 2',
        'short_description' => 'Đây là văn bản ví dụ có thể được thay thế bằng văn bản khác',
        'description' => 'Đây là văn bản ví dụ có thể được thay thế bằng văn bản khác',
        'image' => 'course2.jpg',
      ],
      [
        'title' => 'Dự án 3',
        'short_description' => 'Đây là văn bản ví dụ có thể được thay thế bằng văn bản khác',
        'description' => 'Đây là văn bản ví dụ có thể được thay thế bằng văn bản khác',
        'image' => 'course3.jpg',
      ],
    ];


    foreach ($courses as $course) {

      Course::create($course);
    } //end of foreach

  } //end of run

}//end of seeder
