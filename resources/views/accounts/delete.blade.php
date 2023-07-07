<x-layout>

    <x-pop-up-message/>

    <div class="px-4 pt-16 w-[950px]">

        <div class="grid grid-cols-1 w-11/12 mx-auto">
            <div class="px-4 mx-auto w-full">
                <form action="/accounts/validate-delete" method="POST">
                    @csrf
                    <x-title>
                        Close account
                    </x-title>
                    <div class="flex pt-6 gap-x-8 justify-start items-end">
                        <div>
                            <label for="account" class="block mb-2 text-sm font-medium text-gray-900">
                                Choose account to close:
                            </label>
                            <select name="account" id="account"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block p-2">
                                @foreach($accounts as $account)
                                    <option value="{{ $account->id }}" {{ old('account') == $account->id ? 'selected':'' }}>{{ $account->number }}
                                        &nbsp&nbsp|&nbsp&nbsp{{ $account->balance }} {{ $account->currency }}</option>
                                @endforeach
                            </select>
                            @if(session()->has('balance'))
                                <x-error>{{ session('balance') }}</x-error>
                            @endif
                        </div>
                        <div>
                            <x-button>
                                Close
                            </x-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-layout>
