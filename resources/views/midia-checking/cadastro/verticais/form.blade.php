<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/midia-checking/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/datatable/jquery.dataTables.min.css') }}">

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{ route('show-verticais') }}">{{ __('Verticais') }}</a> / Cadastro
        </h2>
    </x-slot>
  
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="barra-lista">
                       
                </div>

                <div class="p-6 text-gray-900">
                    <form action="#" method="post" onsubmit="event.preventDefault();">
                        @csrf
                        
                        <div class="row">  
                            <div class="col-8">
                                <label for="nome" class="form-label">Nome:</label>
                                <input type="text" name="nome" id="nome" class="form-control" value="">
                            </div>

                            <div class="col-4">
                                <label for="tipo_midia" class="form-label">Tipo de Mídia:</label>
                                <select name="tipo_midia" id="tipo_midia" class="form-control">
                                    <option value="0">Selecione</option>
                                    @foreach($tiposMidia as $tipoMidia)
                                    <option value="{{ $tipoMidia->id }}">{{ $tipoMidia->descricao }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mt-3 row">  
                            <div class="col-12 btn-rigth">
                                <button type="button" class="btn btn-sm btn-secondary" onclick="window.history.back();">Cancelar</button>
                                <button type="submit" class="btn btn-sm btn-laranja">Salvar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/midia-checking/cadastro/usuario.js') }}"></script>
</x-app-layout>
