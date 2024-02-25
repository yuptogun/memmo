<?php

namespace App\Livewire\Memmo;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    use WithPagination;

    public function render()
    {
        /** @var User $user */
        $user = Auth::user();
        return view('livewire.memmo.index', [
            'memmos' => $user->memmos()->latest()->paginate(20),
        ]);
    }

    #[On('memmo-created')]
    #[On('memmo-deleted')]
    public function resetPagination()
    {
        $this->resetPage();
    }
}
