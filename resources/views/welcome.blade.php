<x-app-layout>
  <div>
    <h1 class="mb-3">
      <span class="text-2xl">This is a memo app,</span><br>
      <span class="text-xl">but with no "add new" button.</span>
    </h1>
    <p class="ms-3">Instead you're given with a form like this. Now you can't forget how to compose new notes here.</p>
  </div>
  <div class="w-full py-6">
    <div class="w-full">
      <textarea class="w-full rounded border border-gray-200 bg-gray-300 shadow-inner h-32 md:h-36"
        placeholder="Here you add your notes and hit 'MEMMO' button below, and your note will be saved." disabled></textarea>
    </div>
    <button class="block w-full p-2 bg-binder text-white rounded disabled:bg-binder-300 font-bold" type="button" disabled>MEMMO</button>
  </div>
  <div>
    <h2 class="mb-3">
      <span class="text-xl">Straight and hassle-free,</span><br>
      <span class="text-lg">just as any kind of notepad should be.</span>
    </h2>
    <div class="ms-3">
      <p class="mb-3">MEMMO is not going to be a "knowledgebase management app" -- it's a virtual legal pad after all.</p>
      <p class="mb-3">You come up with something, you open MEMMO, you dump it here, you forget and move on. Life can be that simple.</p>
    </div>
  </div>
</x-app-layout>