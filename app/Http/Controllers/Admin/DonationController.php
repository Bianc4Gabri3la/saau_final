<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use Illuminate\Http\Request;

class DonationController extends Controller
{

    public function index()
    {
        $donations = Donation::latest()->paginate(15);
        $total = Donation::sum('amount');
        return view('admin.donations.index', compact('donations', 'total'));
    }

    public function create()
    {
        return view('admin.donations.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'amount' => 'required|numeric|min:0',
            'donation_type' => 'required|string|max:255',
            'donor_name' => 'nullable|string|max:255',
            'notes' => 'nullable|string'
        ]);

        Donation::create($validated);

        return redirect()->route('admin.donations.index')
            ->with('success', 'Doação registrada com sucesso!');
    }

    public function edit(Donation $donation)
    {
        return view('admin.donations.edit', compact('donation'));
    }

    public function update(Request $request, Donation $donation)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'amount' => 'required|numeric|min:0',
            'donation_type' => 'required|string|max:255',
            'donor_name' => 'nullable|string|max:255',
            'notes' => 'nullable|string'
        ]);

        $donation->update($validated);

        return redirect()->route('admin.donations.index')
            ->with('success', 'Doação atualizada com sucesso!');
    }

    public function destroy(Donation $donation)
    {
        $donation->delete();
        return redirect()->route('admin.donations.index')
            ->with('success', 'Doação removida com sucesso!');
    }
}
