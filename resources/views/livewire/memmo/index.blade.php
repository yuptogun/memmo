<div>
    @if ($memmos->isNotEmpty())
    <div class="grid grid-cols-1 divide-y">
        @foreach ($memmos as $memmo)
        <div x-data="{open: false}" class="border-binder-200 p-3">
            <div class="flex justify-between">
                <span>{{ $memmo->title }}</span>
                <button class="cursor-pointer text-binder-500 hover:text-binder-800"
                    x-on:click="open = !open;"
                    x-bind:title="(new Date({{ $memmo->updated_at->getTimestamp() * 1000 }} - 60 * (new Date).getTimezoneOffset())).toLocaleString()">
                    {{ $memmo->timestamp }}
                </button>
            </div>
            <div class="mt-3" x-show="open" x-cloak>
                <div class="prose">
                    {!! nl2br($memmo->memo) !!}
                </div>
            </div>
        </div>
        @endforeach
    </div>
    {{ $memmos->links() }}
    @else
    <h3 class="p-6 mb-2 text-center text-xl">y u no memmo</h3>
    @endif
</div>
