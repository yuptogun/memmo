<div>
  <div class="border-binder-200 p-3"
    x-on:memmo-deleted="$refresh"
    x-data="{open: false}">
    <div class="flex justify-between">
      <span>{{ $memmo->title }}</span>
      <button class="cursor-pointer text-binder-500 hover:text-binder-800"
        x-on:click="open = !open;"
        x-bind:title="(new Date({{ $memmo->updated_at->getTimestamp() * 1000 }} - 60 * (new Date).getTimezoneOffset())).toLocaleString()">
        {{ $memmo->timestamp }}
      </button>
    </div>
    <div class="mt-3" x-show="open" x-cloak>
      <div class="float-right mb-3">
        <button wire:confirm="cannot be undone! you sure?" wire:click="delete"
          class="text-red-400 hover:text-red-600 text-sm">delete</button>
      </div>
      <div class="prose">
        {!! nl2br($memmo->content) !!}
      </div>
    </div>
  </div>
</div>