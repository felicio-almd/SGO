<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Editar Planilha</h1>
        <a href="/planilhas" class="btn btn-secondary">Voltar aos Processos</a>
    </div>

    <form method="POST" action="{{ route('planilha.atualizar', $id) }}">
        @csrf

        <table class="table table-bordered text-center align-middle">
            <thead class="table-light">
                <tr>
                    <th>Profissional</th>
                    <th>Função</th>
                    @php
                        $meses = ['agosto', 'setembro', 'octubro', 'novembro', 'dezembro'];
                    @endphp
                    @foreach ($meses as $mes)
                        <th>{{ ucfirst($mes) }}</th>
                    @endforeach
                    <th>Total</th>
                    <th>Valor Unitário</th>
                    <th>Valor Total</th>
                    <th>Desconto</th>
                    <th>Valor a Pagar</th>
                    <th>Titular da Conta</th>
                    <th>CPF</th>
                    <th>Banco</th>
                    <th>Agência</th>
                    <th>Conta</th>
                    <th>Tipo de Conta</th>
                    <th>Telefone</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dados as $dado)
                    <tr>
                        <td>{{ $dado->profissional }}</td>
                        <td><input type="text" class="form-control" name="dados[{{ $dado->id }}][funcao]" value="{{ $dado->funcao }}"></td>
                        @foreach ($meses as $mes)
                            <td><input type="number" step="0.01" class="form-control" name="dados[{{ $dado->id }}][{{ $mes }}]" value="{{ $dado->$mes }}"></td>
                        @endforeach
                        <td><input type="number" step="0.01" class="form-control" name="dados[{{ $dado->id }}][total]" value="{{ $dado->total }}"></td>
                        <td><input type="number" step="0.01" class="form-control" name="dados[{{ $dado->id }}][valor_unitario]" value="{{ $dado->valor_unitario }}"></td>
                        <td><input type="number" step="0.01" class="form-control" name="dados[{{ $dado->id }}][valor_total]" value="{{ $dado->valor_total }}"></td>
                        <td><input type="number" step="0.01" class="form-control" name="dados[{{ $dado->id }}][desconto_bonificacao]" value="{{ $dado->desconto_bonificacao }}"></td>
                        <td><input type="number" step="0.01" class="form-control" name="dados[{{ $dado->id }}][valor_a_pagar]" value="{{ $dado->valor_a_pagar }}"></td>
                        <td><input type="text" class="form-control" name="dados[{{ $dado->id }}][titular_conta]" value="{{ $dado->titular_conta }}"></td>
                        <td><input type="text" class="form-control" name="dados[{{ $dado->id }}][cpf]" value="{{ $dado->cpf }}"></td>
                        <td><input type="text" class="form-control" name="dados[{{ $dado->id }}][banco]" value="{{ $dado->banco }}"></td>
                        <td><input type="text" class="form-control" name="dados[{{ $dado->id }}][agencia]" value="{{ $dado->agencia }}"></td>
                        <td><input type="text" class="form-control" name="dados[{{ $dado->id }}][conta]" value="{{ $dado->conta }}"></td>
                        <td>
                            <select class="form-control" name="dados[{{ $dado->id }}][tipo_conta]">
                                <option value="POUPANÇA" {{ $dado->tipo_conta == 'POUPANÇA' ? 'selected' : '' }}>Poupança</option>
                                <option value="SALÁRIO" {{ $dado->tipo_conta == 'SALÁRIO' ? 'selected' : '' }}>Salário</option>
                                <option value="CORRENTE" {{ $dado->tipo_conta == 'CORRENTE' ? 'selected' : '' }}>Corrente</option>
                            </select>
                        </td>
                        <td><input type="text" class="form-control" name="dados[{{ $dado->id }}][telefone]" value="{{ $dado->telefone }}"></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <button type="submit" class="btn btn-primary mt-3">Salvar Alterações</button>
    </form>
</div>
