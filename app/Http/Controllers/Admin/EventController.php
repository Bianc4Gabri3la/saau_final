<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EventController extends Controller
{

    public function index()
    {
        $events = Event::latest()->paginate(10);
        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'location' => 'nullable|string|max:255',
            'active' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $validated['active'] = $request->has('active');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('storage/events'), $filename);
            $validated['image_url'] = '/storage/events/' . $filename;
        }

        Event::create($validated);

        return redirect()->route('admin.events.index')
            ->with('success', 'Evento criado com sucesso!');
    }

    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'location' => 'nullable|string|max:255',
            'active' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $validated['active'] = $request->has('active');

        if ($request->hasFile('image')) {
            // Delete old image
            if ($event->image_url) {
                $oldPath = public_path($event->image_url);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            $file = $request->file('image');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('storage/events'), $filename);
            $validated['image_url'] = '/storage/events/' . $filename;
        }

        $event->update($validated);

        return redirect()->route('admin.events.index')
            ->with('success', 'Evento atualizado com sucesso!');
    }

    public function destroy(Event $event)
    {
        // Delete image
        if ($event->image_url) {
            $oldPath = public_path($event->image_url);
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }
        }

        $event->delete();

        return redirect()->route('admin.events.index')
            ->with('success', 'Evento removido com sucesso!');
    }
}
