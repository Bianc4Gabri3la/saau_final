<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Raffle;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RaffleController extends Controller
{

    public function index()
    {
        $raffles = Raffle::latest()->paginate(10);
        return view('admin.raffles.index', compact('raffles'));
    }

    public function create()
    {
        return view('admin.raffles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'prize' => 'nullable|string|max:255',
            'ticket_price' => 'required|numeric|min:0',
            'total_tickets' => 'required|integer|min:1',
            'draw_date' => 'required|date',
            'status' => 'required|in:ativa,encerrada,sorteada',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('storage/raffles'), $filename);
            $validated['image_url'] = '/storage/raffles/' . $filename;
        }

        Raffle::create($validated);

        return redirect()->route('admin.raffles.index')
            ->with('success', 'Rifa criada com sucesso!');
    }

    public function edit(Raffle $raffle)
    {
        return view('admin.raffles.edit', compact('raffle'));
    }

    public function update(Request $request, Raffle $raffle)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'prize' => 'nullable|string|max:255',
            'ticket_price' => 'required|numeric|min:0',
            'total_tickets' => 'required|integer|min:1',
            'draw_date' => 'required|date',
            'status' => 'required|in:ativa,encerrada,sorteada',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($raffle->image_url) {
                $oldPath = public_path($raffle->image_url);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            $file = $request->file('image');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('storage/raffles'), $filename);
            $validated['image_url'] = '/storage/raffles/' . $filename;
        }

        $raffle->update($validated);

        return redirect()->route('admin.raffles.index')
            ->with('success', 'Rifa atualizada com sucesso!');
    }

    public function destroy(Raffle $raffle)
    {
        // Delete image
        if ($raffle->image_url) {
            $oldPath = public_path($raffle->image_url);
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }
        }

        $raffle->delete();

        return redirect()->route('admin.raffles.index')
            ->with('success', 'Rifa removida com sucesso!');
    }
}
