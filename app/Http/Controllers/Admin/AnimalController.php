<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Animal;


class AnimalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
    $data = $request->validate([
        'name'           => 'required|string|max:255',
        'species'        => 'required|string|max:50',
        'breed'          => 'nullable|string|max:255',
        'age'            => 'nullable|in:filhote,adulto,idoso',
        'gender'         => 'required|string|max:10',
        'size'           => 'nullable|string|max:20',
        'color'          => 'nullable|string|max:100',
        'description'    => 'nullable|string',
        'health_status'  => 'nullable|string',
        'castrated'      => 'nullable|boolean',
        'vaccinated'     => 'nullable|boolean',
        'dewormed'       => 'nullable|boolean',
        'special_needs'  => 'nullable|boolean',
        'status'         => 'required|string|max:30',
        'photo'          => 'nullable|image|max:2048', // até 2MB
    ]);

    // checkboxes vêm como "on" → converte pra 1/0
    $data['castrated']     = $request->has('castrated');
    $data['vaccinated']    = $request->has('vaccinated');
    $data['dewormed']      = $request->has('dewormed');
    $data['special_needs'] = $request->has('special_needs');

    if ($request->hasFile('photo')) {
        // salva em storage/app/public/animals
        $data['photo'] = $request->file('photo')->store('animals', 'public');
    }

    Animal::create($data);

    return redirect()
        ->route('admin.animals.index')
        ->with('success', 'Animal cadastrado com sucesso!');
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Animal $animal)
{
    $data = $request->validate([
        'name'           => 'required|string|max:255',
        'species'        => 'required|string|max:50',
        'breed'          => 'nullable|string|max:255',
        'age'            => 'nullable|in:filhote,adulto,idoso',
        'gender'         => 'required|string|max:10',
        'size'           => 'nullable|string|max:20',
        'color'          => 'nullable|string|max:100',
        'description'    => 'nullable|string',
        'health_status'  => 'nullable|string',
        'castrated'      => 'nullable|boolean',
        'vaccinated'     => 'nullable|boolean',
        'dewormed'       => 'nullable|boolean',
        'special_needs'  => 'nullable|boolean',
        'status'         => 'required|string|max:30',
        'photo'          => 'nullable|image|max:2048',
    ]);

    $data['castrated']     = $request->has('castrated');
    $data['vaccinated']    = $request->has('vaccinated');
    $data['dewormed']      = $request->has('dewormed');
    $data['special_needs'] = $request->has('special_needs');

    if ($request->hasFile('photo')) {
        // apaga a foto antiga se existir
        if ($animal->photo) {
            Storage::disk('public')->delete($animal->photo);
        }

        $data['photo'] = $request->file('photo')->store('animals', 'public');
    }

    $animal->update($data);

    return redirect()
        ->route('admin.animals.index')
        ->with('success', 'Animal atualizado com sucesso!');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
