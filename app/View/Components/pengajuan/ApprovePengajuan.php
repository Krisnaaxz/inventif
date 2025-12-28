<?php

namespace App\View\Components\pengajuan;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ApprovePengajuan extends Component
{
    /**
     * Create a new component instance.
     */
    public $id, $route;
    public function __construct($id, $route)
    {
        $this->id = $id;
        $this->route = $route;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.pengajuan.approve-pengajuan');
    }
}