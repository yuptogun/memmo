<form wire:submit="store">
    @csrf
    <textarea rows="5" wire:model="memo" placeholder="put something down here and MEMMO" required></textarea>
    <button type="submit">MEMMO</button>
</form>