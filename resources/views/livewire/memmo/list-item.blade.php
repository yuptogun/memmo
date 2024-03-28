<div class="border-binder-200 p-3">
  <div x-data="{open: false}">
    <div class="flex justify-between" x-show="$wire.mode === 'show'">
      <span class="break-all">
        {{ $this->memmo->title }}
        @if ($this->memmo->is_shared)
            <span class="text-xs text-paper-400 inline-block text-nowrap">(public)</span>
        @endif
      </span>
      <button class="ps-3 cursor-pointer text-end text-nowrap text-binder-500 hover:text-binder-800"
        x-on:click="open = !open;">
        {{ $this->memmo->saved_around }}
      </button>
    </div>
    <div class="mt-3" x-show="open" x-cloak>
      <div x-show="$wire.mode === 'show'">
        <div class="prose break-words" x-memmo>
          {!! nl2br($this->memmo->content) !!}
        </div>
        <div class="flex flex-col sm:flex-row justify-between mt-3 text-sm">
          <div>
            <span x-text="(new Date(1000 * {{ $this->savedAt }} - 60 * (new Date).getTimezoneOffset())).toLocaleString()" class="text-gray-500 me-3"></span>
          </div>
          <div class="flex justify-between sm:flex-1">
            <button type="button" class="text-red-400 hover:text-red-600"
              wire:confirm="cannot be undone! you sure?{{ $this->memmo->is_shared ? ' (maybe you want unshare instead, but if you really want delete, hit OK.)' : '' }}"
              wire:click="delete">delete</button>
            <div class="text-end">
              @livewire('memmo.sharer', ['memmo' => $this->memmo], key($this->memmo->id))
              <button type="button" class="ms-3 text-paper-600 hover:text-paper-800"
                x-on:click="$wire.mode = 'edit'">edit</button>
            </div>
          </div>
        </div>
      </div>
      <div x-show="$wire.mode === 'edit'" x-cloak>
        <textarea name="memo-{{ $this->memmo->id }}" class="w-full rounded border border-gray-200 shadow-inner"
          wire:model="memo"
          x-bind:rows="Math.max(3, {{ $this->lines }})"></textarea>
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