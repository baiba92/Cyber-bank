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
                 class="absolute bg-gray-100 duration-500 ease-out transition-all w-96 h-full right-0 top-0 {{ $errors->any() || session()->has('showSlider') ? '' : 'translate-x-full' }} ">
                <div onclick="toggleSlideover()"
                     class="w-10 h-10 cursor-pointer flex text-gray-600 items-center justify-center absolute top-0 right-0 mt-5 mr-5">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </div>

                <div class="p-8 mt-6 space-y-6 w-full">
                    <x-title>
                        New registration
                    </x-title>

                    <form class="space-y-3" action="/register" method="POST" novalidate>
                        @csrf
                        <div>
                            <label for="name" class="block mb-1 text-xs font-medium text-gray-900">
                                Name
                            </label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                            @error('name')
                            <x-error>{{ $message }}</x-error>
                            @enderror
                        </div>
                        <div>
                            <label for="email" class="block mb-1 text-xs font-medium text-gray-900">
                                E-mail
                            </label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                            @error('email')
                            <x-error>{{ $message }}</x-error>
                            @enderror
                        </div>
                        <div>
                            <label for="phone" class="block mb-1 text-xs font-medium text-gray-900">
                                Phone number
                            </label>
                            <input type="tel" name="phone" id="phone" value="{{ old('phone') }}"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                            @error('phone')
                            <x-error>{{ $message }}</x-error>
                            @enderror
                        </div>
                        <div>
                            <label for="address" class="block mb-1 text-xs font-medium text-gray-900">
                                Address
                            </label>
                            <input type="text" name="address" id="address" value="{{ old('address') }}"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                            @error('address')
                            <x-error>{{ $message }}</x-error>
                            @enderror
                        </div>
                        <div>
                            <label for="password" class="block mb-1 text-xs font-medium text-gray-900">
                                Password
                            </label>
                            <input type="password" name="password" id="password"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                            @error('password')
                            <x-error>{{ $message }}</x-error>
                            @enderror
                        </div>
                        <div>
                            <label for="password_confirmation" class="block mb-1 text-xs font-medium text-gray-900">
                                Confirm password
                            </label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                            @error('password_confirmation')
                            <x-error>{{ $message }}</x-error>
                            @enderror
                        </div>
                        <div class="flex items-center justify-center">
                            <x-button>
                                Register
                            </x-button>
                        </div>
                        <div class="absolute right-8 bottom-8">
                            <div class="flex flex-row items-center">
                                <p class="block mr-2 text-xs font-medium text-gray-600">
                                    Already have an account?
                                </p>
                                <x-button-link :url="'/'">
                                    Log in
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
    </script>

</x-blank-layout>
