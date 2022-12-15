<?php

namespace App\View\Components\Admin\Slide;

use Illuminate\View\Component;

class Audio extends Component
{
    public $audio;
    public $slideCount;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($audio, $slideCount)
    {
        $this->audio = $audio;
        $this->slideCount = $slideCount;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.slide.audio');
    }
}
