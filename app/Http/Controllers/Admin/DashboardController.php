<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Animal;
use App\Models\AdoptionRequest;
use App\Models\Event;
use App\Models\Raffle;
use App\Models\Donation;
use App\Models\User;
use App\Models\Vaccine;

class DashboardController extends Controller
{

    public function index()
    {
        $stats = [
            'total_animals' => Animal::count(),
            'available' => Animal::where('status', 'disponivel')->count(),
            'adopted' => Animal::where('status', 'adotado')->count(),
            'in_treatment' => Animal::where('status', 'em_tratamento')->count(),
            'pending_requests' => AdoptionRequest::where('status', 'pendente')->count(),
            'approved_requests' => AdoptionRequest::where('status', 'aprovado')->count(),
            'active_events' => Event::where('active', true)->count(),
            'active_raffles' => Raffle::where('status', 'ativa')->count(),
            'total_donations' => Donation::sum('amount'),
            'total_users' => User::count(),
            'total_vaccines' => Vaccine::count(),
            'castrated' => Animal::where('castrated', true)->count(),
            'vaccinated' => Animal::where('vaccinated', true)->count(),
        ];

        $recent_requests = AdoptionRequest::with('animal')->latest()->take(5)->get();
        $recent_animals = Animal::latest()->take(5)->get();
        $recent_donations = Donation::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recent_requests', 'recent_animals', 'recent_donations'));
    }
}
