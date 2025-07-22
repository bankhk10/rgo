<header id="main-header" class="flex justify-between items-center py-3 px-6 bg-white-100 sticky top-0 z-50 ">
    {{-- ###### ส่วนซ้าย ###### --}}
    <div class="flex items-center">
        {{-- ปุ่ม Hamburger จะแสดงเมื่อเมนูปิดเท่านั้น และแสดงเฉพาะในจอมือถือ --}}
        <button x-show="!sidebarOpen" @click="sidebarOpen = true" class="text-white focus:outline-none lg:hidden">
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
        </button>

        {{-- ส่วนของ Title หรืออื่นๆ (จะมองเห็นตลอด) --}}
        <div class="relative mx-4 lg:mx-0">
            {{-- <h1 class="text-xl font-semibold">Dashboard</h1> --}}
        </div>
    </div>

    {{-- ###### ส่วนขวา ###### --}}
    <div class="flex items-center">
        {{-- กลุ่มข้อมูลผู้ใช้และ Profile: จะแสดงเมื่อเมนูปิดอยู่เท่านั้น --}}
        <div x-show="!sidebarOpen" class="flex items-center space-x-4">
            @if (auth()->user())
                @php
                    $userDept = auth()->user()->department;
                    $deptMap = [
                        'InternationalProcurement' => 'จัดซื้อต่างประเทศ',
                        'SalesDepartment' => 'ฝ่ายขาย',
                        'ResearchAndDevelopment' => 'วิจัยและพัฒนา',
                        'Academic' => 'แผนกวิชาการ',
                        'Registration' => 'แผนกทะเบียน',
                    ];
                    $mappedDept = $deptMap[$userDept] ?? $userDept;
                @endphp
                <span class="text-white text-lg hidden md:block">
                    คุณ {{ auth()->user()->name }} {{ '[ ' . $mappedDept . ' ]' }}
                </span>
            @endif

            <div x-data="{ dropdownOpen: false }" class="relative">
                @php
                    $profileImage = 'aa_user.png';
                    if (auth()->user()) {
                        if (auth()->user()->prefix == 'นาย') {
                            $profileImage = 'm.png';
                        } elseif (auth()->user()->prefix == 'นาง' || auth()->user()->prefix == 'นางสาว') {
                            $profileImage = 'w.png';
                        }
                    }
                @endphp

                <button @click="dropdownOpen = !dropdownOpen" class="relative block h-8 w-8 rounded-full overflow-hidden shadow focus:outline-none">
                    <img class="h-full w-full object-cover" src="/images/{{ $profileImage }}" alt="Your avatar">
                </button>

                <div x-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 h-full w-full z-10" style="display: none;"></div>

                <div x-show="dropdownOpen" class="absolute right-0 mt-2 w-48 bg-white rounded-md overflow-hidden shadow-xl z-10" style="display: none;" x-cloak>
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <a href="{{ route('admin.logout') }}"
                            onclick="event.preventDefault(); this.closest('form').submit();"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white">
                            ออกจากระบบ
                        </a>
                    </form>
                </div>
            </div>
        </div>

        {{-- ปุ่มปิด 'X' (ฝั่งขวา): จะแสดงเมื่อเมนูเปิดอยู่เท่านั้น และแสดงเฉพาะในจอมือถือ --}}
        {{-- <button x-show="sidebarOpen" @click="sidebarOpen = false" class="text-gray-500 focus:outline-none lg:hidden" x-cloak>
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M6 18L18 6M6 6l12 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button> --}}
    </div>
</header>
