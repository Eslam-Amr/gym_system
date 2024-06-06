<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class DisplayPriceAfterDiscount extends Component
{
    public $priceAfterDiscount=0;
    /**
     * Create a new component instance.
     */
    public function __construct(public  $price ,public  $discount)
    {
$this->priceAfterDiscount=$price*(1-($discount/100));
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.display-price-after-discount');
    }
}
