<?php

namespace App\Http\Controllers\TipoMidia;

use App\Http\Controllers\Controller;
use App\Services\ProcTipoMidia;
use App\Http\Requests\TipoMidia\{
    RemoverTipoMidiaRequest, 
    SalvarTipoMidiaRequest,
    EditarTipoMidiaRequest
};
use Illuminate\Http\{
    RedirectResponse,
    Request
};
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Exception;
use DateTime;

class TipoMidiaController extends Controller
{
    private ProcTipoMidia $proc;

    public function __construct()
    {
        $this->proc = new ProcTipoMidia();
    }

    public function buscar(Request $request)
    {
        $params = [
            'id'        => ($request->id) ?? '',
            'descricao' => ($request->nome) ?? '',
            'dt_inicio' => ($request->dt_inicio) ?? '',
            'dt_fim'    => ($request->dt_fim) ?? '',
        ];
        
        $tiposMidia = $this->proc->buscar($params)->get();

        if ($request->getMethod() == 'POST') {
            return view('midia-checking.cadastro.tipos-midia.index', [
                'tiposMidia' => $tiposMidia,
                'params' => $params
            ]);
        } else {
            return $tiposMidia;
        }
    }

    public function listar(Request $request): View
    {
        $tiposMidia = $this->buscar($request);
        
        return view('midia-checking.cadastro.tipos-midia.index', [
            'tiposMidia' => $tiposMidia,
            'params' => []
        ]);
    }

    public function criar(): View
    {
        $tipoMidia = null;

        return view('midia-checking.cadastro.tipos-midia.criar', [
            'tipoMidia' => $tipoMidia
        ]);
    }

    public function editar(Request $request): View
    {
        $tipoMidia = null;
        if ($request->id) {
            $tipoMidia = $this->buscar($request)->first();
        }

        return view('midia-checking.cadastro.tipos-midia.editar', [
            'tipoMidia' => $tipoMidia
        ]);
    }

    public function salvarCriacao(SalvarTipoMidiaRequest $request)
    {
        $validated = $request->validated();

        try {
            DB::beginTransaction();

            $this->proc->salvarTipoMidia($validated);

            DB::commit();

            return redirect('/cadastro/tipo-midia')
                ->with('typeMessage', 'success')
                ->with('msg', 'Tipo de mídia cadastrado.');
        } catch(Exception $e) {
            DB::rollBack();

            return redirect('/cadastro/tipo-midia')
                ->with('typeMessage', 'warning')
                ->with('msg', 'Um erro ocorreu ao tentar salvar o tipo de mídia. ' . $e->getMessage());
        }
    }

    public function salvarEdicao(EditarTipoMidiaRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        
        try {
            DB::beginTransaction();

            $this->proc->editaTipoMidia($validated);

            DB::commit();

            return redirect('/cadastro/tipo-midia')
                ->with('typeMessage', 'success')
                ->with('msg', 'Tipo de mídia editado.');
        } catch(Exception $e) {
            DB::rollBack();

            return redirect('/cadastro/tipo-midia')
                ->with('typeMessage', 'warning')
                ->with('msg', 'Um erro ocorreu ao tentar editar o tipo de mídia. ' . $e->getMessage());
        }
    }

    public function removerTipoMidia(RemoverTipoMidiaRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        try {
            DB::beginTransaction();

            $this->proc->removeTipoMidia($validated);

            DB::commit();

            return redirect('/cadastro/tipo-midia')
                ->with('typeMessage', 'success')
                ->with('msg', 'Tipo de mídia removido.');
        } catch(Exception $e) {
            DB::rollBack();

            return redirect('/cadastro/tipo-midia')
                ->with('typeMessage', 'warning')
                ->with('msg', 'Um erro ocorreu ao tentar remover o tipo de mídia. ' . $e->getMessage());
        }
    }
}