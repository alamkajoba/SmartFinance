<?php

namespace Database\Seeders;

use App\Models\Transaction;
use App\Models\Categorie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Créer une catégorie de test
        $categorie = Categorie::firstOrCreate(
            ['nomCategorie' => 'Test'],
        );

        // Créer une transaction de type revenu pour l'utilisateur test
        Transaction::create([
            'user_id' => 1, // L'utilisateur créé par UserSeeder
            'categorie_id' => $categorie->id,
            'montant' => 2000,
            'type' => 'revenu', // Important: c'est un REVENU pas une dépense
            'description' => 'Revenu de test pour les dépenses',
        ]);
    }
}
