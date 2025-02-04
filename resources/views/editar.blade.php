<div class="container">
    <div class="flex">
        <h1>Editar Planilha</h1>
        <a href="/planilhas">Voltar aos Processos</a>
    </div>
    <form method="POST" action="{{ route('planilha.atualizar', $id) }}" >
        @csrf
        @foreach ($dados as $dado)
        <div style="display: flex; flex-direction: column;">

            <div class="row mb-3" style="display: flex;">
                <div class="col-md-2">
                    <label class="form-label">Profissional</label>
                    <label class="col-md-3 col-form-label">{{ $dado->profissional }}</label>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Função</label>
                    <input type="text" class="form-control" name="dados[{{ $dado->id }}][funcao]" value="{{ $dado->funcao }}">
                </div>
                @php
                    $meses = ['agosto', 'setembro', 'outubro', 'novembro', 'dezembro'];
                @endphp
                @foreach ($meses as $mes)
                <div class="col-md-2" style="display: flex; flex-direction:column;">
                    <label class="form-label">{{ ucfirst($mes) }}</label>
                    <input type="number" step="0.01" class="form-control" name="dados[{{ $dado->id }}][{{ $mes }}]" value="{{ $dado->$mes }}">
                </div>
                @endforeach
            
                <div class="col-md-3">
                    <label class="form-label">Total</label>
                    <input type="number" step="0.01" class="form-control" name="dados[{{ $dado->id }}][total]" value="{{ $dado->total }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Valor Unitário</label>
                    <input type="number" step="0.01" class="form-control" name="dados[{{ $dado->id }}][valor_unitario]" value="{{ $dado->valor_unitario }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Valor Total</label>
                    <input type="number" step="0.01" class="form-control" name="dados[{{ $dado->id }}][valor_total]" value="{{ $dado->valor_total }}">
                </div>
            
                <div class="col-md-3">
                    <label class="form-label">Desconto Bonificação</label>
                    <input type="number" step="0.01" class="form-control" name="dados[{{ $dado->id }}][desconto_bonificacao]" value="{{ $dado->desconto_bonificacao }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Valor a Pagar</label>
                    <input type="number" step="0.01" class="form-control" name="dados[{{ $dado->id }}][valor_a_pagar]" value="{{ $dado->valor_a_pagar }}">
                </div>
            
                <div class="col-md-3">
                    <label class="form-label">Titular da Conta</label>
                    <input type="text" class="form-control" name="dados[{{ $dado->id }}][titular_conta]" value="{{ $dado->titular_conta }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">CPF</label>
                    <input type="text" class="form-control" name="dados[{{ $dado->id }}][cpf]" value="{{ $dado->cpf }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Banco</label>
                    <input type="text" class="form-control" name="dados[{{ $dado->id }}][banco]" value="{{ $dado->banco }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Agência</label>
                    <input type="text" class="form-control" name="dados[{{ $dado->id }}][agencia]" value="{{ $dado->agencia }}">
                </div>
            
                <div class="col-md-3">
                    <label class="form-label">Conta</label>
                    <input type="text" class="form-control" name="dados[{{ $dado->id }}][conta]" value="{{ $dado->conta }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Tipo de Conta</label>
                    <input type="text" class="form-control" name="dados[{{ $dado->id }}][tipo_conta]" value="{{ $dado->tipo_conta }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Telefone</label>
                    <input type="text" class="form-control" name="dados[{{ $dado->id }}][telefone]" value="{{ $dado->telefone }}">
                </div>
            </div>
            
            <hr>
            @endforeach
        </div>

        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
    </form>
</div>
