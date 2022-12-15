<?php

namespace App\View\Components\Front\Slide;

use Illuminate\View\Component;

class Audio extends Component
{
    public $audio;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($audio)
    {
        $this->audio = $audio;
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.front.slide.audio');
    }
}
