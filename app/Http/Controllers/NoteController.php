<?php

namespace App\Http\Controllers;

use App\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Note::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only(['text', 'category_id']);

        $this->validate($request, [
            'text'=> 'required',
            'category_id' => 'exists:categories,id',
        ], [
            'required' => 'El campo :attribute debe ser diligenciado.',
            'exists' => 'El campo :attribute es inválido.'
        ], [
            'text' => 'texto',
            'category_id' => 'categoría'
        ]);

        $note = Note::create($data);

        return [
            'success' => true,
            'note' => $note,
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function show(Note $note)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Note $note)
    {
        $this->validate($request, [
            'text'=> 'required',
            'category_id' => 'exists:categories,id',
        ], [
            'required' => 'El campo :attribute debe ser diligenciado.',
            'exists' => 'El campo :attribute es inválido.'
        ], [
            'text' => 'texto',
            'category_id' => 'categoría'
        ]);

        $note->fill($request->all());
        $note->save();

        return [
            'success' => true,
            'note' => $note->toArray(),
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note $note)
    {
        $note->delete();

        return [
            'success' => true,
        ];
    }
}
