<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Livewire\Actions\GenerateAutomaticAlerts;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:generate-alerts')]
#[Description('Générer automatiquement les alertes de dépassement budget pour tous les utilisateurs')]
class GenerateAlertsCommand extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::all();

        foreach ($users as $user) {
            GenerateAutomaticAlerts::execute($user->id);
        }

        $this->info('Alertes générées pour ' . $users->count() . ' utilisateur(s).');
    }
}
