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
                    <button type="button" class="btn-novo-usuario btn btn-sm btn-laranja">Novo Vertical</button>    
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
                                <tr>
                                    <td>DOOH Embarcado</td>
                                    <td>Vídeo</td>
                                    <td>18/09/2023</td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group" aria-label="Grupo de Ações">
                                            <button type="button" class="btn btn-sm btn-secondary" title="Editar"><i class="bi-pen"></i></button>
                                            <button type="button" class="btn btn-sm btn-secondary" title="Remover"><i class="bi-x"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>DOOH Terminal</td>
                                    <td>Vídeo</td>
                                    <td>18/09/2023</td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group" aria-label="Grupo de Ações">
                                            <button type="button" class="btn btn-sm btn-secondary" title="Editar"><i class="bi-pen"></i></button>
                                            <button type="button" class="btn btn-sm btn-secondary" title="Remover"><i class="bi-x"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>OOH</td>
                                    <td>Imagem</td>
                                    <td>18/09/2023</td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group" aria-label="Grupo de Ações">
                                            <button type="button" class="btn btn-sm btn-secondary" title="Editar"><i class="bi-pen"></i></button>
                                            <button type="button" class="btn btn-sm btn-secondary" title="Remover"><i class="bi-x"></i></button>
                                        </div>
                                    </td>
                                </tr>
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
