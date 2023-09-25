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

    <!-- Filtro de Usuários -->
    <x-filtro-usuarios :params="$params"></x-filtro-usuarios>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="barra-lista">
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-sm btn-laranja" data-bs-toggle="modal" data-bs-target="#filtroUsuarios">Filtro</button>
                        <a href="{{ route('listar-usuario') }}" class="btn btn-sm btn-laranja"><i class="bi-trash"></i></a>
                    </div>
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
                                    <td>{{ $usuario->created_at->format("d/m/Y") }}</td>
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
                                                    `Tem certeza que deseja remover o usuário '{{ addslashes($usuario->name) }}'?`, 
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
                                    <td class="text-center" colspan="4">Sem registros!</td>
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
