<x-layout>

    <div class="flex gap-x-6 items-start justify-start px-6 py-8 h-[490px]">
        <div class="bg-gray-100 max-w-md w-[300px] h-full">
            <div class="grid grid-col-2 p-6 space-y-3">
                <x-title>
                    Personal information
                </x-title>
                <p class="font-bold">
                    Name:
                </p>
                <p>
                    {{ $user->name }}
                </p>
                <p class="font-bold">
                    E-mail:
                </p>
                <p>
                    {{ $user->email }}
                </p>
                <p class="font-bold">
                    Phone:
                </p>
                <p>
                    {{ $user->phone }}
                </p>
                <p class="font-bold">
                    Address:
                </p>
                <p>
                    {{ $user->address }}
                </p>
            </div>
        </div>
        <div class="bg-gray-100 w-[500px] flex flex-col h-full">
            <div class="pt-6 pl-6">
                <x-title>
                    Unique secret key
                </x-title>
            </div>
            <div class="flex flex-row">
                <div class="px-6 pt-2">
                    <p class="pt-7">
                        This is unique key you will need to make safe transactions.
                        Install an authentication app in your phone (like Google Authenticator or Authy),
                        scan QR code or save the code manually to create account.
                    </p>
                </div>
                <div class="pr-6 pt-2 space-y-3 font-bold flex flex-col items-center">
                    <p>
                        {{ $user->otp_secret }}
                    </p>
                    <p>
                        {!! $qrCode !!}
                    </p>
                </div>
            </div>
            <div class="p-6">
                <p>
                    Both QR and written codes will be seen during the payment process, but for your
                    convenience we suggest to save it before in order to make your transactions faster.
                </p>
            </div>
        </div>
    </div>

</x-layout>
