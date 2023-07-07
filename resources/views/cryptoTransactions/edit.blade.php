<x-layout>

    <x-pop-up-message/>

    <div class="px-4 pt-16 w-[950px]">

        <div class="px-4 mx-auto w-11/12">
            <form action="/validate" method="POST" novalidate>
                @csrf
                <x-title>
                    Sell {{ $cryptocurrency }}
                </x-title>

                <div class="pt-6 flex flex-col gap-y-4">
                    <div>
                        <label for="account_to" class="block mb-2 text-sm font-medium text-gray-900">
                            Choose recipient account:
                        </label>
                        <select name="account_to" id="account_to"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block p-2">
                            @foreach($accounts as $account)
                                <option value="{{ $account->id }}" {{ old('account_to') == $account->id ? 'selected':'' }}>{{ $account->number }}
                                    &nbsp&nbsp|&nbsp&nbsp{{ $account->balance }} {{ $account->currency }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex gap-x-10 justify-start items-end">
                        <div class="flex flex-col justify-between">
                            <label for="price" class="block mb-5 text-sm font-medium text-gray-900">
                                Available amount
                            </label>
                            <p class="text-gray-900 text-sm block">
                                {{ $currency }} {{ $value }}
                            </p>
                        </div>
                        <div class="flex flex-col justify-between">
                            <p class="block mb-5 text-sm font-medium text-gray-900">
                                Equal to {{ $cryptocurrency }} amount of
                            </p>
                            <p class="text-gray-900 text-sm block">
                                {{ $cryptoParts }}
                            </p>
                        </div>
                        <div>
                            <label for="amount" class="block mb-2 text-sm font-medium text-gray-900">
                                Cash-out amount:
                            </label>
                            <input type="number" id="amount" name="amount" min="0.01" step="0.01" max="{{ $value }}"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-primary-600 focus:border-primary-600 block py-2 px-3">
                            @error('amount')
                            <x-error>{{ $message }}</x-error>
                            @enderror
                        </div>
                        <div class="flex justify-start items-end ">
                            <input type="hidden" name="value" value="{{ $value }}">
                            <input type="hidden" name="transactionId" value="{{ $transactionId }}">
                            <input type="hidden" name="cryptoParts" value="{{ $cryptoParts }}">
                            <input type="hidden" name="price" value="{{ $price }}">
                            <x-button>
                                Sell
                            </x-button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

</x-layout>
