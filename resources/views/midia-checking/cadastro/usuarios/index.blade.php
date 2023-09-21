<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/midia-checking/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/datatable/jquery.dataTables.min.css') }}">

    <script src="{{ asset('js/utils/confirm.js') }}"></script>
    <script>
        const confirm = new Confirm();
    </script>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Usuários') }}
        </h2>
    </x-slot>
  
    <!-- Modal -->
    <div class="modal fade" id="confirm-modal" tabindex="-1" aria-labelledby="confirm-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirm-modalLabel">Confirme sua ação</h5>
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                </div>
                <div class="modal-body">
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
                    <button type="button" class="btn btn-primary btn-sim">Sim</button>
                </div>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="barra-lista">
                    <a href="{{ route('criar-usuario') }}" class="btn-novo-usuario btn btn-sm btn-laranja">Novo Usuário</a>    
                </div>

                <div class="p-6 text-gray-900">
                    <div class="row">  
                        <table id="myTable" class="table hover">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>E-mail</th>
                                    <th>Data de Cadastro</th>
                                    <th class="text-center" style="width: 10%;">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($usuarios as $usuario)
                                <tr>
                                    <td>{{ $usuario->name }}</td>
                                    <td>{{ $usuario->email }}</td>
                                    <td>{{ $usuario->created_at }}</td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group" aria-label="Grupo de Ações">
                                            <a href="{{ route('editar-usuario', ['id' => $usuario->id]) }}" class="btn btn-sm btn-secondary" title="Editar">
                                                <i class="bi-pen"></i>
                                            </a>
                                            <form action="{{ route('remover-usuario') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="_method" value="delete"/>
                                                <input type="hidden" name="id" value="{{ $usuario->id }}">
                                                <button type="button" class="btn btn-sm btn-secondary" title="Remover"  data-bs-toggle="modal" data-bs-target="#confirm-modal"
                                                onclick="confirm.exibeModalConfirme(
                                                    'Tem certeza que deseja remover o usuário {{ addslashes($usuario->name) }}?', 
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
    <script src="{{ asset('js/midia-checking/cadastro/usuario.js') }}"></script>
    <script src="{{ asset('js/datatable/jquery.dataTables.min.js') }}"></script>
</x-app-layout>
