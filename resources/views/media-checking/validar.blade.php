<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Validar Mídia') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="row">
                        <div class="mb-1 col-2">
                            <label for="tipo_midia" class="form-label">Tipo de Mídia:</label>
                            <select id="tipo_midia" name="tipo_midia" class="form-control">
                                <option value="0">Selecione</option>
                                @foreach($tiposMidia as $tipo)
                                
                                <option value="{{ $tipo->id }}">{{ $tipo->descricao }}</option>
                                
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-1 col-2">
                            <label for="vertical" class="form-label">Verticais:</label>
                            <select id="vertical" name="vertical" class="form-control">
                                <option value="">...</option>
                            </select>
                        </div>
                        <div class="mb-1 col-4">
                            <label for="produto" class="form-label">Produto:</label>
                            <select id="produto" name="produto" class="form-control">
                                <option value="">...</option>
                            </select>
                        </div>
                        <div class="mb-1 col-4">
                            <label for="arquivo" class="form-label">Arquivo:</label>
                            <input type="file" name="arquivo" id="arquivo" accept="image/*,video/*" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="div_layout" class="row d-flex justify-content-center">
        <div id="div_modelo"></div>
        <div id="div_imagem">
            <img id="imagem_modal" src="" class="rounded mx-auto d-block" alt="" srcset="">
        </div>
    </div>

    <button type="button" style="display: none;" id="open-modal" data-bs-toggle="modal" data-bs-target="#exampleModal">Open</button>

    <link rel="stylesheet" href="{{ asset('css/midia-checking/layout.css') }}">
    <script src="{{ asset('js/midia-checking/validar_midia.js') }}"></script>
</x-app-layout>
