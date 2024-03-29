<x-app-layout>
  @section('title', config('app.name') . ': one field, one button.')
  <div class="w-full">
    <div class="w-full">
      <textarea class="w-full rounded border border-gray-200 h-32" name="memo"
        placeholder="Add your ideas here. Hit the button. That's it."></textarea>
    </div>
    <button class="block w-full p-2 bg-binder text-white rounded font-bold focus-visible:outline-binder-900" type="button" onclick="alert('sorry, demo only! please login to use.');">MEMMO</button>
  </div>
  <div class="py-6">
    <h2 class="my-6 text-center text-lg">This I believe should be how every note app works.</h2>
    <div class="mx-3 prose">
      <p>A headfirst blank, a simple save button. Maybe then a list; everything else is basically extra.</p>
      <p>Please log in and get your own virtual notepad done in right way.</p>
    </div>
  </div>
</x-app-layout>