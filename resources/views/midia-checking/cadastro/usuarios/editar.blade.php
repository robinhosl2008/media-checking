<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/midia-checking/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/datatable/jquery.dataTables.min.css') }}">

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{ route('listar-usuario') }}">{{ __('Usuários') }}</a> / Edição
        </h2>
    </x-slot>

    @if ($errors->any() && is_array($errors->all()[0]))
    <div class="alert alert-danger">
        <ul>
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
                    <form method="POST" action="{{ route('salvar-edicao-usuario') }}">
                        @method('PUT')
                        @csrf

                        <input type="hidden" id="id" name="id" value="{{ ($usuario->id) ?? '' }}">
                        
                        <div class="row">  
                            <div class="col-6">
                                <label for="nome" class="form-label">*Nome:</label>
                                <input type="text" name="nome" id="nome" class="form-control" value="{{ ($usuario->name) ?? old('nome') }}">
                                <p class="erro-input"><i>Campo obrigatório!</i></p>
                            </div>

                            <div class="col-6">
                                <label for="email" class="form-label">*E-mail:</label>
                                <input type="text" name="email" id="email" class="form-control" value="{{ ($usuario->email) ?? old('email') }}">
                                <p class="erro-input"><i>Campo obrigatório!</i></p>
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
                                <p class="erro-input"><i>Campo obrigatório!</i></p>
                            </div> -->

                            @if(!is_array($usuario) && $usuario->id)
                            <div class="row" style="margin: auto;">
                                <hr>
                                <div class="mb-3 form-check">
                                    <label for="troca_senha" class="form-check-label">Deseja trocar a senha? </label>
                                    <input type="checkbox" name="troca_senha" id="troca_senha" class="form-check-input" {{ (old('troca_senha') == 1) ? 'checked' : '' }} value="1">
                                </div>
                            </div>
                            @endif

                            <div class="col-6 input-troca-senha" style="{{ (old('troca_senha') == 1) ? 'display: block;' : '' }}">
                                <label for="senha" class="form-label">*Senha:</label>
                                <input type="text" name="senha" id="senha" class="form-control" value="{{ old('senha') }}">
                                <p class="erro-input"><i>Campo obrigatório!</i></p>
                            </div>

                            <div class="col-6 input-troca-senha" style="{{ (old('troca_senha') == 1) ? 'display: block;' : '' }}">
                                <label for="confirma_senha" class="form-label">*Confirme sua Senha:</label>
                                <input type="password" name="confirma_senha" id="confirma_senha" class="form-control" value="{{ old('confirma_senha') }}">
                                <p class="erro-input"><i>Campo obrigatório!</i></p>
                            </div>
                        </div>

                        <div class="mt-3 row">  
                            <div class="col-12 btn-rigth">
                                <a href="{{ route('listar-usuario') }}" class="btn btn-sm btn-secondary">Voltar</a>
                                <button type="submit" class="btn btn-sm btn-laranja">Salvar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/midia-checking/cadastro/usuario.js') }}"></script>
    <script src="{{ asset('js/midia-checking/cadastro/main.js') }}"></script>

    <script>
        const usuario = new Usuario();
        let usuarioId = usuario.buscaIdUsuario();
        if (!usuarioId) {
            exibirInputs(inputs);
        }
    </script>
</x-app-layout>
