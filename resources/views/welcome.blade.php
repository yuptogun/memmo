<x-app-layout>
  @section('title', config('app.name') . ': one field, one button.')
  <div>
    <h1>
      <span class="text-2xl">Meet <x-application-logo></x-application-logo>,</span><br>
      <span class="text-xl">the note app with one field and one button.</span>
    </h1>
  </div>
  <div class="w-full py-6">
    <div class="w-full">
      <textarea class="w-full rounded border border-gray-200 h-32 bg-gray-200 shadow-inner"
        placeholder="Add your ideas here. Hit the button. That's it." disabled></textarea>
    </div>
    <button class="block w-full p-2 bg-binder text-white rounded disabled:bg-binder-300 font-bold" type="button" disabled>MEMMO</button>
  </div>
  <div>
    <h2 class="mb-3">
      <span class="text-xl">It's your idea toilet.</span><br>
      <span class="text-lg">Open it, take a shit and save your day.</span>
    </h2>
    <div class="mx-3">
      <p class="mb-3">To my surprise, most of the note apps have buttons like "add", "new", "+". I never got used to find and click those buttons because who tf cares the buttons?? My ideas are already vaporizing! I don't need any fancy apps that demands extra actions to start writing; I need a toilet that I can rush into, write my shit down and flush!!</p>
      <p class="mb-3">So I decided to incarnate what virtual legal pads should look like. The first version is made in 2019, this one 2024.</p>
    </div>
  </div>
</x-app-layout>