<div>
  <div class="border-binder-200 p-3" x-data="{open: false}">
    <div class="flex justify-between" x-show="$wire.mode === 'show'">
      <span>
        {{ $memmo->title }}
        @if ($memmo->is_shared)
            <span class="text-xs text-paper-400">(public)</span>
        @endif
      </span>
      <button class="cursor-pointer text-binder-500 hover:text-binder-800"
        x-on:click="open = !open;">
        {{ $memmo->saved_around }}
      </button>
    </div>
    <div class="mt-3" x-show="open" x-cloak>
      <div x-show="$wire.mode === 'show'">
        <div class="prose">
          {!! nl2br($memmo->content) !!}
        </div>
        <div class="flex justify-between items-center mt-3">
          <div class="text-xs">
            <span x-text="(new Date(1000 * $wire.savedAt - 60 * (new Date).getTimezoneOffset())).toLocaleString()" class="text-gray-500 me-3"></span>
            <button type="button" class="text-red-400 hover:text-red-600"
              wire:confirm="cannot be undone! you sure?{{ $memmo->is_shared ? ' (maybe you want unshare instead, but if you really want delete, hit OK.)' : '' }}"
              wire:click="delete">delete</button>
          </div>
          <div class="text-sm">
            @livewire('memmo.sharer', ['memmo' => $memmo], key($memmo->id))
            <button type="button" class="ms-3 text-paper-600 hover:text-paper-800"
              x-on:click="$wire.mode = 'edit'">edit</button>
          </div>
        </div>
      </div>
      <div x-show="$wire.mode === 'edit'" x-cloak>
        <textarea name="memo-{{ $memmo->id }}" class="w-full rounded border border-gray-200 shadow-inner"
          wire:model="memo"
          x-bind:rows="Math.max(3, $wire.lines)"></textarea>
        <div class="flex justify-end items-center mt-1">
          <div class="text-sm grid grid-cols-2 gap-3">
            <button type="button" class="text-paper-600 hover:text-paper-800"
              x-on:click="$wire.mode = 'show'">cancel</button>
            <button type="button" class="text-sm bg-paper-600 hover:bg-paper-800 text-white rounded px-2 py-1"
              wire:click="edit">edit</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>