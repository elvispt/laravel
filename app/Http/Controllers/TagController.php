<?php

namespace App\Http\Controllers;

use App\Models\Tag;

class TagController extends Controller
{
    /**
     * List all notes
     */
    public function index()
    {
        $tags = Tag::with([
            'user',
            'notes'
        ])->get();
        return $tags;
    }
}
