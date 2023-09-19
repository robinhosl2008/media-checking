<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/midia-checking/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/datatable/jquery.dataTables.min.css') }}">

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Verticais') }}
        </h2>
    </x-slot>
  
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="barra-lista">
                <a href="{{ route('new-verticais') }}" class="btn-nova-vertical btn btn-sm btn-laranja">Novo Vertical</a>    
                </div>

                <div class="p-6 text-gray-900">
                    <div class="row">  
                        <table id="myTable" class="table hover">
                            <thead>
                                <tr>
                                    <th>Vertical</th>
                                    <th>Tipo de Mídia</th>
                                    <th>Data de Cadastro</th>
                                    <th class="text-center" style="width: 10%;">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($verticais as $vertical)
                                <tr>
                                    <td>{{ $vertical->descricao }}</td>
                                    <td>{{ $vertical->tipoMidia->descricao }}</td>
                                    <td>{{ $vertical->created_at }}</td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group" aria-label="Grupo de Ações">
                                            <button type="button" class="btn btn-sm btn-secondary" title="Editar"><i class="bi-pen"></i></button>
                                            <button type="button" class="btn btn-sm btn-secondary" title="Remover"><i class="bi-x"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4">Sem registros!</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/midia-checking/cadastro/tipo-midia.js') }}"></script>
    <script src="{{ asset('js/datatable/jquery.dataTables.min.js') }}"></script>
</x-app-layout>
