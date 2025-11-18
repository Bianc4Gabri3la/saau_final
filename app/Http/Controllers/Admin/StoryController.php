<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdoptionStory;
use Illuminate\Http\Request;

class StoryController extends Controller
{

    public function index()
    {
        $stories = AdoptionStory::latest()->paginate(15);
        return view('admin.stories.index', compact('stories'));
    }

    public function approve(AdoptionStory $story)
    {
        $story->update(['approved' => true]);
        return redirect()->route('admin.stories.index')
            ->with('success', 'História aprovada com sucesso!');
    }

    public function destroy(AdoptionStory $story)
    {
        // Deletar foto se existir
        if ($story->photo_url && file_exists(public_path($story->photo_url))) {
            unlink(public_path($story->photo_url));
        }

        $story->delete();
        return redirect()->route('admin.stories.index')
            ->with('success', 'História removida com sucesso!');
    }
}
