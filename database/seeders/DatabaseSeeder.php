<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Animal;
use App\Models\Event;
use App\Models\Raffle;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@saau.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Veterinário',
            'email' => 'vet@saau.com',
            'password' => Hash::make('vet123'),
            'role' => 'veterinario',
        ]);

        User::create([
            'name' => 'Usuário Teste',
            'email' => 'usuario@saau.com',
            'password' => Hash::make('usuario123'),
            'role' => 'usuario',
        ]);

        Animal::create([
            'id' => Str::uuid(),
            'name' => 'Rex',
            'species' => 'cao',
            'age' => 'adulto',
            'size' => 'grande',
            'sex' => 'macho',
            'status' => 'disponivel',
            'castrated' => true,
            'vaccinated' => true,
            'dewormed' => true,
            'special_needs' => false,
            'description' => 'Cachorro dócil e carinhoso, ótimo para famílias.',
        ]);

        Animal::create([
            'id' => Str::uuid(),
            'name' => 'Mia',
            'species' => 'gato',
            'age' => 'filhote',
            'size' => 'pequeno',
            'sex' => 'femea',
            'status' => 'disponivel',
            'castrated' => false,
            'vaccinated' => true,
            'dewormed' => true,
            'special_needs' => false,
            'description' => 'Gatinha brincalhona e amorosa.',
        ]);

        Animal::create([
            'id' => Str::uuid(),
            'name' => 'Bob',
            'species' => 'cao',
            'age' => 'idoso',
            'size' => 'medio',
            'sex' => 'macho',
            'status' => 'disponivel',
            'castrated' => true,
            'vaccinated' => true,
            'dewormed' => true,
            'special_needs' => false,
            'description' => 'Cachorro calmo, ideal para apartamento.',
        ]);

        Event::create([
            'id' => Str::uuid(),
            'title' => 'Feira de Adoção',
            'description' => 'Venha conhecer nossos animais disponíveis para adoção!',
            'date' => now()->addDays(15),
            'location' => 'Praça Central - Umuarama/PR',
            'active' => true,
        ]);

        Raffle::create([
            'id' => Str::uuid(),
            'title' => 'Rifa Solidária',
            'description' => 'Concorra a uma cesta de produtos e ajude os animais!',
            'prize' => 'Cesta de produtos pet no valor de R$ 500',
            'ticket_price' => 10.00,
            'draw_date' => now()->addDays(30),
            'status' => 'ativa',
        ]);

        echo "✅ Dados criados com sucesso!\n";
    }
}
