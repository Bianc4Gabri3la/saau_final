<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Event;
use App\Models\Raffle;
use App\Models\AdoptionStory;
use App\Models\AdoptionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PublicController extends Controller
{
    public function home()
    {
        $stats = [
            'animals' => Animal::count(),
            'adopted' => Animal::where('status', 'adotado')->count(),
            'events' => Event::where('active', true)->count(),
            'raffles' => Raffle::where('status', 'ativa')->count(),
        ];

        $animals = Animal::where('status', 'disponivel')->latest()->take(6)->get();
        $events = Event::where('active', true)->latest()->take(3)->get();

        return view('public.home', compact('stats', 'animals', 'events'));
    }

    public function animals()
    {
        $animals = Animal::where('status', 'disponivel')->paginate(12);
        return view('public.animals', compact('animals'));
    }

    public function animalShow($id)
    {
        $animal = Animal::findOrFail($id);
        return view('public.animal-show', compact('animal'));
    }

    public function adoptionRequest(Request $request, $id)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'city_state' => 'required|string',
            'housing_type' => 'required|string',
            'had_pets' => 'nullable|string',
            'message' => 'nullable|string',
        ]);

        AdoptionRequest::create([
            'id' => Str::uuid(),
            'animal_id' => $id,
            'full_name' => $request->full_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'city_state' => $request->city_state,
            'housing_type' => $request->housing_type,
            'had_pets' => $request->had_pets,
            'message' => $request->message,
            'status' => 'pendente',
        ]);

        return redirect()->route('animal.show', $id)->with('success', 'Pedido de adoção enviado com sucesso!');
    }

    public function events()
    {
        $events = Event::where('active', true)->latest()->paginate(9);
        return view('public.events', compact('events'));
    }

    public function raffles()
    {
        $raffles = Raffle::where('status', 'ativa')->latest()->paginate(9);
        return view('public.raffles', compact('raffles'));
    }

    public function stories()
    {
        $stories = AdoptionStory::where('approved', true)->latest()->paginate(9);
        return view('public.stories', compact('stories'));
    }
}
