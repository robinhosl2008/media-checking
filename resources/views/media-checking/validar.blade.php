<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Validar Mídia') }}
        </h2>
    </x-slot>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="div_layout" class="modal-body">
                    <div id="content_modelo" class="row d-flex justify-content-center">
                        <div id="div_modelo"></div>
                    </div>
                    <div id="div_imagem">
                        <img id="imagem_modal" src="{{ asset('img/picole.png') }}" class="rounded mx-auto d-block" alt="" srcset="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

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
                        <div class="mb-1 col-3">
                            <label for="vertical" class="form-label">Verticais:</label>
                            <select id="vertical" name="vertical" class="form-control">
                                <option value="">...</option>
                            </select>
                        </div>
                        <div class="mb-1 col-2">
                            <label for="produto" class="form-label">Produto:</label>
                            <select id="produto" name="produto" class="form-control">
                                <option value="">...</option>
                            </select>
                        </div>
                        <div class="mb-1 col-4">
                            <label for="arquivo" class="form-label">Arquivo:</label>
                            <input type="file" name="arquivo" id="arquivo" class="form-control">
                        </div>
                        <div class="mb-1 col-1">
                            <button type="button" onclick="validarFormulario()" class="btn laranja btn-laranja-validar">
                                Validar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-1">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                
            </div>
        </div>
    </div>

    <button type="button" style="display: none;" id="open-modal" data-bs-toggle="modal" data-bs-target="#exampleModal">Open</button>

    <link rel="stylesheet" href="{{ asset('css/midia-checking/layout.css') }}">
    <script src="{{ asset('js/midia-checking/validar_midia.js') }}"></script>
</x-app-layout>
