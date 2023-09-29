<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FiltroProduto extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public object $verticais,
        public array $params,
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.filtro-produto');
    }
}
