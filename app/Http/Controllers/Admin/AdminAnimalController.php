<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Animal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminAnimalController extends Controller
{

    public function index()
    {
        $animals = Animal::latest()->paginate(10);
        return view('admin.animals.index', compact('animals'));
    }

    public function create()
    {
        return view('admin.animals.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'species' => 'required|in:cao,gato,outro',
            'breed' => 'nullable|string|max:255',
            'age' => 'nullable|in:filhote,adulto,idoso',
            'gender' => 'required|in:macho,femea',
            'size' => 'nullable|in:pequeno,medio,grande',
            'color' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'health_status' => 'nullable|string',
            'status' => 'required|in:disponivel,adotado,em_tratamento',
            'castrated' => 'nullable|boolean',
            'vaccinated' => 'nullable|boolean',
            'dewormed' => 'nullable|boolean',
            'special_needs' => 'nullable|boolean',
            'health_notes' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Garantir que checkboxes não marcados sejam false
        $validated['castrated'] = $request->has('castrated') ? 1 : 0;
        $validated['vaccinated'] = $request->has('vaccinated') ? 1 : 0;
        $validated['dewormed'] = $request->has('dewormed') ? 1 : 0;
        $validated['special_needs'] = $request->has('special_needs') ? 1 : 0;

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('storage/animals'), $filename);
            $validated['photo_url'] = '/storage/animals/' . $filename;
        }

        Animal::create($validated);

        return redirect()->route('admin.animals.index')
            ->with('success', 'Animal cadastrado com sucesso!');
    }

    public function edit(Animal $animal)
    {
        return view('admin.animals.edit', compact('animal'));
    }

    public function update(Request $request, Animal $animal)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'species' => 'required|in:cao,gato,outro',
            'breed' => 'nullable|string|max:255',
            'age' => 'nullable|in:filhote,adulto,idoso',
            'gender' => 'required|in:macho,femea',
            'size' => 'nullable|in:pequeno,medio,grande',
            'color' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'health_status' => 'nullable|string',
            'status' => 'required|in:disponivel,adotado,em_tratamento',
            'castrated' => 'nullable|boolean',
            'vaccinated' => 'nullable|boolean',
            'dewormed' => 'nullable|boolean',
            'special_needs' => 'nullable|boolean',
            'health_notes' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Garantir que checkboxes não marcados sejam false
        $validated['castrated'] = $request->has('castrated') ? 1 : 0;
        $validated['vaccinated'] = $request->has('vaccinated') ? 1 : 0;
        $validated['dewormed'] = $request->has('dewormed') ? 1 : 0;
        $validated['special_needs'] = $request->has('special_needs') ? 1 : 0;

        if ($request->hasFile('photo')) {
            // Delete old photo
            if ($animal->photo) {
                $oldPath = public_path($animal->photo);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            $file = $request->file('photo');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('storage/animals'), $filename);
            $validated['photo'] = '/storage/animals/' . $filename;
        }

        $animal->update($validated);

        return redirect()->route('admin.animals.index')
            ->with('success', 'Animal atualizado com sucesso!');
    }

    public function destroy(Animal $animal)
    {
        // Delete photo
        if ($animal->photo) {
            $oldPath = public_path($animal->photo);
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }
        }

        $animal->delete();

        return redirect()->route('admin.animals.index')
            ->with('success', 'Animal removido com sucesso!');
    }
}
