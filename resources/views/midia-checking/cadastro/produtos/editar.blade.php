<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/midia-checking/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/datatable/jquery.dataTables.min.css') }}">

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{ route('listar-produtos') }}">{{ __('Produtos') }}</a> / Editar
        </h2>
    </x-slot>
  
    @if ($errors->any())
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
                    <form action="{{ route('salvar-edicao-produtos') }}" method="post">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">  
                            <div class="col-8">
                                <label for="nome" class="form-label">*Nome:</label>
                                <input type="text" name="nome" id="nome" class="form-control" value="{{ (old('nome')) ? old('nome') : ($produto->descricao) ?? '' }}">
                                <p class="erro-input"><i>Campo obrigatório!</i></p>
                            </div>

                            <div class="col-4">
                                <label for="vertical" class="form-label">*Vertical:</label>
                                <select name="vertical" id="vertical" class="form-control">
                                    <option value="">Selecione</option>
                                    @foreach($verticais as $vertical)
                                    <option value="{{ $vertical->id }}" <?php echo (old('vertical') == $vertical->id) ? 'selected' : (($produto->vertical->id == $vertical->id) ? 'selected' : ''); ?>>{{ $vertical->descricao }}</option>
                                    @endforeach
                                </select>
                                <p class="erro-input"><i>Campo obrigatório!</i></p>
                            </div>
                        </div>

                        <div class="row mt-3">  
                            <div class="col-3">
                                <label for="area_lar" class="form-label">Área (Lar):</label>
                                <input type="text" name="area_lar" id="area_lar" class="form-control" value="{{ (old('area_lar')) ? old('area_lar') : ($produto->area_lar) ?? '' }}">
                            </div>
                            <div class="col-3">
                                <label for="area_alt" class="form-label">Área (Alt):</label>
                                <input type="text" name="area_alt" id="area_alt" class="form-control" value="{{ (old('area_alt')) ? old('area_alt') : ($produto->area_alt) ?? '' }}">
                            </div>
                            <div class="col-3">
                                <label for="visual_lar" class="form-label">*Visual (Lar):</label>
                                <input type="text" name="visual_lar" id="visual_lar" class="form-control" value="{{ (old('visual_lar')) ? old('visual_lar') : ($produto->visual_lar) ?? '' }}">
                                <p class="erro-input"><i>Campo obrigatório!</i></p>
                            </div>
                            <div class="col-3">
                                <label for="visual_alt" class="form-label">*Visual (Alt):</label>
                                <input type="text" name="visual_alt" id="visual_alt" class="form-control" value="{{ (old('visual_alt')) ? old('visual_alt') : ($produto->visual_alt) ?? '' }}">
                                <p class="erro-input"><i>Campo obrigatório!</i></p>
                            </div>
                        </div>

                        <div class="mt-3 row">  
                            <div class="col-12 btn-rigth">
                                <a href="{{ route('listar-produtos') }}" class="btn btn-sm btn-secondary">voltar</a>
                                <button type="submit" class="btn btn-sm btn-laranja">Salvar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/midia-checking/cadastro/main.js') }}"></script>
</x-app-layout>
