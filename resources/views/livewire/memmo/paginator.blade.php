<div class="flex w-full justify-between items-center">
  <div>
    <input type="text" placeholder="type to filter"
      wire:model.live.debounce.500ms="search"
      class="text-sm form-input rounded border border-gray-200 shadow-inner bg-paper-50 focus:ring-paper-600 focus:border-paper-600 focus:bg-white"/>
    <span class="text-sm text-gray-500 ms-2">{{ $paginator->total() }} filtered</span>
    <a class="text-xs text-paper-400 hover:text-paper-600 hover:underline underline-offset-2 cursor-pointer"
      wire:click="resetPagination(true)">(reset)</a>
  </div>
  <nav role="navigation" aria-label="Memmo Pagination Navigation" class="flex justify-self-end gap-2 items-center">
    <select class="form-select border-none bg-paper-50 disabled:bg-none disabled:text-gray-300" x-on:change="$wire.gotoPage($event.target.value)" wire:loading.attr="disabled">
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
      <button class="rounded p-2 bg-paper-200 hover:bg-paper-300 disabled:bg-paper-100 disabled:text-gray-300" wire:loading.attr="disabled" wire:click="previousPage" rel="prev">
    @endif
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
        </svg>
      </button>
    @if ($paginator->onLastPage())
      <button class="rounded p-2 bg-paper-100 text-gray-300" disabled>
    @else
      <button class="rounded p-2 bg-paper-200 hover:bg-paper-300 disabled:bg-paper-100 disabled:text-gray-300" wire:loading.attr="disabled" wire:click="nextPage" rel="next">
    @endif
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
        </svg>
      </button>
  </nav>
</div>