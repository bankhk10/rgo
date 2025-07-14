<header  id="main-header"  class="flex justify-between items-center py-3 px-6 bg-white-100 sticky top-0 z-50 ">
    <div class="flex items-center">
        {{-- <img src="/images/your_logo.png" alt="Logo" class="h-8 w-auto mr-4"> --}}

        <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none lg:hidden">
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round"></path>
            </svg>
        </button>
    </div>

    <div class="flex items-center space-x-4">
        @if (auth()->user())
            <span class="text-gray-700 text-lg hidden md:block">
                คุณ  {{ auth()->user()->name }}
                {{-- {{ auth()->user()->prefix }} {{ auth()->user()->first_name }} {{ auth()->user()->last_name }} --}}
            </span>
        @endif

        <div x-data="{ dropdownOpen: false }" class="relative">
            @php
                $profileImage = '/aa_user.png'; // Default image

                if (auth()->user()) {
                    if (auth()->user()->prefix == 'นาย') {
                        $profileImage = '/m.png';
                    } elseif (auth()->user()->prefix == 'นาง' || auth()->user()->prefix == 'นางสาว') {
                        $profileImage = '/w.png';
                    }
                }
            @endphp

            <button @click="dropdownOpen = ! dropdownOpen"
                class="relative block h-8 w-8 rounded-full overflow-hidden shadow focus:outline-none">
                <img class="h-full w-full object-cover" src="/images/{{ $profileImage }}" alt="Your avatar">
            </button>

            <div x-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 h-full w-full z-10"
                style="display: none;"></div>

            <div x-show="dropdownOpen"
                class="absolute right-0 mt-2 w-48 bg-white rounded-md overflow-hidden shadow-xl z-10"
                style="display: none;">
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <a href="{{ route('admin.logout') }}"
                        onclick="event.preventDefault(); this.closest('form').submit();"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white">
                        Logout
                    </a>
                </form>
            </div>
        </div>

        {{-- <form method="POST" action="{{ route('admin.logout') }}" class="hidden md:block">
            @csrf
            <button type="submit"
                class="px-4 py-2 text-sm text-gray-700 bg-gray-200 rounded-md hover:bg-indigo-600 hover:text-white focus:outline-none">
                Logout
            </button>
        </form> --}}
    </div>
</header>
