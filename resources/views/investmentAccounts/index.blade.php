<x-layout>

    <x-pop-up-message/>

    <div class="px-4 pt-16 w-[950px]">

        <div class="grid grid-cols-1 w-11/12 mx-auto">
            <x-title>
                Investment accounts
            </x-title>
            <div class="pt-6">
                <table class="w-full text-sm text-left">
                    <thead class="text-xs text-gray-700 uppercase">
                    <tr>
                        <th scope="col" class="px-4 py-3">Title</th>
                        <th scope="col" class="px-4 py-3">Account number</th>
                        <th scope="col" class="px-4 py-3">Bank</th>
                        <th scope="col" class="px-4 py-3">Currency</th>
                        <th scope="col" class="px-4 py-3">Deposit</th>
                        <th scope="col" class="px-4 py-3">Balance</th>
                        <th scope="col" class="px-4 py-3">Withdrawal</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($accounts as $account)
                        <tr class="border-b border-gray-300">
                            <td class="px-4 py-3">{{ $account->title }}</td>
                            <td class="px-4 py-3">{{ $account->number }}</td>
                            <td class="px-4 py-3">{{ $account->bank }}</td>
                            <td class="px-4 py-3">{{ $account->currency }}</td>
                            <td class="px-4 py-3">{{ $account->deposit }}</td>
                            <td class="px-4 py-3">{{ $account->balance }}</td>
                            <td class="px-4 py-3">{{ $account->withdrawal }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="py-4 flex justify-between">
            <div class="flex gap-x-4">
                <div class="mt-6">
                    <x-button-link :url="'/accounts/investment/new'">
                        Open new account
                    </x-button-link>
                </div>
                <div class="mt-6">
                    <x-button-link :url="'/accounts/investment/delete'">
                        Close account
                    </x-button-link>
                </div>
                <div class="mt-6">
                    <x-button-link :url="'/accounts/investment/deposit'">
                        Make deposit
                    </x-button-link>
                </div>
                <div class="mt-6">
                    <x-button-link :url="'/accounts/investment/withdraw'">
                        Make withdrawal
                    </x-button-link>
                </div>
            </div>
            <div class="my-6">
                <x-button-link :url="'/accounts/investment/cryptocurrencies'">
                    Invest into cryptocurrencies
                </x-button-link>
            </div>
        </div>

        <div class="grid grid-cols-1 w-11/12 mx-auto">
            <x-title>
                Owned Crypto assets
            </x-title>
            <div class="pt-6">
                <table class="w-full text-sm text-left">
                    <thead class="text-xs text-gray-700 uppercase">
                    <tr>
                        <th scope="col" class="px-2 py-3">Account</th>
                        <th scope="col" class="px-2 py-3">Currency</th>
                        <th scope="col" class="px-2 py-3">Cryptocurrency</th>
                        <th scope="col" class="px-2 py-3">Price</th>
                        <th scope="col" class="px-2 py-3">Owned crypto parts</th>
                        <th scope="col" class="px-2 py-3">Investment</th>
                        <th scope="col" class="px-2 py-3">Total value now</th>
                        <th scope="col" class="px-2 py-3">Profit</th>
                        <th scope="col" class="px-2 py-3">Transaction date</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($cryptoTransactions as $transaction)
                        <tr class="border-b border-gray-300">
                            @foreach($accounts as $account)
                                @if($account->id == $transaction->account_id)
                                    <td class="px-2 py-3">{{ $account->title }}</td>
                                @endif
                            @endforeach
                            <td class="px-2 py-3">{{ $transaction->currency }}</td>
                            <td class="px-2 py-3">{{ $transaction->cryptocurrency }}</td>
                            <td class="px-2 py-3">{{ $transaction->price }}</td>
                            <td class="px-2 py-3">{{ $transaction->crypto_parts }}</td>
                            <td class="px-2 py-3 font-bold">{{ $transaction->invest }}</td>
                            <form action="/accounts/investment/cryptocurrencies/sell" method="GET">
                                @csrf
                                @foreach($cryptocurrencies as $currency)
                                    @if($transaction->crypto_id == $currency['id'])
                                        <td class="px-2 py-3 font-bold">
                                            {{ round(($currency['price'] * $transaction->crypto_parts), 2) }}
                                        </td>
                                        <input type="hidden" name="value"
                                               value="{{ round(($currency['price'] * $transaction->crypto_parts), 2) }}">
                                        <td class="px-2 py-3 font-bold
                                        @if (($currency['price'] * $transaction->crypto_parts) - $transaction->invest < 0)
                                        text-red-500
                                        @endif text-green-500">
                                            {{ round((($currency['price'] * $transaction->crypto_parts) - $transaction->invest), 2) }}
                                        </td>
                                    @endif
                                @endforeach
                                <td class="px-2 py-3">{{ explode(' ', $transaction->created_at)[0] }}</td>
                                <td class="px-2 py-3">
                                    <input type="hidden" name="cryptocurrency"
                                           value="{{ $transaction->cryptocurrency }}">
                                    <input type="hidden" name="cryptoParts" value="{{ $transaction->crypto_parts }}">
                                    <input type="hidden" name="currency" value="{{ $transaction->currency }}">
                                    <input type="hidden" name="transactionId" value="{{ $transaction->id }}">
                                    <input type="hidden" name="price" value="{{ $transaction->price }}">
                                    <x-button>
                                        Sell
                                    </x-button>
                                </td>
                            </form>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</x-layout>
