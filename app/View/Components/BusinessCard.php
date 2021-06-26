<?php

namespace App\View\Components;

use App\Models\Business;
use Illuminate\View\Component;

class BusinessCard extends Component{

	/**
	 * @var Business
	 */
	private $business;

	/**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Business $business){
        $this->business = $business;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render(){
        return view('components.business-card', ['business' => $this->business]);
    }
}
