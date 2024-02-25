<?php

namespace App\Livewire\Memmo;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;

use App\Models\Memmo;

class Index extends Component
{
    use WithPagination;

    #[On('memmo-saved', 'memmo-deleted')]
    public function render()
    {
        /** @var User $user */
        $user = Auth::user();
        return view('livewire.memmo.index', [
            'memmos' => $user->memmos()->latest()->paginate(20)
        ]);
    }

    public function delete(int $id)
    {
        Memmo::findOrFail($id)->delete();
        $this->dispatch('memmo-deleted');
    }
}
