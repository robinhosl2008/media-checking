<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/midia-checking/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/datatable/jquery.dataTables.min.css') }}">

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Produtos') }}
        </h2>
    </x-slot>
  
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="barra-lista">
                <a href="{{ route('new-produtos') }}" class="btn-novo-usuario btn btn-sm btn-laranja">Novo Produto</a>    
                </div>

                <div class="p-6 text-gray-900">
                    <div class="row">  
                        <table id="myTable" class="table hover">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th class="text-center">Área (Lar)</th>
                                    <th class="text-center">Área (Alt)</th>
                                    <th class="text-center">Visual (Lar)</th>
                                    <th class="text-center">Visual (Alt)</th>
                                    <th class="text-center">Vertical</th>
                                    <th class="text-center">Data de Cadastro</th>
                                    <th class="text-center" style="width: 10%;">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Bilheteria (Frente)</td>
                                    <td class="text-center">2.92</td>
                                    <td class="text-center">1.68</td>
                                    <td class="text-center">2.92</td>
                                    <td class="text-center">1.68</td>
                                    <td class="text-center">OOH</td>
                                    <td class="text-center">18/09/2023</td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group" aria-label="Grupo de Ações">
                                            <button type="button" class="btn btn-sm btn-secondary" title="Editar"><i class="bi-pen"></i></button>
                                            <button type="button" class="btn btn-sm btn-secondary" title="Remover"><i class="bi-x"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Testeiras (Campo Grande)</td>
                                    <td class="text-center">410</td>
                                    <td class="text-center">140</td>
                                    <td class="text-center">410</td>
                                    <td class="text-center">140</td>
                                    <td class="text-center">DOOH Terminais</td>
                                    <td class="text-center">18/09/2023</td>
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

    <script src="{{ asset('js/midia-checking/cadastro/usuario.js') }}"></script>
    <script src="{{ asset('js/datatable/jquery.dataTables.min.js') }}"></script>
</x-app-layout>
