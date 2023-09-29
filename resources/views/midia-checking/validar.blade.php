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
                        <div class="mb-1 col-3">
                            <label for="vertical" class="form-label">Verticais:</label>
                            <select id="vertical" name="vertical" class="form-control">
                                <option value="0">Selecione</option>
                                @foreach($verticais as $vertical)
                                <option value="{{ $vertical->id }}">{{ $vertical->descricao }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-1 col-4">
                            <label for="produto" class="form-label">Produto:</label>
                            <select id="produto" name="produto" class="form-control">
                                <option value="">...</option>
                            </select>
                        </div>
                        <div class="mb-1 col-5">
                            <label for="arquivo" class="form-label">Arquivo:</label>
                            <input type="file" name="arquivo" id="arquivo" accept="application/pdf,video/mp4" class="form-control">
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
                        <div class="col-8 d-flex justify-content-center" style="overflow: hidden; position: inherit; height: 600px; padding: 10px; align-items: center;">
                            <div class="div_modelo">
                                
                            </div>

                            <div class="div_imagem d-flex justify-content-center">
                                
                            </div>

                            <style>
                                .div_video {
                                    position: absolute;
                                }
                            </style>
                        
                            <div class="div_video d-flex justify-content-center">
                                <video width="640" height="360" controls>
                                    <source src="seu_video.mp4" type="video/mp4">
                                    Seu navegador não suporta o elemento de vídeo.
                                </video>
                            </div>
                        </div>

                        <div class="col-4 info-midia">
                            <div class="row">
                                <div class="col-12" style="overflow: hidden; text-wrap: nowrap;">
                                    <p>Produto: <label class="nome_produto" class="form-label"></label></p>
                                </div>

                                <div class="col-12">
                                    <p>Dimenções Requeridas (LxA): <label class="tamanho_requerido" class="form-label"></label></p>
                                </div>

                                <div class="col-12">
                                    <hr>
                                </div>
                                
                                <div class="col-12" style="overflow: hidden; text-wrap: nowrap;">
                                    <p>Arquivo: <label class="nome_arquivo" class="form-label"></label></p>
                                </div>

                                <div class="col-12">
                                    <p>Tamanho: <label class="tamanho_mb" class="form-label"></label></p>
                                </div>
                            
                                <div class="col-12">
                                    <p>Dimenções da Imagem (LxA): <label class="tamanho_arquivo" class="form-label"></label></p>
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
