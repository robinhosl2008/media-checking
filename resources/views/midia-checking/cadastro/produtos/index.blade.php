<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/midia-checking/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/datatable/jquery.dataTables.min.css') }}">

    <script src="{{ asset('js/utils/confirm.js') }}"></script>
    <script>
        const confirm = new Confirm();
    </script>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Produtos') }}
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
    <x-filtro-produto :verticais="$verticais"></x-filtro-produto>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="barra-lista">
                    <button type="button" class="btn btn-sm btn-laranja" data-bs-toggle="modal" data-bs-target="#filtroProdutos">Filtro</button>
                    <a href="{{ route('criar-produtos') }}" class="btn-novo-usuario btn btn-sm btn-laranja">Novo Produto</a>    
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
                                @forelse($produtos as $produto)
                                <tr>
                                    <td>{{ $produto->descricao }}</td>
                                    <td class="text-center">{{ $produto->area_lar }}</td>
                                    <td class="text-center">{{ $produto->area_alt }}</td>
                                    <td class="text-center">{{ $produto->visual_lar }}</td>
                                    <td class="text-center">{{ $produto->visual_alt }}</td>
                                    <td class="text-center">{{ $produto->vertical->descricao }}</td>
                                    <td class="text-center">{{ DateTime::createFromFormat('Y-m-d H:m:s', $produto->created_at)->format("d/m/Y") }}</td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group" aria-label="Grupo de Ações">
                                            <a href="{{ route('editar-produtos', ['id' => $produto->id]) }}" class="btn btn-sm btn-secondary" title="Editar">
                                                <i class="bi-pen"></i>
                                            </a>
                                            <form action="{{ route('remover-produtos') }}" method="post">
                                                @csrf
                                                @method('PUT')

                                                <input type="hidden" name="_method" value="delete"/>
                                                <input type="hidden" name="id" value="{{ $produto->id }}">
                                                <button type="button" class="btn btn-sm btn-secondary" title="Remover"  data-bs-toggle="modal" data-bs-target="#confirm-modal"
                                                onclick="confirm.exibeModalConfirme(
                                                    `Tem certeza que deseja remover o produto '{{ addslashes($produto->descricao) }}'?`, 
                                                    this.form
                                                );">
                                                    <i class="bi-x"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="8">Sem registros!</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/midia-checking/cadastro/main.js') }}"></script>
    <script src="{{ asset('js/midia-checking/cadastro/produto.js') }}"></script>
    <script src="{{ asset('js/datatable/jquery.dataTables.min.js') }}"></script>
</x-app-layout>
