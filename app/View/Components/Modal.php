<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Modal extends Component
{

    public $title;
    public $open;
    /**
     * Create a new component instance.
     */
    public function __construct($title = 'Modal', $open = false)
    {
        $this->title = $title;
        $this->open = $open;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modal-admin');
    }
}
