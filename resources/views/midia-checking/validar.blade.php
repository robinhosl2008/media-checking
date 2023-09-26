<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Validar Mídia') }}
        </h2>
    </x-slot>
    
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

                    <div class="row mt-3 info-midia">
                        <hr>

                        <div class="mb-1 col-7 nome">
                            Nome do Arquivo: <label class="nome_arquivo" class="form-label"></label>
                        </div>
                        <div class="mb-1 col-5 tamanho">
                            Tamanho (largura x altura): <label class="tamanho_arquivo" class="form-label"></label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="div_layout" class="row d-flex justify-content-center">
        <div id="div_modelo">
            <button id="x" 
                onclick="document.getElementById('div_imagem').style.display = 'none';
                document.getElementById('div_modelo').style.display = 'none';" 
                class="btn btn-sm btn-primary">
                <i class="bi-x-circle"></i>
            </button>
        </div>

        <div id="div_imagem">
            <img id="imagem_modal" src="" class="rounded mx-auto d-block" alt="" srcset="">
            
            <video
                id="my-player"
                class="video-js"
                controls
                autoplay="true"
                preload="auto"
                poster="{{ asset('img/Logo_ONBUS-final.png') }}"
                data-setup='{}'>
                <source src="//vjs.zencdn.net/v/oceans.mp4" type="video/mp4"></source>
                <source src="//vjs.zencdn.net/v/oceans.webm" type="video/webm"></source>
                <source src="//vjs.zencdn.net/v/oceans.ogv" type="video/ogg"></source>
                <p class="vjs-no-js">
                    To view this video please enable JavaScript, and consider upgrading to a
                    web browser that
                    <a href="https://videojs.com/html5-video-support/" target="_blank">
                    supports HTML5 video
                    </a>
                </p>
            </video>
        </div>
    </div>

    

    <button type="button" style="display: none;" id="open-modal" data-bs-toggle="modal" data-bs-target="#exampleModal">Open</button>

    <link rel="stylesheet" href="{{ asset('css/midia-checking/layout.css') }}">
    <script src="{{ asset('js/midia-checking/validar_midia.js') }}"></script>
</x-app-layout>
