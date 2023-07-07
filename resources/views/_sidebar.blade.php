<div class="uppercase pt-28 -mt-20 -mb-12 bg-white w-[250px] min-h-screen">

    <ul>
        <li>
            <div x-data="{ active: false }">
            <button type="button" @click="active = !active" :class="active ? 'bg-gray-100 text-[#28816c]' : ''"
                    class="py-4 flex items-center w-full text-base transition duration-700 group hover:text-[#28816c] hover:bg-gray-100"
                    aria-controls="dropdown-accounts" data-collapse-toggle="dropdown-accounts">
                            <span class="uppercase text-base text-gray-500 font-semibold flex-1 pl-8 text-left whitespace-nowrap">
                                Accounts
                            </span>
                <span class="w-[250px] pr-4 py-4 flex justify-end absolute hover:animate-bounce">
                <svg style="color: rgb(36, 144, 110);" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                     fill="currentColor" class="bi bi-chevron-double-down" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                          d="M1.646 6.646a.5.5 0 0 1 .708 0L8 12.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"
                          fill="#209285"></path>
                    <path fill-rule="evenodd"
                          d="M1.646 2.646a.5.5 0 0 1 .708 0L8 8.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"
                          fill="#209285"></path>
                </svg>
                    </span>
            </button>
            </div>
            <ul id="dropdown-accounts" class="hidden space-y-2 text-xs">
                <li class="relative group">
                    <a href="/accounts"
                       class="flex items-center hover:text-[#28816c] hover:border-gray-100 border-b-[2px] border-white p-3 pl-12 w-full font-medium text-gray-900 transition duration-600 group">
                        All
                    </a>
                </li>
                <li>
                    <a href="/accounts/add"
                       class="flex items-center hover:text-[#28816c] hover:border-gray-100 border-b-[2px] border-white p-3 pl-12 w-full font-medium text-gray-900 transition duration-600 group">
                        Add account
                    </a>
                </li>
                <li>
                    <a href="/accounts/investment"
                       class="flex items-center hover:text-[#28816c] hover:border-gray-100 border-b-[2px] border-white p-3 pl-12 w-full font-medium text-gray-900 transition duration-600 group">
                        Investment accounts
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <div x-data="{ active: false }">
            <button type="button" @click="active = !active" :class="active ? 'bg-gray-100 text-[#28816c]' : ''"
                    class="py-4 flex items-center w-full text-base transition duration-700 group hover:text-[#28816c] hover:bg-gray-100"
                    aria-controls="dropdown-transactions" data-collapse-toggle="dropdown-transactions">
                            <span class="uppercase text-base text-gray-500 font-semibold flex-1 pl-8 text-left whitespace-nowrap">
                                Transactions
                            </span>
                <span class="w-[250px] pr-4 py-4 flex justify-end absolute hover:animate-bounce">
                <svg style="color: rgb(36, 144, 110);" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                     fill="currentColor" class="bi bi-chevron-double-down" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                          d="M1.646 6.646a.5.5 0 0 1 .708 0L8 12.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"
                          fill="#209285"></path>
                    <path fill-rule="evenodd"
                          d="M1.646 2.646a.5.5 0 0 1 .708 0L8 8.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"
                          fill="#209285"></path>
                </svg>
                    </span>
            </button>
            </div>
            <ul id="dropdown-transactions" class="hidden space-y-2 text-xs">
                <li>
                    <a href="/transaction"
                       class="flex items-center hover:text-[#28816c] hover:border-gray-100 border-b-[3px] border-white p-3 pl-12 w-full font-medium text-gray-900 transition duration-700 group">
                        New transaction
                    </a>
                </li>
                <li>
                    <a href="/transaction/history"
                       class="flex items-center hover:text-[#28816c] hover:border-gray-100 border-b-[3px] border-white p-3 pl-12 w-full font-medium text-gray-900 transition duration-700 group">
                        History
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</div>
