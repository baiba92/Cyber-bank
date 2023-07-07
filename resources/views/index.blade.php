<x-layout>

    <div class="px-8 pt-16 w-[950px]">
        <x-pop-up-message/>

        <x-title>
            Hello, {{ auth()->user()->name }}!
        </x-title>
        <p class="my-8 border-t border-gray-200"></p>

    </div>

</x-layout>
