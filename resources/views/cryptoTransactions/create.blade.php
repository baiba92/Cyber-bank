<x-layout>

    <x-pop-up-message/>

    <div class="px-4 pt-16 w-[950px]">

        <div class="px-4 mx-auto w-11/12">
            <form action="/validate" method="POST" novalidate>
                @csrf
                <x-title>
                    Buy {{ $cryptocurrency['name'] }}
                </x-title>
                <div class="pt-6 mb-6">
                    <label for="accountId" class="block mb-2 text-sm font-medium text-gray-900">
                        Choose account:
                    </label>
                    <select name="account_from" id="account_from"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block p-2">
                        @foreach($accounts as $account)
                            <option value="{{ $account->id }}" {{ old('account_from') == $account->id ? 'selected':'' }}>{{ $account->number }}
                                &nbsp&nbsp|&nbsp&nbsp{{ $account->balance }} {{ $account->currency }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex gap-x-10 items-end">
                    <div class="flex gap-x-10 justify-start items-start">
                        <div class="flex flex-col justify-between">
                            <label for="price" class="block mb-5 text-sm font-medium text-gray-900">
                                Price, {{ $currency }}
                            </label>
                            <input type="hidden" id="currency" name="currency" value="{{ $currency }}">
                            <input type="hidden" id="price" name="price" value="{{ $price }}">
                            <p class="text-gray-900 text-sm block">
                                {{ round($price, 2) }}
                            </p>
                        </div>
                        <div>
                            <label for="amount" class="block mb-2 text-sm font-medium text-gray-900">
                                Investment amount:
                            </label>
                            <input type="number" id="amount" name="amount" min="0.01" step="0.01"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block p-2.5">
                            @error('amount')
                            <x-error>{{ $message }}</x-error>
                            @enderror
                        </div>
                        <div class="flex flex-col justify-between">
                            <label for="total" class="block mb-5 text-sm font-medium text-gray-900">
                                Total, {{ $currency }}
                            </label>
                            <input type="hidden" id="total" name="total" value="">
                            <p class="text-gray-900 text-sm block">
                                {{ $total }}
                            </p>
                        </div>
                    </div>
                    <div class="flex justify-start items-end ">
                        <input type="hidden" id="cryptoId" name="cryptoId" value="{{ $cryptocurrency['id'] }}">
                        <input type="hidden" id="cryptocurrency" name="cryptocurrency" value="{{ $cryptocurrency['name'] }}">
                        <x-button>
                            Buy
                        </x-button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</x-layout>
