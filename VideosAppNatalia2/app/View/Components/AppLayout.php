<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Contracts\View\View as ViewContract;

class AppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render(): ViewContract
    {
        return view('layouts.app');
    }
}
