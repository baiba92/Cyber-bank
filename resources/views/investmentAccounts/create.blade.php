<x-layout>

    <div class="px-4 pt-16 w-[950px]">
        <div class="grid grid-cols-1 w-full mx-auto">
            <div class="px-4 mx-auto w-11/12">
                <form action="/accounts/investment" method="POST">
                    @csrf
                    <x-title>
                        New investment account
                    </x-title>
                    <div class="pt-6 flex gap-x-8 justify-start items-end">
                        <div>
                            <label for="title" class="block mb-2 text-sm font-medium text-gray-900">
                                Account title (optional)
                            </label>
                            <input type="text" name="title" id="title"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-64 p-2.5">
                        </div>
                        <div>
                            <label for="currency" class="block mb-2 text-sm font-medium text-gray-900">
                                Base currency:
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
                        </div>
                        <div>
                            <label for="bank" class="block mb-2 text-sm font-medium text-gray-900">
                                Bank
                            </label>
                            <select name="bank" id="bank"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block p-2.5">
                                @foreach($banks as $bank)
                                    <option value="{{ $bank }}">
                                        {{ $bank }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <x-button>
                                Create account
                            </x-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-layout>
