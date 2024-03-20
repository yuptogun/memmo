import './bootstrap';
import { Alpine, Livewire } from '../../vendor/livewire/livewire/dist/livewire.esm';

Alpine.directive('memmo', (el) => {
    let regex = /(https?:\/\/\S+)/g;
    let subst = `<a href="$1" target="_blank" rel="noopener noreferrer" class="text-gray-500 hover:text-gray-700 hover:underline underline-offset-3 cursor-pointer">$1</a>`;
    el.innerHTML = el.innerHTML.split('<br>').map((line) => line.replace(regex, subst)).join('<br>');
});

Livewire.start();
