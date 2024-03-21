<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class MiLayout extends Component
{

    public function __construct(public string $titulo)
    {
        // $this->titulo = $titulo;
    }
    
    public function render(): View|Closure|string
    {
        return view('components.miLayout');
    }
}
