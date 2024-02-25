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

    public string $placeholder;

    public function mount()
    {
        $this->placeholder = collect([
            'hint: first line is the subject',
            'hint: markdown to be supported soon',
        ])->random();
    }

    public function store()
    {
        $this->validate();

        /** @var User $user */
        $user = Auth::user();
        $user->memmos()->create([
            'memo' => $this->memo,
        ]);
        $this->dispatch('memmo-saved');
    }

    public function render()
    {
        return view('livewire.memmo.form');
    }
}
