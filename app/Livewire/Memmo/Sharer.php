<?php

namespace App\Livewire\Memmo;

use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Models\Memmo;

class Sharer extends Component
{
    use AuthorizesRequests;

    public Memmo $memmo;

    public function render()
    {
        return view('livewire.memmo.sharer');
    }

    public function share()
    {
        $this->memmo->share();
        $this->dispatch('memmo-shared');
    }

    public function unshare()
    {
        $this->memmo->unshare();
        $this->dispatch('memmo-unshared');
    }
}
