<?php

namespace App\Livewire\Memmo;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;

use App\Models\Memmo;

class ListItem extends Component
{
    public Memmo $memmo;
    public int $savedAt;
    public int $lines;
    public string $mode = 'show';

    #[Validate('required')]
    public string $memo;

    #[On('memmo-shared')]
    #[On('memmo-unshared')]
    public function render()
    {
        $this->setData();
        return view('livewire.memmo.list-item');
    }

    public function edit()
    {
        $this->memmo->memo = $this->memo;
        $this->memmo->save();
        $this->mode = 'show';
        $this->setData();
    }

    public function delete()
    {
        $this->memmo->delete();
        $this->dispatch('memmo-deleted');
    }

    private function setData()
    {
        $this->memo = $this->memmo->memo;
        $this->savedAt = $this->memmo->saved_at->timestamp;
        $this->lines = count(explode("\n", $this->memo));
    }
}
