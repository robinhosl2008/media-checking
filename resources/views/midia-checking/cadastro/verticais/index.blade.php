<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/midia-checking/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/datatable/jquery.dataTables.min.css') }}">

    <script src="{{ asset('js/utils/confirm.js') }}"></script>
    <script>
        const confirm = new Confirm();
    </script>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Verticais') }}
        </h2>
    </x-slot>
    
    @if (session('msg'))
        <div class="alert alert-success">
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

    <!-- Filtro de Tipos de Mídia -->
    <x-filtro-vertical :tiposMidia="$tiposMidia" :params="$params"></x-filtro-vertical>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="barra-lista">
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-sm btn-laranja" data-bs-toggle="modal" data-bs-target="#filtroVerticais">Filtro</button>
                        <a href="{{ route('listar-verticais') }}" class="btn btn-sm btn-laranja"><i class="bi-trash"></i></a>
                    </div>
                    <a href="{{ route('criar-verticais') }}" class="btn-nova-vertical btn btn-sm btn-laranja">Novo Vertical</a>    
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
                                    <td>{{ DateTime::createFromFormat('Y-m-d H:m:s', $vertical->created_at)->format("d/m/Y") }}</td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group" aria-label="Grupo de Ações">
                                            <a href="{{ route('editar-verticais', ['id' => $vertical->id]) }}" class="btn btn-sm btn-secondary" title="Editar">
                                                <i class="bi-pen"></i>
                                            </a>
                                            <form action="{{ route('remover-verticais') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="_method" value="delete"/>
                                                <input type="hidden" name="id" value="{{ $vertical->id }}">
                                                <button type="button" class="btn btn-sm btn-secondary" title="Remover"  data-bs-toggle="modal" data-bs-target="#confirm-modal"
                                                onclick="confirm.exibeModalConfirme(
                                                    `Tem certeza que deseja remover a vertical '{{ addslashes($vertical->descricao) }}'?`, 
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

    <script src="{{ asset('js/midia-checking/cadastro/main.js') }}"></script>
    <script src="{{ asset('js/midia-checking/cadastro/tipo-midia.js') }}"></script>
    <script src="{{ asset('js/datatable/jquery.dataTables.min.js') }}"></script>
</x-app-layout>
