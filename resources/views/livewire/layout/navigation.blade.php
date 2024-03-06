<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<nav x-data="{ open: false }" class="bg-binder text-gray-100 shadow-md">
  <!-- Primary Navigation Menu -->
  <div class="px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between h-16">
      <div class="flex">
        <div class="shrink-0 flex items-center">
          <a href="/" wire:navigate>
            <x-application-logo />
          </a>
        </div>

        <!-- Navigation Links -->
        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
          {{-- 여기에 대충 바인더 드롭다운 --}}
        </div>
      </div>

      <!-- Settings Dropdown -->
      <div class="hidden sm:flex sm:items-center sm:ms-6">
        @auth
        <x-dropdown align="right">
          <x-slot name="trigger">
            <button
              class="inline-flex items-center py-2 border border-transparent text-sm leading-4 font-medium rounded-md focus:outline-none transition ease-in-out duration-150">
              <div x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name"
                x-on:profile-updated.window="name = $event.detail.name"></div>

              <div class="ms-1">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                  <path fill-rule="evenodd"
                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                    clip-rule="evenodd" />
                </svg>
              </div>
            </button>
          </x-slot>

          <x-slot name="content">
            <x-dropdown-link :href="route('profile')" wire:navigate>
              <span class="block text-nowrap break-keep">{{ __('Profile') }}</span>
            </x-dropdown-link>

            <!-- Authentication -->
            <button wire:click="logout" class="w-full text-start">
              <x-dropdown-link>
                <span class="block text-nowrap break-keep">{{ __('Log Out') }}</span>
              </x-dropdown-link>
            </button>
          </x-slot>
        </x-dropdown>
        @else
        <a class="ms-4" href="{{ route('register') }}">{{ __('Register') }}</a>
        <a class="ms-4" href="{{ route('login') }}">{{ __('Log in') }}</a>
        @endif
      </div>

      <!-- Hamburger -->
      <div class="-me-2 flex items-center sm:hidden">
        <button @click="open = ! open"
          class="inline-flex items-center justify-center p-2 rounded-md focus:outline-none transition duration-150 ease-in-out">
          <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round"
              stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
              stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
    </div>
  </div>

  <!-- Responsive Navigation Menu -->
  <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
    <!-- Responsive Settings Options -->
    <div class="py-2 border-t border-binder-700">
      @auth
      {{-- <div class="pt-2 pb-3 space-y-1">
        바인더 선택 드롭다운
      </div> --}}
      <div class="px-3">
        <div class="font-medium text-base text-gray-200" x-data="{{ json_encode(['name' => auth()->user()->name]) }}"
          x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>
        <div class="font-medium text-sm text-gray-400">{{ auth()->user()->email }}</div>
      </div>

      <div class="mt-3 space-y-1">
        <x-responsive-nav-link :href="route('profile')" wire:navigate>
          {{ __('Profile') }}
        </x-responsive-nav-link>

        <!-- Authentication -->
        <button wire:click="logout" class="w-full text-start">
          <x-responsive-nav-link>
            {{ __('Log Out') }}
          </x-responsive-nav-link>
        </button>
      </div>
      @else
      <x-responsive-nav-link :href="route('register')" wire:navigate>
        {{ __('Register') }}
      </x-responsive-nav-link>
      <x-responsive-nav-link :href="route('login')" wire:navigate>
        {{ __('Log In') }}
      </x-responsive-nav-link>
      @endif
    </div>
  </div>
</nav>