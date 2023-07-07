@if (session()->has('success'))
    <div x-data="{ show: false }"
         x-init="setTimeout(() => show = true, 300)">
        <div x-init="setTimeout(() => show = false, 4000)"
             x-transition:enter="transition ease-out duration-1000"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-1000"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             x-show="show"
             class="fixed bg-[#28816c] text-white rounded py-4 px-8 top-24 right-40">
            <p>
                {{ session('success') }}
            </p>
        </div>
    </div>
@endif
