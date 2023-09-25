<div>
    <div class="modal fade" id="filtroProdutos" tabindex="-1" aria-labelledby="filtroProdutos" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="filtroProdutos">Buscar Tipos de Mídia</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <label for="nome" class="form-label">Nome:</label>
                            <input type="text" name="nome" id="nome" class="form-control" value="">
                        </div>
                        <div class="col-12">
                            <label for="tipo_midia" class="form-label">Vertical:</label>
                            <select name="tipo_midia" id="tipo_midia" class="form-control" value="">
                                <option value="">Selecione</option>
                                @foreach($verticais as $vertical)
                                <option value="{{ $vertical->id }}">{{ $vertical->descricao }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="dt_inicio" class="form-label">Data Início:</label>
                            <input type="date" name="dt_inicio" id="dt_inicio" class="form-control" value="">
                        </div>
                        <div class="col-12">
                            <label for="dt_fim" class="form-label">Data Fim:</label>
                            <input type="date" name="dt_fim" id="dt_fim" class="form-control" value="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-sm btn-laranja">Buscar</button>
                </div>
            </div>
        </div>
    </div>
</div>