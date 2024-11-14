<?php

namespace App\View\Components;

use Illuminate\View\Component;

class OfferCard extends Component
{
    public $offer;

    public function __construct($offer)
    {
        $this->offer = $offer;
    }

    public function render()
    {
        return view('components.offer-card');
    }
}