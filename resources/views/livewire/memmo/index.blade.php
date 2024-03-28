<div>
  @if ($memmos->isNotEmpty())
    <div class="grid grid-cols-1 divide-y" wire:loading.remove>
      @foreach ($memmos as $memmo)
      @livewire('memmo.list-item', ['id' => $memmo->id], key($memmo->id))
      @endforeach
    </div>
    <div wire:loading class="my-6 py-6 text-center text-lg w-full">
      @include('livewire.partials.loading')
    </div>
  @else
    <h3 class="my-6 py-6 text-center text-xl">y u no memmo</h3>
  @endif
    <div class="pt-6">
      {{ $memmos->links('livewire.memmo.paginator') }}
    </div>
</div>
