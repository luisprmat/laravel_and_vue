<?php

use App\{Category, Note};
use Illuminate\Database\Seeder;

class NoteSeeder extends Seeder
{
    protected $categories;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->categories = Category::all();

        factory(Note::class)->create([
            'text' => 'Programe fácil con la versión 6.0 y todas sus novedades',
            'category_id' => $this->categories->firstWhere('name', 'Laravel')->id,
        ]);

        factory(Note::class)->create([
            'text' => 'El mejor framework progresivo para Javascript',
            'category_id' => $this->categories->firstWhere('name', 'Vue.js')->id,
        ]);

        factory(Note::class)->create([
            'text' => 'v-for es una directiva utilizada para iterar una lista',
            'category_id' => $this->categories->firstWhere('name', 'Vue.js')->id,
        ]);

        factory(Note::class)->create([
            'text' => 'Trabaje con la versión 5 y sus últimas Herramientas',
            'category_id' => $this->categories->firstWhere('name', 'HTML')->id,
        ]);


        foreach (range(1,7) as $i) {
            $this->createRandomNote();
        }
    }

    protected function createRandomNote() {
        $note = factory(Note::class)->create([
            'category_id' => rand(0, 3) ? null : $this->categories->random()->id,
        ]);
    }
}
