<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Category;
use App\Models\Movie;

class MainLayout extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $categories = Category::orderBy('id')->get();
        $movie = Movie::orderBy('id')->get();
        return view('layouts.main-layout', ['categories' => $categories, 'movie' => $movie]);
    }
}
