<x-blank-layout>

    <section class="flex items-center justify-center w-full">

            <div class="flex flex-row bg-gray-100 items-start w-[700px] p-8 mt-40 space-x-10">
                <div class="flex flex-col items-center justify-center">
                    <p class="mb-3 text-lg font-bold">
                        {{ $secret }}
                    </p>
                    {!! $qrCode !!}
                </div>
                <div>
                <x-title>
                    Enter validation code to proceed
                </x-title>
                <form class="space-y-6" action="{{ $path }}" method="POST">
                    @csrf
                    <div>
                        <label for="one_time_password" class="block mb-2 text-sm font-medium text-gray-900">
                            If you saved secret key from your profile, open authenticator app and enter validation code.
                        </label>
                        <p class="block mb-6 text-sm font-medium text-gray-900">
                            If you did not previously save the key, first scan QR code or enter key above it to get the
                            validation code.
                        </p>
                        <input type="text" name="one_time_password" id="one_time_password"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                        @error('one_time_password')
                        <x-error>{{ $message }}</x-error>
                        @enderror
                    </div>
                    <div class="flex items-center justify-center">
                        <x-button>
                            Submit
                        </x-button>
                    </div>
                </form>
                </div>

            </div>

    </section>

</x-blank-layout>
