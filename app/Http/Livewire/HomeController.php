<?php

namespace App\Http\Livewire;

use Livewire\Component;

class HomeController extends Component
{
    public function kegiatan()
    {
        return view('livewire.home.kegiatan');
    }
}
