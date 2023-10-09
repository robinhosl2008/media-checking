<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/midia-checking/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/datatable/jquery.dataTables.min.css') }}">

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{ route('listar-verticais') }}">{{ __('Verticais') }}</a> / Criar
        </h2>
    </x-slot>
  
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error[1] }}</li>

                <script>
                    alertMessageId = `{{ $error[0] }}`;
                </script>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="barra-lista">
                       
                </div>

                <div class="p-6 text-gray-900">
                    <form action="{{ route('salvar-criacao-verticais') }}" method="post">
                        @csrf
                        
                        <div class="row">  
                            <div class="col-6">
                                <label for="nome" class="form-label">*Nome:</label>
                                <input type="text" name="nome" id="nome" class="form-control" value="{{ old('nome') }}">
                                <p class="erro-input"><i>Campo obrigatório!</i></p>
                            </div>
                            
                            <div class="col-4">
                                <label for="tipo_midia" class="form-label">*Tipo de Mídia:</label>
                                <select name="tipo_midia" id="tipo_midia" class="form-control">
                                    <option value="">Selecione</option>
                                    @foreach($tiposMidia as $tipoMidia)
                                    <option value="{{ $tipoMidia->id }}" <?php echo (old('tipo_midia') == $tipoMidia->id) ? 'selected' : ''; ?>>{{ $tipoMidia->descricao }}</option>
                                    @endforeach
                                </select>
                                <p class="erro-input"><i>Campo obrigatório!</i></p>
                            </div>
                            
                            <div class="col-2">
                                <label for="ativo_inativo" class="form-label">Ativo/Inativo:</label>
                                <select name="ativo_inativo" id="ativo_inativo" class="form-control">
                                    <option value="1">Ativo</option>
                                    <option value="0">Inativo</option>
                                </select>
                                <p class="erro-input"><i>Campo obrigatório!</i></p>
                            </div>
                        </div>

                        <div class="mt-3 row">  
                            <div class="col-12 btn-rigth">
                                <a href="{{ route('listar-verticais') }}" class="btn btn-sm btn-secondary">Voltar</a>
                                <button type="submit" class="btn btn-sm btn-laranja">Salvar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/midia-checking/cadastro/main.js') }}"></script>
</x-app-layout>
