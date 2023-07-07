<x-layout>

    <div class="px-4 pt-16 w-[950px]">
        <div class="grid grid-cols-1 w-full mx-auto">

            <div class="px-4 mx-auto w-11/12 mx-auto">
                <form action="/accounts" method="POST">
                    @csrf
                    <x-title>
                        Add new account
                    </x-title>
                    <div class="flex pt-6 gap-x-8 justify-start items-end">
                        <div class="w-80">
                            <label for="number" class="block mb-2 text-sm font-medium text-gray-900">
                                Account number
                            </label>
                            <input type="text" name="number" id="number"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                            @error('number')
                            <x-error>{{ $message }}</x-error>
                            @enderror
                        </div>
                        <div>
                            <label for="currency" class="block mb-2 text-sm font-medium text-gray-900">
                                Currency:
                            </label>
                            <select name="currency" id="currency"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block p-2.5">
                                <option value="EUR">
                                    EUR
                                </option>
                                @foreach($currencies as $currency)
                                    <option value="{{ $currency }}">
                                        {{ $currency }}
                                    </option>
                                @endforeach
                            </select>
                            @error('currency')
                            <x-error>{{ $message }}</x-error>
                            @enderror
                        </div>
                        <div class="w-40">
                            <label for="bank" class="block mb-2 text-sm font-medium text-gray-900">
                                Bank
                            </label>
                            <input type="text" name="bank" id="bank"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                            @error('bank')
                            <x-error>{{ $message }}</x-error>
                            @enderror
                        </div>
                        <div>
                            <x-button>
                                Add account
                            </x-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-layout>
