<x-layout>

    <x-pop-up-message/>

    <div class="px-4 pt-16 w-[950px]">

        <div class="grid grid-cols-1 w-11/12 mx-auto">
            <x-title>
                Accounts
            </x-title>
            <div class="pt-4">
                <table class="w-full text-sm text-left">
                    <thead class="text-xs text-gray-700 uppercase">
                    <tr>
                        <th scope="col" class="px-4 py-3">Account number</th>
                        <th scope="col" class="px-4 py-3">Bank</th>
                        <th scope="col" class="px-4 py-3">Balance</th>
                        <th scope="col" class="px-4 py-3">Currency</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($accounts as $account)
                        <tr class="border-b border-gray-300">
                            <td class="px-4 py-3">{{ $account->number }}</td>
                            <td class="px-4 py-3">{{ $account->bank }}</td>
                            <td class="px-4 py-3">{{ $account->balance }}</td>
                            <td class="px-4 py-3">{{ $account->currency }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-6">
                <x-button-link :url="'/accounts/delete'">
                    Close account
                </x-button-link>
            </div>
        </div>
    </div>

</x-layout>
