<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/midia-checking/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/datatable/jquery.dataTables.min.css') }}">

    <script src="{{ asset('js/utils/confirm.js') }}"></script>
    <script>
        const confirm = new Confirm();
    </script>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tipos de Mídia') }}
        </h2>
    </x-slot>
    
    @if (session('msg'))
        <div class="alert alert-{{session('typeMessage')}}">
            {{ session('msg') }}
        </div>

        <script>
            setTimeout(() => {
                document.querySelector('.alert').style.display = 'none';
            }, 10000);
        </script>
    @endif

    <!-- Modal de Confirmação -->
    <x-confirm></x-confirm>
<?php
// var_dump($params); exit();
?>
    <!-- Filtro de Tipos de Mídia -->
    <x-filtro-tipo-midia :params="$params"></x-filtro-tipo-midia>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="barra-lista">
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-sm btn-laranja" data-bs-toggle="modal" data-bs-target="#filtroTipoMidia">Filtro</button>
                        <a href="{{ route('listar-tipo-midia') }}" class="btn btn-sm btn-laranja"><i class="bi-trash"></i></a>
                    </div>
                    <a href="{{ route('criar-tipo-midia') }}" class="btn-novo-tipo-midia btn btn-sm btn-laranja">Novo Tipo de Mídia</a>    
                </div>

                <div class="p-6 text-gray-900">
                    <div class="row">  
                        <table id="myTable" class="table hover">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Data de Cadastro</th>
                                    <th class="text-center" style="width: 10%;">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($tiposMidia as $tipoMidia)
                                <tr>
                                    <td>{{ $tipoMidia->descricao }}</td>
                                    <td>{{ $tipoMidia->created_at->format('d/m/Y') }}</td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group" aria-label="Grupo de Ações">
                                            <a href="{{ route('editar-tipo-midia', ['id' => $tipoMidia->id]) }}" class="btn btn-sm btn-secondary" title="Editar">
                                                <i class="bi-pen"></i>
                                            </a>
                                            <form action="{{ route('remover-tipo-midia') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="_method" value="delete"/>
                                                <input type="hidden" name="id" value="{{ $tipoMidia->id }}">
                                                <button type="button" class="btn btn-sm btn-secondary" title="Remover"  data-bs-toggle="modal" data-bs-target="#confirm-modal"
                                                onclick="confirm.exibeModalConfirme(
                                                    `Tem certeza que deseja remover o tipo de mídia '{{ addslashes($tipoMidia->descricao) }}'?`, 
                                                    this.form
                                                );">
                                                    <i class="bi-x"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3">Sem registros!</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/midia-checking/cadastro/main.js') }}"></script>
    <script src="{{ asset('js/midia-checking/cadastro/tipo-midia.js') }}"></script>
    <script src="{{ asset('js/datatable/jquery.dataTables.min.js') }}"></script>
</x-app-layout>
