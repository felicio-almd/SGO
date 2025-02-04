<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('dados_planilhas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('planilha_id')->constrained('planilhas')->onDelete('cascade');
            $table->string('profissional')->nullable();
            $table->string('funcao')->nullable();
            $table->decimal('agosto', 10, 2)->nullable();
            $table->decimal('setembro', 10, 2)->nullable();
            $table->decimal('outubro', 10, 2)->nullable();
            $table->decimal('novembro', 10, 2)->nullable();
            $table->decimal('dezembro', 10, 2)->nullable();
            $table->decimal('total', 10, 2)->nullable();
            $table->decimal('valor_unitario', 10, 2)->nullable();
            $table->decimal('valor_total', 10, 2)->nullable();
            $table->decimal('desconto_bonificacao', 10, 2)->nullable();
            $table->decimal('valor_a_pagar', 10, 2)->nullable();
            $table->string('titular_conta')->nullable();
            $table->string('cpf')->nullable();
            $table->string('banco')->nullable();
            $table->string('agencia')->nullable();
            $table->string('conta')->nullable();
            $table->string('tipo_conta')->nullable();
            $table->string('telefone')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dados_planilhas');
    }
};
