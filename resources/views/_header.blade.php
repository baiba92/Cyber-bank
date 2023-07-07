<div class="absolute z-50 top-0 w-screen drop-shadow-lg bg-white border-b-4 border-[#28816c] px-8 h-20 flex justify-between items-center">

        <div class="flex justify-start items-center">
            <a href="/home" class="flex items-center justify-between mr-4">
                <img src="/images/cb_logo.png" class="mr-3 h-7" alt="Cyber Bank"/>
                <img src="/images/cb_title.png" class="mt-1 h-4" alt="Cyber Bank"/>
            </a>
        </div>
        <div class="flex items-center lg:order-2">
            @auth
                <p class="p-2 m-3 text-[#28816c] text-sm font-semibold uppercase">
                    Hello, {{ auth()->user()->name }}!
                </p>
                <a href="/profile"
                   class="p-2 m-3 text-gray-500 text-sm hover:text-[#28816c] transition duration-500 uppercase">
                    Profile
                </a>
                <form action="/logout" method="POST">
                    @csrf
                    <button type="submit" class="p-2 m-3 text-gray-500 text-sm transition duration-500 hover:text-[#28816c] uppercase">
                        Log out
                    </button>
                </form>
            @endauth
            @guest
                <a href="/register"
                   class="p-2 m-3 text-gray-400 text-sm font-bold hover:text-[#28816c] transition duration-400 uppercase">
                    Register
                </a>
                <a href="/"
                   class="p-2 m-3 text-gray-400 text-sm font-bold hover:text-[#28816c] transition duration-400 uppercase">
                    Log in
                </a>
            @endguest
        </div>

</div>
