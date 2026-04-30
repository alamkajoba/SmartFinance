<?php

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Livewire\Livewire;
use Tests\TestCase;

class TransactionAccumulationTest extends TestCase
{
    use DatabaseMigrations;

    public function test_transaction_accumulation()
    {
        // Créer un utilisateur
        $user = User::factory()->create();

        // Se connecter en tant que cet utilisateur
        $this->actingAs($user);

        // Créer une première transaction de revenu
        Livewire::test(\App\Livewire\Module\Transaction\TransactionCreate::class)
            ->set('montant', 100.00)
            ->set('type', 'revenu')
            ->set('description', 'Premier revenu')
            ->call('store');

        // Vérifier que la transaction a été créée
        $this->assertDatabaseHas('transactions', [
            'user_id' => $user->id,
            'montant' => 100.00,
            'type' => 'revenu',
            'description' => 'Premier revenu',
        ]);

        // Créer une deuxième transaction de revenu avec accumulation
        Livewire::test(\App\Livewire\Module\Transaction\TransactionCreate::class)
            ->set('montant', 50.00)
            ->set('type', 'revenu')
            ->set('description', 'Deuxième revenu')
            ->set('cumuler', true)
            ->call('store');

        // Vérifier que le montant a été ajouté à la première transaction
        $this->assertDatabaseHas('transactions', [
            'user_id' => $user->id,
            'montant' => 150.00, // 100 + 50
            'type' => 'revenu',
            'description' => 'Premier revenu + Deuxième revenu',
        ]);

        // Vérifier qu'il n'y a qu'une seule transaction de revenu
        $this->assertEquals(1, Transaction::where('user_id', $user->id)->where('type', 'revenu')->count());
    }

    public function test_transaction_without_accumulation()
    {
        // Créer un utilisateur
        $user = User::factory()->create();

        // Se connecter en tant que cet utilisateur
        $this->actingAs($user);

        // Créer une première transaction de dépense
        Livewire::test(\App\Livewire\Module\Transaction\TransactionCreate::class)
            ->set('montant', 75.00)
            ->set('type', 'depense')
            ->set('description', 'Première dépense')
            ->call('store');

        // Créer une deuxième transaction de dépense sans accumulation
        Livewire::test(\App\Livewire\Module\Transaction\TransactionCreate::class)
            ->set('montant', 25.00)
            ->set('type', 'depense')
            ->set('description', 'Deuxième dépense')
            ->set('cumuler', false)
            ->call('store');

        // Vérifier qu'il y a deux transactions distinctes
        $this->assertEquals(2, Transaction::where('user_id', $user->id)->where('type', 'depense')->count());

        // Vérifier les montants individuels
        $this->assertDatabaseHas('transactions', [
            'user_id' => $user->id,
            'montant' => 75.00,
            'type' => 'depense',
            'description' => 'Première dépense',
        ]);

        $this->assertDatabaseHas('transactions', [
            'user_id' => $user->id,
            'montant' => 25.00,
            'type' => 'depense',
            'description' => 'Deuxième dépense',
        ]);
    }
}