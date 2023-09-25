<?php

namespace App\Http\Controllers\Verticais;

use App\Http\Controllers\Controller;
use App\Services\ProcTipoMidia;
use App\Services\ProcVertical;
use App\Http\Requests\Vertical\{
    SalvarVerticalRequest,
    EditarVerticalRequest,
    RemoverVerticalRequest
};
use Illuminate\Http\{
    RedirectResponse,
    Request
};
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Exception;

class VerticalController extends Controller
{
    private ProcVertical $proc;
    private ProcTipoMidia $procTipoMidia;

    public function __construct()
    {
        $this->proc = new ProcVertical();
        $this->procTipoMidia = new ProcTipoMidia();
    }

    public function buscar(Request $request)
    {
        $params = [
            'id'            => ($request->id) ?? '',
            'tipo_midia_id' => ($request->tipo_midia_id) ?? '',
            'descricao'     => ($request->descricao) ?? ''
        ];
        
        return $this->proc->buscar($params)->get();
    }

    public function listar(Request $request): View
    {
        $verticais = $this->buscar($request);
        $tiposMidia = $this->procTipoMidia->buscar()->get();

        return view('midia-checking.cadastro.verticais.index', [
            'verticais' => $verticais,
            'tiposMidia' => $tiposMidia
        ]);
    }

    public function criar(): View
    {
        $tiposMidia = $this->procTipoMidia->buscar()->get();

        return view('midia-checking.cadastro.verticais.criar', [
            'tiposMidia' => $tiposMidia,
            'vertical' => null
        ]);
    }

    public function editar(Request $request): View
    {
        $vertical = null;
        if ($request->id) {
            $vertical = $this->buscar($request)->first();
        }

        $tiposMidia = $this->procTipoMidia->buscar()->get();

        return view('midia-checking.cadastro.verticais.editar', [
            'tiposMidia' => $tiposMidia,
            'vertical' => $vertical
        ]);
    }

    public function salvarCriacao(SalvarVerticalRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        try {
            DB::beginTransaction();

            $this->proc->salvarVertical($validated);

            DB::commit();

            return redirect('/cadastro/verticais')
                ->with('typeMessage', 'success')
                ->with('msg', 'Vertical cadastrada.');
        } catch(Exception $e) {
            DB::rollBack();

            return redirect('/cadastro/verticais')
                ->with('typeMessage', 'warning')
                ->with('msg', 'Um erro ocorreu ao tentar salvar a vertical. ' . $e->getMessage());
        }
    }

    public function salvarEdicao(EditarVerticalRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        try {
            DB::beginTransaction();

            $this->proc->editaVertical($validated);

            DB::commit();

            return redirect('/cadastro/verticais')
                ->with('typeMessage', 'success')
                ->with('msg', 'Vertical editada.');
        } catch(Exception $e) {
            DB::rollBack();

            return redirect('/cadastro/verticais')
                ->with('typeMessage', 'warning')
                ->with('msg', 'Um erro ocorreu ao tentar editar a vertical. ' . $e->getMessage());
        }
    }

    public function removerVertical(RemoverVerticalRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        try {
            DB::beginTransaction();

            $this->proc->removeVertical($validated);

            DB::commit();

            return redirect('/cadastro/verticais')
                ->with('typeMessage', 'success')
                ->with('msg', 'Vertical removida.');
        } catch(Exception $e) {
            DB::rollBack();

            return redirect('/cadastro/verticais')
                ->with('typeMessage', 'warning')
                ->with('msg', 'Um erro ocorreu ao tentar remover a vertical. ' . $e->getMessage());
        }
    }
}
