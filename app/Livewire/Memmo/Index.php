<?php

namespace App\Livewire\Memmo;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    use WithPagination;

    #[On('memmo-saved')]
    public function render()
    {
        /** @var User $user */
        $user = Auth::user();
        return view('livewire.memmo.index', [
            'memmos' => $user->memmos()->latest()->paginate(20)
        ]);
    }
}
