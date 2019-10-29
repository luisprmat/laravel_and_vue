<?php

namespace Tests\Feature\Api;

use App\{Category, Note};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NoteTest extends TestCase
{
    protected $note = 'This is a note';

    use RefreshDatabase;

    /** @test */
    function list_notes() {
        // $this->withoutExceptionHandling();

        $category = factory(Category::class)->create();

        $note1 = factory(Note::class)->create([
            'category_id' => $category->id,
            'text' => $this->note,
        ]);

        $note2 = factory(Note::class)->create();

        $notes = collect([$note1, $note2]);

        $this->get('api/v1/notes')
            ->assertOk()
            ->assertJson($notes->toArray());
    }

    /** @test */
    function it_can_create_a_note() {
        // $this->withoutExceptionHandling();

        $category = factory(Category::class)->create();

        $this->post('api/v1/notes', [
            'text' => $this->note,
            'category_id' => $category->id,
        ]);

        $this->assertDatabaseHas('notes', [
            'text' => $this->note,
            'category_id' => $category->id,
        ]);

        $response = [
            'success' => true,
            'note' => Note::first()->toArray(),
        ];


        $this->assertJson(json_encode($response));
    }

    /** @test */
    function it_validates_when_creating_a_note()
    {
        $this->post('api/v1/notes', [
            'text' => '',
            'category_id' => 100,
        ], ['Accept' => 'application/json']);

        $this->assertDatabaseMissing('notes', [
            'text' => '',
        ]);

        $response = [
            'message' => 'The given data was invalid.',
            'errors' => [
                'text' => [
                    'El campo text es obligatorio.',
                ],
                'category_id' => [
                    'El campo category id seleccionado no existe.',
                ],
            ],
        ];

        $this->assertJson(json_encode($response));
    }
    /** @test */
    function it_can_update_a_note() {
        // $this->withoutExceptionHandling();
        $updatedNote = 'Updated note';

        $category = factory(Category::class)->create();
        $anotherCategory = factory(Category::class)->create();

        $note = factory(Note::class)->create([
            'category_id' => $category->id,
        ]);

        $this->put('api/v1/notes/'.$note->id, [
            'text' => $updatedNote,
            'category_id' => $anotherCategory->id,
        ]);

        $this->assertDatabaseHas('notes', [
            'text' => $updatedNote,
            'category_id' => $anotherCategory->id,
        ]);

        $response = [
            'success' => true,
            'note' => [
                'id' => $note->id,
                'text' => $updatedNote,
                'category_id' => $anotherCategory->id,
            ],
        ];

        $this->assertJson(json_encode($response));
    }

    /** @test */
    function it_validates_when_updating_a_note()
    {
        $category = factory(Category::class)->create();

        $note = factory(Note::class)->create([
            'category_id' => $category->id,
        ]);

        $this->put('api/v1/notes/'.$note->id, [
            'text' => '',
            'category_id' => 100,
        ], ['Accept' => 'application/json']);

        $this->assertDatabaseMissing('notes', [
            'id' => $note->id,
            'text' => '',
        ]);

        $response = [
            'message' => 'The given data was invalid.',
            'errors' => [
                'text' => [
                    'El campo text es obligatorio.',
                ],
                'category_id' => [
                    'El campo category id seleccionado no existe.',
                ],
            ],
        ];

        $this->assertJson(json_encode($response));
    }

    /** @test */
    function it_is_possible_to_delete_a_note()
    {
        $note = factory(Note::class)->create();

        $this->delete('api/v1/notes/'.$note->id, [], ['Accept' => 'application/json']);

        $this->assertDatabaseMissing('notes', [
            'id' => $note->id,
        ]);

        $response = [
            'success' => true,
        ];

        $this->assertJson(json_encode($response));
    }
}
