<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/midia-checking/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/datatable/jquery.dataTables.min.css') }}">

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{ route('show-produtos') }}">{{ __('Produtos') }}</a> / Cadastro
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
                                <label for="vertical" class="form-label">Vertical:</label>
                                <select name="vertical" id="vertical" class="form-control">
                                    <option value="0">Selecione</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mt-3">  
                            <div class="col-3">
                                <label for="area_lar" class="form-label">Área (Lar):</label>
                                <input type="text" name="area_lar" id="area_lar" class="form-control" value="">
                            </div>
                            <div class="col-3">
                                <label for="area_alt" class="form-label">Área (Alt):</label>
                                <input type="text" name="area_alt" id="area_alt" class="form-control" value="">
                            </div>
                            <div class="col-3">
                                <label for="visual_lar" class="form-label">Visual (Lar):</label>
                                <input type="text" name="visual_lar" id="visual_lar" class="form-control" value="">
                            </div>
                            <div class="col-3">
                                <label for="visual_alt" class="form-label">Visual (Alt):</label>
                                <input type="text" name="visual_alt" id="visual_alt" class="form-control" value="">
                            </div>
                        </div>

                        <div class="mt-3 row">  
                            <div class="col-12 btn-rigth">
                                <button type="button" class="btn btn-sm btn-secondary" onclick="window.history.back();">voltar</button>
                                <button type="submit" class="btn btn-sm btn-laranja">Salvar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/midia-checking/cadastro/verticais.js') }}"></script>
</x-app-layout>
