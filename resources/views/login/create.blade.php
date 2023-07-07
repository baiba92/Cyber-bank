<x-blank-layout>

    <div class="w-screen h-screen flex items-center justify-center">

        <x-pop-up-message/>

        <div class="flex flex-col items-left justify-start space-y-3 text-gray-700">
            <div class="flex flex-row items-center -mt-28 mb-28">
                <img src="/images/cb_logo.png" class="mr-5 h-20" alt="Cyber Bank"/>
                <img src="/images/cb_title.png" class="mt-1 h-10" alt="Cyber Bank"/>
            </div>
            <div class="border-l-8 border-[#28816c]">
                <div class="pl-6 text-6xl font-semibold tracking-tight">
                    Be a part of something&nbsp
                    <span class="tracking-widest font-extrabold">bigger</span>
                </div>
                <div class="pl-6 text-2xl tracking-tight">
                    Your partner to make things happen.
                </div>
            </div>
            <div>
                <div onclick="toggleSlideover()"
                     class="mt-10 font-medium cursor-pointer bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded hover:bg-gray-300 transition duration-500 focus:ring-primary-600 focus:border-primary-600 block w-fit px-3 py-2">
                    Join
                </div>
            </div>
        </div>

        <div id="slideover-container" class="fixed inset-0 w-full h-full {{ $errors->any() || session()->has('showSlider') ? '' : 'invisible' }}">
            <div id="slideover-bg" onclick="toggleSlideover()"
                 class="absolute duration-500 ease-out transition-all inset-0 w-full h-full bg-gray-900 {{ $errors->any() || session()->has('showSlider') ? 'opacity-50' : 'opacity-0' }}"></div>
            <div id="slideover"
                 class="absolute bg-gray-100 duration-500 ease-out transition-all w-96 h-full right-0 top-0 {{ $errors->any() || session()->has('showSlider') ? '' : 'translate-x-full' }}">
                <div onclick="toggleSlideover()"
                     class="w-10 h-10 cursor-pointer flex text-gray-600 items-center justify-center absolute top-0 right-0 mt-5 mr-5">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </div>

                <div class="p-8 mt-24 space-y-6 w-full">
                    <x-title>
                        Log in
                    </x-title>
                    <form class="space-y-6" action="/login" method="POST" novalidate>
                        @csrf
                        <div>
                            <label for="email" class="block mb-1 text-xs font-medium text-gray-900">
                                E-mail
                            </label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}"
                                   class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded focus:border-emerald-600 focus:ring-[#28816c] block p-2">
                            @error('email')
                            <x-error>{{ $message }}</x-error>
                            @enderror
                        </div>
                        <div>
                            <label for="password" class="block mb-1 text-xs font-medium text-gray-900">
                                Password
                            </label>
                            <input type="password" name="password" id="password"
                                   class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded focus:border-emerald-600 focus:ring-[#28816c] block p-2">
                            @error('password')
                            <x-error>{{ $message }}</x-error>
                            @enderror
                        </div>
                        <div>
                            <label for="password_confirmation" class="block mb-1 text-xs font-medium text-gray-900">
                                Confirm password
                            </label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                   class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded focus:border-emerald-600 focus:ring-[#28816c] block p-2">
                            @error('password_confirmation')
                            <x-error>{{ $message }}</x-error>
                            @enderror
                        </div>
                        <div class="flex items-center justify-center">
                            <x-button>
                                Log in
                            </x-button>
                        </div>
                        <div class="absolute right-8 bottom-8">
                            <div class="flex flex-row items-center">
                                <p class="block mr-2 text-xs font-medium text-gray-600">
                                    Don't have an account?
                                </p>
                                <x-button-link :url="'/register'">
                                    Register
                                </x-button-link>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <script>
        function toggleSlideover() {
            document.getElementById('slideover-container').classList.toggle('invisible');
            document.getElementById('slideover-bg').classList.toggle('opacity-0');
            document.getElementById('slideover-bg').classList.toggle('opacity-50');
            document.getElementById('slideover').classList.toggle('translate-x-full');
        }

        function visibleSlideover() {
            document.getElementById('slideover-container').classList.add('invisible');
        }
    </script>

</x-blank-layout>
