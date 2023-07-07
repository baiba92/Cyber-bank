<x-layout>

    <x-pop-up-message/>

    <div class="px-4 pt-16 w-[950px]">

        <div class="grid grid-cols-1 w-11/12 mx-auto">
            <div>
                <x-title>
                    Transaction history
                </x-title>
            </div>
            <div class="pt-6 mb-4" x-data="{ accountSelection: ''}">
                <form action="/transaction/history" method="GET" id="accountSelection">
                    @csrf
                    <label for="chosenAccount" class="block mb-2 text-sm font-medium text-gray-900">
                        Choose account:
                    </label>
                    <select name="chosenAccount" id="chosenAccount" @change="onSelectChange()"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:border-emerald-600 focus:ring-[#28816c] block p-2">
                        <option value="" selected disabled>--Accounts--</option>
                        @foreach($accounts as $account)
                            <option value="{{ $account->id }}" {{ session('account') == $account->id ? 'selected':'' }}>{{ $account->number }}
                                &nbsp&nbsp|&nbsp&nbsp{{ $account->balance }} {{ $account->currency }}</option>
                        @endforeach
                    </select>
                </form>
            </div>

            @if(count($transactions) > 0)
            <div>
                <table class="w-full text-sm text-left">
                    <thead class="text-xs text-gray-700 uppercase">
                    <tr>
                        <th scope="col" class="px-4 py-3">Date</th>
                        <th scope="col" class="px-4 py-3">Recipient</th>
                        <th scope="col" class="px-4 py-3">Description</th>
                        <th scope="col" class="px-4 py-3">Amount</th>
                        <th scope="col" class="px-4 py-3">Currency</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($transactions as $transaction)
                        <tr class="border-b border-gray-300">
                            <td class="px-4 py-3">{{ explode(' ', $transaction->created_at)[0] }}</td>
                            <td class="px-4 py-3">{{ $transaction->name }}</td>
                            <td class="px-4 py-3">{{ $transaction->description }}</td>
                            <td class="px-4 py-3">{{ $transaction->amount }}</td>
                            <td class="px-4 py-3">{{ $transaction->currency }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </div>

    <script type="text/javascript">
        function onSelectChange() {
            document.getElementById('accountSelection').submit();
        }
    </script>

</x-layout>
