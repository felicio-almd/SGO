<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DadoPlanilha extends Model
{
    use HasFactory;

    protected $table = 'dados_planilhas';

    protected $fillable = [
        'planilha_id',
        'profissional',
        'funcao',
        'agosto',
        'setembro',
        'outubro',
        'novembro',
        'dezembro',
        'total',
        'valor_unitario',
        'valor_total',
        'desconto_bonificacao',
        'valor_a_pagar',
        'titular_conta',
        'cpf',
        'banco',
        'agencia',
        'conta',
        'tipo_conta',
        'telefone',
    ];

    protected $casts = [
        'agosto' => 'decimal:2',
        'setembro' => 'decimal:2',
        'outubro' => 'decimal:2',
        'novembro' => 'decimal:2',
        'dezembro' => 'decimal:2',
        'total' => 'decimal:2',
        'valor_unitario' => 'decimal:2',
        'valor_total' => 'decimal:2',
        'desconto_bonificacao' => 'decimal:2',
        'valor_a_pagar' => 'decimal:2',
    ];

    public function planilha()
    {
        return $this->belongsTo(Planilha::class);
    }
}
