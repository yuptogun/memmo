<?php

namespace App\Livewire\Memmo;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Database\Eloquent\Builder;

class Index extends Component
{
    use WithPagination;

    #[Url]
    public string $search = '';

    public $inited = false;

    public function init()
    {
        $this->inited = true;
    }

    public function render()
    {
        /** @var User $user */
        $user = Auth::user();
        return view('livewire.memmo.index', [
            'memmos' => $user->memmos()
                ->when($this->search, fn (Builder $memmo, $search) =>
                    $memmo->where('memo', 'like', "%$search%")
                )
                ->latest('updated_at')->paginate(20),
        ]);
    }

    #[On('memmo-created')]
    #[On('memmo-deleted')]
    public function resetPagination(bool $resetSearch = false)
    {
        if ($resetSearch) {
            $this->search = '';
        }
        $this->resetPage();
    }
}
