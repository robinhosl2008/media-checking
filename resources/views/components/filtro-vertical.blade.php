<div>
    <div class="modal fade" id="filtroVerticais" tabindex="-1" aria-labelledby="filtroVerticais" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('buscar-verticais') }}" method="post">
                    @csrf
                    
                    <div class="modal-header">
                        <h5 class="modal-title" id="filtroVerticais">Buscar Tipos de Mídia</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <label for="nome" class="form-label">Nome:</label>
                                <input type="text" name="nome" id="nome" class="form-control" value="{{ (array_key_exists('descricao', $params)) ? $params['descricao'] : '' }}">
                            </div>
                            <div class="col-12">
                                <label for="tipo_midia" class="form-label">Tipo de Mídia:</label>
                                <select name="tipo_midia" id="tipo_midia" class="form-control" value="{{ (array_key_exists('tipo_midia_id', $params)) ? $params['tipo_midia_id'] : '' }}">
                                    <option value="">Selecione</option>
                                    @foreach($tiposMidia as $tipo)
                                    <option value="{{ $tipo->id }}">{{ $tipo->descricao }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="dt_inicio" class="form-label">Data Início:</label>
                                <input type="date" name="dt_inicio" id="dt_inicio" class="form-control" value="{{ (array_key_exists('dt_inicio', $params)) ? $params['dt_inicio'] : '' }}">
                            </div>
                            <div class="col-12">
                                <label for="dt_fim" class="form-label">Data Fim:</label>
                                <input type="date" name="dt_fim" id="dt_fim" class="form-control" value="{{ (array_key_exists('dt_inicio', $params)) ? $params['dt_fim'] : '' }}">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-sm btn-laranja">Buscar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>