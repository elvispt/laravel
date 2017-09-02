<?php

use App\Models\Note;
use Illuminate\Database\Seeder;
use App\Models\Tag;

class NotesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Note::class, 50)->create()->each(function ($user) {
            $tagIds = (new Tag())
                ->inRandomOrder()
                ->limit(random_int(1, 3))
                ->get(['id'])->map(function ($tag) {
                    return $tag->id;
                });
            $user->tags()->sync($tagIds);
        });
    }
}
