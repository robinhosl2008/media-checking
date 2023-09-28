<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Validar Mídia') }}
        </h2>
    </x-slot>
    
    <!-- <link rel="stylesheet" href="{{ asset('js/pdfjs-3.11.174/web/viewer.css') }}"> -->
    <script src="{{ asset('js/pdfjs-3.11.174/build/pdf.js') }}"></script>
    <script src="{{ asset('js/pdfjs-3.11.174/web/viewer.js') }}"></script>

    @if (session('msg'))
        <div class="alert alert-success">
            {{ session('msg') }}
        </div>

        <script>
            setTimeout(() => {
                document.querySelector('.alert').style.display = 'none';
            }, 5000);
        </script>
    @endif

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
                            <input type="file" name="arquivo" id="arquivo" accept="application/pdf,video/*" class="form-control">
                        </div>
                    </div>

                    
                </div>
            </div>
        </div>
    </div>

    <div class="py-12 div_checking">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="row div_layout">
                        <div class="col-9 d-flex justify-content-center">
                            <div class="div_modelo">
                                
                            </div>

                            <div class="div_imagem d-flex justify-content-center">
                                
                            </div>
                        
                            <div class="div_vidio">
                                
                            </div>
                        </div>

                        <div class="col-3 info-midia">
                            <div class="row">
                                <div class="col-12">
                                    <p>Nome do Arquivo:</p>
                                </div>
                                <div class="col-12">
                                    <label class="nome_arquivo" class="form-label"></label>
                                </div>
                            
                                <div class="col-12">
                                    <p>Tamanho da imagem:</p>
                                </div>
                                <div class="col-12">
                                    <label class="tamanho_arquivo" class="form-label"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    

    <button type="button" style="display: none;" id="open-modal" data-bs-toggle="modal" data-bs-target="#exampleModal">Open</button>

    <link rel="stylesheet" href="{{ asset('css/midia-checking/layout.css') }}">
    <script src="{{ asset('js/midia-checking/validar_midia.js') }}"></script>
</x-app-layout>
