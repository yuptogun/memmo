<?php

namespace App\Livewire\Memmo;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Cache;

use App\Models\Memmo;

/**
 * @property-read Memmo memmo *compued*
 * @property-read int savedAt *compued*
 * @property-read int lines *compued*
 */
class ListItem extends Component
{
    public int $id;
    public string $mode = 'show';
    public bool $inited = false;

    #[Validate('required')]
    public string $memo;

    #[Computed]
    public function memmo()
    {
        return Cache::remember('memmos:id:' . $this->id, 86400, fn () =>
            Memmo::withTrashed()->find($this->id)
        );
    }

    #[Computed]
    public function savedAt()
    {
        return $this->memmo->saved_at->timestamp;
    }

    #[Computed]
    public function lines()
    {
        return count(explode("\n", $this->memo));
    }

    public function init()
    {
        $this->setData();
        $this->inited = true;
    }

    #[On('memmo-shared')]
    #[On('memmo-unshared')]
    public function render()
    {
        $this->setData();
        return view('livewire.memmo.list-item');
    }

    public function edit()
    {
        // stop handling cached/computed model
        unset($this->memmo);

        // handle "fresh" one instead
        $model = Memmo::find($this->id);
        $model->memo = $this->memo;
        $model->save();

        $this->mode = 'show';
        $this->setData();
    }

    public function delete()
    {
        $model = $this->memmo;
        $model->unshare();
        $model->delete();
        $this->dispatch('memmo-deleted');
    }

    private function setData()
    {
        $this->memo = $this->memmo->memo;
    }
}
