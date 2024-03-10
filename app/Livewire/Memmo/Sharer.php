<?php

namespace App\Livewire\Memmo;

use Livewire\Component;
use Illuminate\Support\Facades\Cache;
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
        Cache::set('memmo:shared:' . $this->memmo->share_code, $this->memmo, 86400);

        $this->dispatch('memmo-shared');
    }

    public function unshare()
    {
        $this->memmo->unshare();
        Cache::forget('memmo:shared:' . $this->memmo->share_code);

        $this->dispatch('memmo-unshared');
    }
}
