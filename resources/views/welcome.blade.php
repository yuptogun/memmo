<x-app-layout>
  @section('title', config('app.name') . ': one field, one button.')
  {{-- <div>
    <h1>
      <span class="text-2xl">Meet <x-application-logo></x-application-logo>,</span><br>
      <span class="text-xl">a note app with one field and one button.</span>
    </h1>
  </div> --}}
  <div class="w-full">
    <div class="w-full">
      <textarea class="w-full rounded border border-gray-200 h-32" name="memo"
        placeholder="Add your ideas here. Hit the button. That's it."></textarea>
    </div>
    <button class="block w-full p-2 bg-binder text-white rounded font-bold focus-visible:outline-binder-900" type="button" onclick="alert('sorry, demo only! please login to use.');">MEMMO</button>
  </div>
  <div class="py-6">
    <h2 class="my-6 text-center text-lg">This I believe is how every notepad (app) works.</h2>
    <div class="mx-3 prose">
      <p>It must provide a blank that I can immediately start filling in -- it should never be hidden behind any buttons like "add", "new" or "+". one field, one button. maybe then a list. that's not too much to ask, ain't it?</p>
      <p>The first version was made in 2019. Now you're seeing the 2024 reboot. please log in and enjoy your virtual notepad.</p>
    </div>
  </div>
</x-app-layout>