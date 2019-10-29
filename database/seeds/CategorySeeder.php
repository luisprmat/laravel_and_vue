<?php

use App\Category;
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
        factory(Category::class)->create(['name' => 'Laravel']);
        factory(Category::class)->create(['name' => 'Vue.js']);
        factory(Category::class)->create(['name' => 'HTML']);
        factory(Category::class)->create(['name' => 'PHP']);
        factory(Category::class)->create(['name' => 'Publicidad']);
    }
}
