<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Support\Facades\Request;

class NoteController extends Controller
{
    /**
     * List all notes
     */
    public function index()
    {
        $notes = Note::with([
            'user',
            'tags',
        ])->get();
        return $notes;
    }

    public function show(int $id)
    {
        return (new Note())->find($id);
    }

    /**
     * Create a new note
     * @param Request $request
     * @return string
     */
    public function store(Request $request)
    {
        return 'Implement creation of note.';
    }

    /**
     * Update a note
     * @param Request $request
     * @param int $id
     * @return string
     */
    public function update(Request $request, int $id)
    {
        return 'Implement update of note.';
    }

    /**
     * Delete a note
     * @param int $id
     * @return string
     */
    public function destroy(int $id)
    {
        return 'Implement delete of note.';
    }

    /**
     * Shows most recent note
     */
    public function latest()
    {
        $note = Note::with([
            'user',
            'tags',
        ])
            ->orderBy('updated_at', 'DESC')
            ->first();
        return $note;
    }
}
