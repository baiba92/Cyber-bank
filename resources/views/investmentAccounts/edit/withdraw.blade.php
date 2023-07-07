<x-layout>

    <x-pop-up-message/>

    <div class="px-4 pt-16 w-[950px]">

        <div class="grid grid-cols-1 w-11/12 mx-auto">
            <div class="px-4 mx-auto w-full">
                <form action="/validate" method="POST">
                    @csrf
                    <x-title>
                        Make withdrawal
                    </x-title>
                    <div class="pt-6 mb-4">
                        <label for="account_from" class="block mb-2 text-sm font-medium text-gray-900">
                            Choose investment account to withdraw:
                        </label>
                        <select name="account_from" id="account_from"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block p-2">
                            @foreach($investmentAccounts as $account)
                                <option value="{{ $account->id }}" {{ old('account_from') == $account->id ? 'selected':'' }}>{{ $account->number }}
                                    &nbsp&nbsp|&nbsp&nbsp{{ $account->balance }} {{ $account->currency }}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="flex gap-x-8 justify-start items-end">
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
                        <div>
                            <label for="amount" class="block mb-2 text-sm font-medium text-gray-900">
                                Amount
                            </label>
                            <input type="number" name="amount" id="amount" min="0.01" step="0.01"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                            @error('amount')
                            <x-error>{{ $message }}</x-error>
                            @enderror
                        </div>
                        <div>
                            <x-button>
                                Withdraw
                            </x-button>
                        </div>
                    </div>
                </form>
                <p class="block mt-8 text-sm text-gray-900">
                    NB: If value of withdrawal exceeds deposit value in chosen investment account, capital gains tax of 20% will be applied to the difference.
                </p>
            </div>
        </div>
    </div>

</x-layout>
