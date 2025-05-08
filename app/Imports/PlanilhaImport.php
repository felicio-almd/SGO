<?php

namespace App\Imports;

use App\Models\DadoPlanilha;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class PlanilhaImport implements ToModel, WithStartRow
{
    protected $planilha_id;

    public $rows = 0;

    public function __construct($planilha_id)
    {
        $this->planilha_id = $planilha_id;
    }

    public function startRow(): int
    {
        return 6; // Aumentamos para 6 já que a linha 5 são os cabeçalhos
    }

    public function model(array $row)
    {
        if (empty($row[2])) { // Verificamos o campo profissional que está no índice 2
            return null;
        }

        $this->rows++;

        // Debug específico para identificar o problema com o campo tipo
        // dd([
        //     'row_completa' => $row,
        //     'profissional' => $row[2] ?? 'não definido',
        //     'funcao' => $row[3] ?? 'não definido',
        //     'valor_bruto_tipo' => $row[19],
        //     'planilha_id' => $this->planilha_id,
        //     'índice_atual' => $this->rows,
        // ]);

        return new DadoPlanilha([
            'planilha_id' => $this->planilha_id,
            'profissional' => $row[2] ?? null,
            'funcao' => $row[3] ?? null,
            'agosto' => $this->parseDecimal($row[4]),
            'setembro' => $this->parseDecimal($row[5]),
            'outubro' => $this->parseDecimal($row[6]),
            'novembro' => $this->parseDecimal($row[7]),
            'dezembro' => $this->parseDecimal($row[8]),
            'total' => $this->parseDecimal($row[9]),
            'valor_unitario' => $this->parseDecimal($row[10]),
            'valor_total' => $this->parseDecimal($row[11]),
            'desconto_bonus' => $this->parseDecimal($row[12]),
            'valor_a_ser_pago' => $this->parseDecimal($row[13]),
            'titular_conta' => $row[14] ?? null,
            'cpf' => $row[15] ?? null,
            'banco' => $row[16] ?? null,
            'agencia' => $row[17] ?? null,
            'conta' => $row[18] ?? null,
            'tipo_conta' => $row[19],
            'telefone' => $row[20] ?? null,
        ]);
    }

    private function parseDecimal($value)
    {
        if (empty($value)) {
            return null;
        }

        $value = preg_replace('/[^0-9.]/', '', $value);

        return (float) $value;
    }
}
