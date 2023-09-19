<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/midia-checking/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/datatable/jquery.dataTables.min.css') }}">

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{ route('show-tipo-midia') }}">{{ __('Tipos de Mídia') }}</a> / Cadastro
        </h2>
    </x-slot>
  
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            <?php
            // echo "<pre>";
            // print_r($errors);
            // echo "</pre>";
            // exit();
            ?><?php 
    // print_r($errors->all()); exit(); 
    ?>
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
                    <form action="#" method="post" onsubmit="event.preventDefault();">
                        @csrf
                        
                        <div class="row">  
                            <div class="col-12">
                                <label for="nome" class="form-label">Nome:</label>
                                <input type="text" name="nome" id="nome" class="form-control" value="">
                                <p class="erro-input"><i>Campo obrigatório!</i></p>
                            </div>
                        </div>

                        <div class="mt-3 row">  
                            <div class="col-12 btn-rigth">
                                <button type="button" class="btn btn-sm btn-secondary" onclick="window.history.back();">Voltar</button>
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
