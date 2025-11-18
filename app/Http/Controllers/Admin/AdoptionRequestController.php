<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdoptionRequest;
use App\Models\Animal;
use Illuminate\Http\Request;

class AdoptionRequestController extends Controller
{

    public function index()
    {
        $requests = AdoptionRequest::with('animal')->latest()->paginate(15);
        return view('admin.adoption-requests.index', compact('requests'));
    }

    public function show(AdoptionRequest $adoptionRequest)
    {
        $adoptionRequest->load('animal');
        return view('admin.adoption-requests.show', compact('adoptionRequest'));
    }

    public function update(Request $request, AdoptionRequest $adoptionRequest)
    {
        $validated = $request->validate([
            'status' => 'required|in:pendente,aprovado,rejeitado',
            'admin_notes' => 'nullable|string'
        ]);

        $adoptionRequest->update($validated);

        // Se aprovado, atualizar status do animal
        if ($validated['status'] == 'aprovado' && $adoptionRequest->animal) {
            $adoptionRequest->animal->update(['status' => 'adotado']);
        }

        return redirect()->route('admin.adoption-requests.index')
            ->with('success', 'Pedido de adoção atualizado com sucesso!');
    }

    public function destroy(AdoptionRequest $adoptionRequest)
    {
        $adoptionRequest->delete();
        return redirect()->route('admin.adoption-requests.index')
            ->with('success', 'Pedido de adoção removido com sucesso!');
    }
}
