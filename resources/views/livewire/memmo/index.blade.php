<div>
    @if ($memmos->isNotEmpty())
    <div class="grid grid-cols-1 divide-y">
        @foreach ($memmos as $memmo)
        @livewire('memmo.list-item', ['memmo' => $memmo], key($memmo->id))
        @endforeach
    </div>
    {{ $memmos->links() }}
    @else
    <h3 class="p-6 mb-2 text-center text-xl">y u no memmo</h3>
    @endif
</div>
