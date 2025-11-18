<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vaccine;
use App\Models\Animal;
use Illuminate\Http\Request;

class VaccineController extends Controller
{
    public function index()
    {
        $vaccines = Vaccine::with('animal')->latest()->paginate(15);
        return view('admin.vaccines.index', compact('vaccines'));
    }

    public function create()
    {
        $animals = Animal::where('status', '!=', 'adotado')
            ->orderBy('name')
            ->get();

        return view('admin.vaccines.create', compact('animals'));
    }

    public function store(Request $request)
    {
        // validação simples
        $data = $request->validate([
            'animal_id'    => 'required|exists:animals,id',
            'name'         => 'required|string|max:255',
            'date'         => 'required|date',
            'veterinarian' => 'nullable|string|max:255',
            'notes'        => 'nullable|string',
        ]);

        // salva no banco
        $vaccine = new Vaccine();
        $vaccine->animal_id    = $data['animal_id'];
        $vaccine->name         = $data['name'];
        $vaccine->date         = $data['date'];
        $vaccine->veterinarian = $data['veterinarian'] ?? null;
        $vaccine->notes        = $data['notes'] ?? null;
        $vaccine->save();

        return redirect()
            ->route('admin.vaccines.index')
            ->with('success', 'Vacina registrada com sucesso!');
    }

    public function edit(Vaccine $vaccine)
    {
        $animals = Animal::where('status', '!=', 'adotado')
            ->orderBy('name')
            ->get();

        return view('admin.vaccines.edit', compact('vaccine', 'animals'));
    }

    public function update(Request $request, Vaccine $vaccine)
    {
        $data = $request->validate([
            'animal_id'    => 'required|exists:animals,id',
            'name'         => 'required|string|max:255',
            'date'         => 'required|date',
            'veterinarian' => 'nullable|string|max:255',
            'notes'        => 'nullable|string',
        ]);

        $vaccine->animal_id    = $data['animal_id'];
        $vaccine->name         = $data['name'];
        $vaccine->date         = $data['date'];
        $vaccine->veterinarian = $data['veterinarian'] ?? null;
        $vaccine->notes        = $data['notes'] ?? null;
        $vaccine->save();

        return redirect()
            ->route('admin.vaccines.index')
            ->with('success', 'Vacina atualizada com sucesso!');
    }

    public function destroy(Vaccine $vaccine)
    {
        $vaccine->delete();

        return redirect()
            ->route('admin.vaccines.index')
            ->with('success', 'Registro de vacina removido com sucesso!');
    }
}
