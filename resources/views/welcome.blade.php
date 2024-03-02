<x-app-layout>
  <div class="w-full" x-data="{memo: null}">
    <div class="w-full">
      <textarea name="memo" x-model="memo" class="w-full rounded border border-gray-200 shadow-inner h-32 md:h-36"
        placeholder="This is a memo app. Just add your idea here and hit that big button below." required></textarea>
    </div>
    <button class="block w-full p-2 bg-binder text-white rounded disabled:bg-binder-300 font-bold"
      :disabled="memo === null || memo.trim().length === 0"
      x-on:click="alert('technically you need to sign in, but this is how it ALWAYS works.')" type="button"
      disabled>MEMMO</button>
  </div>
  <div class="pt-6"></div>
  <div class="grid grid-cols-1 divide-y">
    <div class="border-binder-200 p-3" x-data="{open: false}">
      <div class="flex justify-between">
        <span class="me-3">note app without "add" button</span>
        <button class="text-nowrap cursor-pointer text-binder-500 hover:text-binder-800" x-on:click="open = !open;">
          3 minutes ago
        </button>
      </div>
      <div class="mt-3" x-show="open" x-cloak>
        <div class="prose">
          <p>To my surprise, it was really difficult for me to find a note app that allows me start writing on the main view. Instead, almost every note app has "add" button. I don't get it. Why? Is that how the legal pads in the real world work? You press a button before scribbling on the paper?</p>
          <p>So I decided to build what I want iOS Notes app to be like back in 2017. This is a rebooted version of it -- TALL stack.</p>
        </div>
      </div>
    </div>
    <div class="border-binder-200 p-3" x-data="{open: false}">
      <div class="flex justify-between">
        <span class="me-3">never to be "knowledgebase solution"</span>
        <button class="text-nowrap cursor-pointer text-binder-500 hover:text-binder-800" x-on:click="open = !open;">
          7 minutes ago
        </button>
      </div>
      <div class="mt-3" x-show="open" x-cloak>
        <div class="prose">
          <p>A NOTEPAD IS A NOTEPAD. Physical legal pads exist to collect your scribbles on sheets of paper and no further than that.</p>
          <p>So will be Memmo -- it will not gonna arrange your schedules, prioritize your todos, version control your pictures or source codes, aggregate what artifacts are most contributing to your per-seat-subscription-based team. it will just sit calm as your old school notepad -- lightweight, least ambitious, doing what it does as expected.</p>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>