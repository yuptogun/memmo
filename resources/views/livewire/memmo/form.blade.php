<form wire:submit="store" class="w-full">
    @csrf
    <div class="w-full">
        <textarea
            class="w-full rounded border border-gray-200 shadow-inner"
            rows="5" wire:model="memo" placeholder="type here..." required></textarea>
    </div>
    <button class="block w-full p-2 bg-binder text-white rounded disabled:bg-binder-300" type="submit" disabled>MEMMO</button>
</form>