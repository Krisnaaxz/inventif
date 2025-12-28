<?php

namespace App\View\Components\pengajuan;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CancelPengajuan extends Component
{
    /**
     * Create a new component instance.
     */
    public $id, $route;
    public function __construct($id, $route, $action)
    {
        $this->id = $id;
        $this->route = route($route, ['action' => $action, 'id' => $id]);
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.pengajuan.cancel-pengajuan');
    }
}
