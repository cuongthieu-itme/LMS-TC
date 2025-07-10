<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class BooksTableSeeder extends Seeder
{
  public function run(): void
  {
    $books = [
      ['name' => 'Sách 1', 'number_of_pages' => 100, 'image' => 'book1.jpg'],
      ['name' => 'Sách 2', 'number_of_pages' => 80, 'image' => 'book2.jpg'],
      ['name' => 'Sách 3', 'number_of_pages' => 120, 'image' => 'book3.jpg'],
    ];

    foreach ($books as $book) {

      $newBook = Book::create($book);
    } //end of for each

  } //end of run

}//end of seeder
