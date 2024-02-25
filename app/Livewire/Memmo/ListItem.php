<?php

namespace App\Livewire\Memmo;

use Livewire\Component;

use App\Models\Memmo;

class ListItem extends Component
{
    public Memmo $memmo;

    public function render()
    {
        return view('livewire.memmo.list-item');
    }

    public function delete()
    {
        $this->memmo->delete();
        $this->dispatch('memmo-deleted');
    }
}
