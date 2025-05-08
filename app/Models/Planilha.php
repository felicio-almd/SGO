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
}
