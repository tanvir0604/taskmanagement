<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
// use App\Models\Task as TaskModel;

class Task extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $class,
        public Object $task
    )
    {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.task');
    }
}
