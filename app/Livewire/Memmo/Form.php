<?php

namespace App\Livewire\Memmo;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Models\User;

class Form extends Component
{
    use AuthorizesRequests;

    #[Validate('required')]
    public string $memo = '';

    public string $placeholder;

    public function mount()
    {
        $this->placeholder = collect([
            'hint: first line becomes the subject',
            'hint: auto hyperlinks to be supported soon',
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
        $this->memo = '';
        $this->dispatch('memmo-created');
    }

    #[On('memmo-created')]
    public function render()
    {
        return view('livewire.memmo.form');
    }
}
