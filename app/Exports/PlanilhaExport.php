<?php
namespace App\Exports;

use App\Models\DadoPlanilha;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PlanilhaExport implements FromCollection, WithHeadings, WithMapping
{
    protected $planilhaId;

    public function __construct($planilhaId)
    {
        $this->planilhaId = $planilhaId;
    }

    /**
     * Retorna a coleção de dados para exportação.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Busca os dados da planilha com base no ID
        return DadoPlanilha::where('planilha_id', $this->planilhaId)->get();
    }

    /**
     * Define os cabeçalhos da planilha.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'Profissional',
            'Função',
            'Agosto',
            'Setembro',
            'Outubro',
            'Novembro',
            'Dezembro',
            'Total',
            'Valor Unitário',
            'Valor Total',
            'Desconto/Bônus',
            'Valor a Ser Pago',
            'Titular da Conta',
            'CPF',
            'Banco',
            'Agência',
            'Conta',
            'Tipo',
            'Telefone',
        ];
    }

    /**
     * Mapeia os dados para as colunas do Excel.
     *
     * @param mixed $dado
     * @return array
     */
    public function map($dado): array
    {
        return [
            $dado->profissional,
            $dado->funcao,
            $this->formatDecimal($dado->agosto),
            $this->formatDecimal($dado->setembro),
            $this->formatDecimal($dado->outubro),
            $this->formatDecimal($dado->novembro),
            $this->formatDecimal($dado->dezembro),
            $this->formatDecimal($dado->total),
            $this->formatDecimal($dado->valor_unitario),
            $this->formatDecimal($dado->valor_total),
            $this->formatDecimal($dado->desconto_bonus),
            $this->formatDecimal($dado->valor_a_ser_pago),
            $dado->titular_conta,
            $dado->cpf,
            $dado->banco,
            $dado->agencia,
            $dado->conta,
            $this->mapTipoValue($dado->tipo),
            $dado->telefone,
        ];
    }

    /**
     * Formata valores decimais para o Excel.
     *
     * @param mixed $value
     * @return float|null
     */
    private function formatDecimal($value)
    {
        return $value !== null ? (float) $value : null;
    }

    /**
     * Mapeia o valor do campo "tipo" para o texto correspondente.
     *
     * @param mixed $value
     * @return string|null
     */
    private function mapTipoValue($value)
    {
        $options = [
            1 => 'Sim',
            0 => 'Não',
            2 => 'Pendente',
        ];

        return $options[$value] ?? null;
    }
}