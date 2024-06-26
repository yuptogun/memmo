<div class="flex flex-col sm:flex-row w-full justify-between gap-4 items-center">
  <div class="flex-1 w-full sm:w-auto sm:shrink-0">
    <form method="GET" wire:submit="$dispatch('search-changed')"
      class="flex gap-2">
      <input type="text" placeholder="type & enter" name="search"
        wire:model="search"
        wire:loading.attr="disabled"
        class="text-sm form-input rounded border border-gray-200 shadow-inner bg-paper-50 focus:ring-paper-600 focus:border-paper-600 focus:bg-white w-full sm:w-auto" />
      <button type="submit"
        class="rounded px-3 text-white bg-binder-600 hover:bg-binder-700">search</button>
    </form>
  </div>
  <div class="flex-1 w-full sm:flex-auto sm:w-auto sm:grow">
    <div class="flex justify-between gap-2 items-center">
      <div class="inline-block ms-2 sm:ms-0">
        <div wire:loading.remove>
          <span class="text-sm text-gray-500 block sm:inline">{{ $paginator->total() }} filtered</span>
          <a class="text-xs block sm:inline text-paper-400 hover:text-paper-600 hover:underline underline-offset-2 cursor-pointer"
            wire:click="resetPagination(true)">(reset)</a>
        </div>
        <div wire:loading>
          <span class="text-sm ms-2">
            @include('livewire.partials.loading')
          </span>
        </div>
      </div>
      <nav role="navigation" aria-label="Memmo Pagination Navigation" class="flex justify-self-end gap-2 items-center">
        <select class="form-select border-none bg-paper-50 disabled:bg-none disabled:text-gray-300"
          x-on:change="$wire.gotoPage($event.target.value)"
          wire:loading.attr="disabled">
          @foreach ($elements as $element)
            @if (is_array($element))
              @foreach ($element as $page => $url)
                @if ($page === $paginator->currentPage())
                  <option selected disabled>{{ $page }}</option>
                @else
                  <option value="{{ $page }}">{{ $page }}</option>
                @endif
              @endforeach
            @endif
          @endforeach
        </select>
        @if ($paginator->onFirstPage())
        <button class="rounded p-2 bg-paper-100 text-gray-300" disabled>
        @else
        <button class="rounded p-2 bg-paper-200 hover:bg-paper-300 disabled:bg-paper-100 disabled:text-gray-300" rel="prev"
          wire:loading.attr="disabled"
          wire:click="previousPage">
        @endif
          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
          </svg>
        </button>
        @if ($paginator->onLastPage())
        <button class="rounded p-2 bg-paper-100 text-gray-300" disabled>
        @else
        <button class="rounded p-2 bg-paper-200 hover:bg-paper-300 disabled:bg-paper-100 disabled:text-gray-300" rel="next"
          wire:loading.attr="disabled"
          wire:click="nextPage">
        @endif
          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
          </svg>
        </button>
      </nav>
    </div>
  </div>
</div>