<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/midia-checking/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/datatable/jquery.dataTables.min.css') }}">

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{ route('show-usuario') }}">{{ __('Usuários') }}</a> / Cadastro
        </h2>
    </x-slot>
  
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="barra-lista">
                       
                </div>

                <div class="p-6 text-gray-900">
                    <form action="#" method="post" onsubmit="event.preventDefault();">
                        @csrf
                        
                        <div class="row">  
                            <div class="col-6">
                                <label for="nome" class="form-label">Nome:</label>
                                <input type="text" name="nome" id="nome" class="form-control" value="">
                            </div>

                            <div class="col-6">
                                <label for="email" class="form-label">E-mail:</label>
                                <input type="text" name="email" id="email" class="form-control" value="">
                            </div>
                        </div>

                        <div class="row mt-3">
                            <!-- <div class="col-6">
                                <label for="perfil" class="form-label">Perfil:</label>1
                                <select name="perfil" id="perfil">
                                    <option value="0">Selecione</option>
                                    <option value="1">Administrador</option>
                                    <option value="2">Visitante</option>
                                </select>
                            </div> -->

                            <div class="col-6">
                                <label for="senha" class="form-label">Senha:</label>
                                <input type="text" name="senha" id="senha" class="form-control" value="">
                            </div>

                            <div class="col-6">
                                <label for="confirma_senha" class="form-label">Confirme sua Senha:</label>
                                <input type="password" name="confirma_senha" id="confirma_senha" class="form-control" value="">
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

    <script src="{{ asset('js/midia-checking/cadastro/usuario.js') }}"></script>
</x-app-layout>
