<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planilha extends Model
{
    /** @use HasFactory<\Database\Factories\PlanilhaFactory> */
    use HasFactory;

    protected $fillable = [
        'nome',
        'descricao',
        'arquivo',
    ];

    public function dados()
    {
        return $this->hasMany(DadoPlanilha::class);
    }

    private function formatarValor($valor, $tipo)
    {
        if ($valor === null) {
            return null;
        }

        switch ($tipo) {
            case 'integer':
                return (int) $valor;
            case 'decimal':
                return (float) $valor;
            case 'date':
                return \Carbon\Carbon::parse($valor);
            case 'boolean':
                return (bool) $valor;
            default:
                return $valor;
        }
    }
}
