<?php

namespace App\Livewire\Memmo;

use Livewire\Component;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class Form extends Component
{
    #[Validate('required')]
    public string $memo = '';

    public function store()
    {
        $this->validate();

        /** @var User $user */
        $user = Auth::user();
        $user->memmos()->create([
            'memo' => $this->memo,
        ]);
    }

    public function render()
    {
        return view('livewire.memmo.form');
    }
}
