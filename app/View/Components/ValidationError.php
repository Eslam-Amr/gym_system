<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class ValidationError extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public string $filed)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.validation-error');
    }
}
