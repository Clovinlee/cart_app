<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Request;

class AppLayout extends Component
{
    /**
     * Create a new component instance.
     */

    public $currentRoute;
    public $navLink;

    public function __construct()
    {
        //
        $this->currentRoute = ucwords(Request::path());
        if ($this->currentRoute == "/") {
            $this->currentRoute = "Home";
        }

        $this->navLink = [
            "Home" => "/",
            "Shop" => "/shop",
            "Cart" => "/cart",
            "Form" => "/form",
            "Websocket" => "/websocket",
            "Websocket-listen" => "/websocket-listen",
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('layout.app-layout');
    }
}
