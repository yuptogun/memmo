<form wire:submit="store" class="w-full" x-data="{memo: null}">
    @csrf
    <div class="w-full">
        <textarea name="memo"
            class="w-full rounded border border-gray-200 shadow-inner h-32 md:h-36"
            wire:model="memo" x-model="memo"
            placeholder="{{ $placeholder }}" required></textarea>
    </div>
    <button
        class="block w-full p-2 bg-binder text-white rounded disabled:bg-binder-300 font-bold"
        :disabled="memo === null || memo.trim().length === 0"
        type="submit" disabled>MEMMO</button>
</form>