<x-layout>

    <x-pop-up-message/>

    <div class="px-4 pt-16 w-[950px]">

        <div class="grid grid-cols-1 w-11/12 mx-auto">
            <div class="flex justify-between items-end mb-4">
                <x-title>
                    Cryptocurrencies
                </x-title>
                <form action="/accounts/investment/cryptocurrencies" method="GET" id="currencySelection">
                    @csrf
                    <div class="flex gap-x-2 items-center">
                        <label for="selectedCurrency" class="block text-sm font-medium text-gray-900">
                            Currency to list prices:
                        </label>
                        <select name="selectedCurrency" id="selectedCurrency" onchange="onSelectChange();"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block p-2">
                            <option value="" selected disabled>--Choose--</option>
                            <option value="EUR">
                                EUR
                            </option>
                            @foreach($currencies as $currency)
                                <option value="{{ $currency }} {{ old('selectedCurrency') == $currency ? 'selected':'' }}">
                                    {{ $currency }}
                                </option>
                            @endforeach
                        </select>
                        {{ session('currency') }}
                    </div>
                </form>
            </div>

            <div>
                <table class="w-full text-sm text-left">
                    <thead class="text-xs text-gray-700 uppercase">
                    <tr>
                        <th scope="col" class="px-2 py-3">Name</th>
                        <th scope="col" class="px-2 py-3">Currency</th>
                        <th scope="col" class="px-2 py-3">Price</th>
                        <th scope="col" class="px-2 py-3">1h %</th>
                        <th scope="col" class="px-2 py-3">24h %</th>
                        <th scope="col" class="px-2 py-3">7d %</th>
                        <th scope="col" class="px-2 py-3">Market Cap</th>
                        <th scope="col" class="px-2 py-3"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($cryptocurrencies as $cryptocurrency)
                        <tr class="border-b border-gray-300">
                            <td class="px-2 py-3">{{ $cryptocurrency['name'] }}</td>
                            <td class="px-2 py-3">{{ $selectedCurrency }}</td>
                            <td class="px-2 py-3">{{ $cryptocurrency['price'] }}</td>
                            <td class="px-2 py-3 @if ($cryptocurrency['1h'] < 0) text-red-500 @endif text-green-500">
                                {{ $cryptocurrency['1h'] }}
                            </td>
                            <td class="px-2 py-3 @if ($cryptocurrency['24h'] < 0) text-red-500 @endif text-green-500">
                                {{ $cryptocurrency['24h'] }}
                            </td>
                            <td class="px-2 py-3 @if ($cryptocurrency['7d'] < 0) text-red-500 @endif text-green-500">
                                {{ $cryptocurrency['7d'] }}
                            </td>
                            <td class="px-2 py-3">{{ $cryptocurrency['marketCap'] }}</td>
                            <td class="px-2 py-3">
                                <form action="/accounts/investment/cryptocurrencies/buy" method="GET">
                                    @csrf
                                    <input type="hidden" name="cryptocurrency" value="{{ $cryptocurrency['id_cur'] }}">
                                    <x-button>
                                        Buy
                                    </x-button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<script type="text/javascript">
    function onSelectChange() {
        document.getElementById('currencySelection').submit();
    }
</script>

</x-layout>
