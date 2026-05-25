<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('alertes', function (Blueprint $table) {
            $table->foreignId('user_id')->after('id')->constrained()->cascadeOnDelete();
            $table->string('niveau')->default('info')->after('type'); // info, warning, danger
            $table->string('categorie')->nullable()->after('niveau'); // prediction_depassee, budget_depassee
            $table->decimal('montant', 10, 2)->nullable()->after('message');
            $table->boolean('is_read')->default(false)->after('montant');
            $table->date('date_alerte')->nullable()->after('is_read');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('alertes', function (Blueprint $table) {
            $table->dropForeignIdFor('users');
            $table->dropColumn(['user_id', 'niveau', 'categorie', 'montant', 'is_read', 'date_alerte']);
        });
    }
};
