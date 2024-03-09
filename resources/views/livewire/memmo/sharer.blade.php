<div class="ms-3 inline-block">
  @if ($memmo->is_shared)
  <a class="font-mono text-xs me-1 text-paper-600 hover:text-paper-800"
    href="{{ route('show-shared', ['shareCode' => $memmo->share_code]) }}" target="_blank"
    title="this memmo is visible in public; copy link URL to share.">
    /m/{{ $memmo->share_code }}
  </a>
  <button type="button" class="text-gray-500 hover:text-gray-700"
    wire:confirm="you sure this memmo go private?"
    wire:click="unshare">unshare</button>
  @else
  <button type="button" class="text-binder-600 hover:text-binder-800"
    wire:confirm="you sure this memmo go public?"
    wire:click="share">share</button>
  @endif
</div>