{{-- <header class="flex justify-between items-center py-3 px-6 bg-white-100  border-b-2 sticky top-0 z-50"> --}}
<header class="flex justify-between items-center py-3 px-6 bg-white-100 sticky top-0 z-50">
    <div class="flex items-center">
        <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none lg:hidden">
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round"></path>
            </svg>
        </button>
    </div>
    <div class="flex items-center">
        <div x-data="{ dropdownOpen: false }" class="relative">
            @php

                if (auth()->user()) {
                }
                if (auth()->user()->prefix == 'นาย') {
                    $profileImage = '/m.png';
                } elseif (auth()->user()->prefix == 'นาง' || auth()->user()->prefix == 'นางสาว') {
                    $profileImage = '/w.png';
                } else {
                    $profileImage = '/aa_user.png';
                }
            @endphp

            {{-- <button id="myHiddenButton"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition-opacity duration-300"
                x-data="{ showButton: true }" x-show="showButton" x-transition:opacity
                @scroll.window="showButton = (window.scrollY <= 10)">
                ปุ่มของฉัน
            </button> --}}

            <button @click="dropdownOpen = ! dropdownOpen" x-data="{ showButton: true }" x-show="showButton"
                x-transition:opacity @scroll.window="showButton = (window.scrollY <= 1)"
                class="relative block h-8 w-8 rounded-full overflow-hidden shadow focus:outline-none">
                <img class="h-full w-full object-cover" src="/images/{{ $profileImage }}" alt="">
                {{-- <img class="h-full w-full object-cover" src="/images/{{ auth()->user()->profile ?? '/aa_user.png' }}"
                    alt="Your avatar"> --}}
            </button>

            <div x-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 h-full w-full z-10"
                style="display: none;"></div>

            <div x-show="dropdownOpen"
                class="absolute right-0 mt-2 w-48 bg-white rounded-md overflow-hidden shadow-xl z-10"
                style="display: none;">
                {{-- <a href="{{ route('admin.profile') }}"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white">Profile</a> --}}

                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <a href="{{ route('admin.logout') }}"
                        onclick="event.preventDefault();
                                                this.closest('form').submit();"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white">Logout</a>
                </form>
            </div>
        </div>
    </div>
</header>
