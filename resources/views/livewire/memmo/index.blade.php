<div>
    @if ($memmos->isNotEmpty())
    <div class="grid grid-cols-1 divide-y">
        @foreach ($memmos as $memmo)
        @livewire('memmo.list-item', ['memmo' => $memmo], key($memmo->id))
        @endforeach
    </div>
    @else
    <h3 class="my-6 py-6 text-center text-xl">y u no memmo</h3>
    @endif
    <div class="pt-6">
        {{ $memmos->links('livewire.memmo.paginator') }}
    </div>
</div>
