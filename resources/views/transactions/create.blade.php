<x-layout>
    <x-pop-up-message/>

    <div class="px-4 pt-16 w-[950px]">

        <div class="grid grid-cols-1 w-11/12 mx-auto">

            <div class="px-4 mx-auto w-full">
                <x-title>
                    New transaction
                </x-title>
                <form action="/validate" method="POST" novalidate>
                    @csrf
                    <div class="pt-6 mb-4">
                        <label for="account_from" class="block mb-2 text-sm font-medium text-gray-900">
                            Choose account:
                        </label>
                        <select name="account_from" id="account_from"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block p-2">
                            @foreach($accounts as $account)
                                <option value="{{ $account->id }}">{{ $account->number }}
                                    &nbsp&nbsp|&nbsp&nbsp{{ $account->balance }} {{ $account->currency }}</option>
                            @endforeach
                        </select>
                        @error('account_from')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex gap-x-4 justify-between items-end">
                        <div class="w-64">
                            <label for="account_number" class="block mb-2 text-sm font-medium text-gray-900">
                                Account number
                            </label>
                            <input type="text" name="account_number" id="account_number"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                            @error('account_number')
                            <x-error>{{ $message }}</x-error>
                            @enderror
                        </div>
                        <div class="w-20">
                            <label for="amount" class="block mb-2 text-sm font-medium text-gray-900">
                                Amount
                            </label>
                            <input type="number" name="amount" id="amount"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                            @error('amount')
                            <x-error>{{ $message }}</x-error>
                            @enderror
                        </div>
                        <div class="w-64">
                            <label for="description" class="block mb-2 text-sm font-medium text-gray-900">
                                Description
                            </label>
                            <input type="text" name="description" id="description"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                            @error('description')
                            <x-error>{{ $message }}</x-error>
                            @enderror
                        </div>
                        <div>
                            <x-button>
                                Make transaction
                            </x-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-layout>
