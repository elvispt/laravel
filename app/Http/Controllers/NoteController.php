<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

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
        $validation = $this->validateNote($request->all());
        if ($validation->fails()) {
            $messages = $validation->errors()->getMessages();
            return response()->json($messages, Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $noteModel = new Note();
        $noteModel->user_id = $request->get('userId');
        $noteModel->note = $request->get('note');
        $noteModel->save();
        return response()->json((Object) [
            'id' => $noteModel->id,
        ], Response::HTTP_CREATED);
    }

    /**
     * Update a note
     * @param Request $request
     * @param int $id
     * @return string
     */
    public function update(Request $request, int $id)
    {
        $validation = $this->validateNote(array_merge($request->all(), ['id' => $id]), [
            'id' =>  [
                'required',
                'integer',
                Rule::exists('notes', 'id'),
            ]
        ]);
        if ($validation->fails()) {
            $messages = $validation->errors()->getMessages();
            return response()->json($messages, Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $noteModel = Note::find($id);
        $noteModel->user_id = $request->get('userId');
        $noteModel->note = $request->get('note');
        $noteModel->save();
        return response()->json('', Response::HTTP_NO_CONTENT);
    }

    /**
     * Helper method to validate a note object data
     * @param array $data
     * @param array $appendRules
     * @return \Illuminate\Validation\Validator
     */
    private function validateNote(array $data, $appendRules = []): \Illuminate\Validation\Validator
    {
        $validationRules = [
            'userId' => [
                'required',
                'integer',
                Rule::exists('users', 'id'),
            ],
            'note' => 'required|string',
        ];
        $validationRules = empty($appendRules) ? $validationRules : array_merge($validationRules, $appendRules);
        return Validator::make($data, $validationRules);
    }

    /**
     * Delete a note
     * @param int $id
     * @return string
     */
    public function destroy(int $id)
    {
        $note = Note::find($id);
        if ($note === null) {
            $statusCode = Response::HTTP_NOT_FOUND;
        } else {
            $note->delete();
            $statusCode = Response::HTTP_NO_CONTENT;
        }
        return response('', $statusCode);
    }

    /**
     * Shows most recent notes
     */
    public function latest()
    {
        $note = Note::with([
            'user',
            'tags',
        ])
            ->orderBy('updated_at', 'DESC')
            ->limit(10)
            ->get();
        return $note;
    }
}
