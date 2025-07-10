<x-app-layout>
    <div class="max-w-7xl mx-auto p-8 bg-white shadow-lg rounded-2xl space-y-10 mt-6">
        <h2 class="text-4xl font-extrabold text-gray-700 mb-8 pb-4 text-center border-b border-gray-300">
            แก้ไขผู้ใช้งาน
        </h2>

        <form method="POST" action="{{ route('admin.users.update', $user->id) }}" class="space-y-10">
            @csrf
            @method('PUT')

            {{-- General Information Section --}}
            <div>
                <h3
                    class="text-2xl font-semibold text-white bg-gradient-to-r from-blue-400 to-indigo-400 px-4 py-3 rounded-t-md">
                    ข้อมูลทั่วไป</h3>
                <div class="grid grid-cols-3 md:grid-cols-2 gap-6 mt-4">
                    <div>
                        <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">คำนำหน้า</label>
                        <div class="dropdown" id="prefixDropdown">
                            <div style="height: 50px;" class="text-gray-500 dropdown-btn" id="prefixBtn">--
                                เลือกคำนำหน้า --</div>
                            <div class="dropdown-list" id="prefixList">
                                <div class="dropdown-item text-gray-500" data-value="">-- เลือกคำนำหน้า --</div>
                                <div class="dropdown-item" data-value="นาย">นาย</div>
                                <div class="dropdown-item" data-value="นาง">นาง</div>
                                <div class="dropdown-item" data-value="นางสาว">นางสาว</div>
                            </div>
                        </div>
                        <input type="hidden" name="prefix" id="prefixInput" value="{{ old('prefix') }}">
                        @error('prefix')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">ชื่อผู้ใช้งาน</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}"
                            placeholder="ใส่ชื่อผู้ใช้งาน"
                            class="w-full p-3 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500" />
                        @error('name')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">ตำแหน่ง</label>
                        <div class="dropdown" id="positionDropdown">
                            <div style="height: 50px;" class="text-gray-500 dropdown-btn" id="positionBtn">--
                                เลือกตำแหน่ง --</div>
                            <div class="dropdown-list" id="positionList">
                                <div class="text-gray-500 dropdown-item" data-value="">-- เลือกตำแหน่ง --</div>
                                <div class="dropdown-item" data-value="ceo">บริหาร</div>
                                <div class="dropdown-item" data-value="manager">ผู้จัดการแผนก</div>
                                <div class="dropdown-item" data-value="head">หัวหน้า</div>
                                <div class="dropdown-item" data-value="staff">พนักงาน</div>
                            </div>
                        </div>
                        <input type="hidden" name="position" id="positionInput"
                            value="{{ old('position', $user->position) }}">
                        @error('position')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">รหัสพนักงาน</label>
                        <input type="text" name="employee_id" value="{{ old('employee_id', $user->employee_id) }}"
                            placeholder="ใส่รหัสพนักงาน"
                            class="w-full p-3 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500" />
                        @error('employee_id')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">เบอร์โทรศัพท์</label>
                        <input type="number" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}"
                            placeholder="ใส่เบอร์โทรศัพท์"
                            class="w-full p-3 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500" />
                        @error('phone_number')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Authentication & Roles Section --}}
            <div>
                <h3
                    class="text-2xl font-semibold text-white bg-gradient-to-r from-blue-400 to-indigo-400 px-4 py-3 rounded-t-md">
                    ข้อมูลการเข้าระบบ</h3>
                <div class="grid grid-cols-3 md:grid-cols-2 gap-6 mt-4">

                    <div>
                        <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">อีเมล์เข้าสู่ระบบ</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}"
                            placeholder="ใส่อีเมล"
                            class="w-full p-3 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500" />
                        @error('email')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="relative">
                        <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">รหัสผ่าน</label>
                        <input type="password" name="password" id="password" placeholder="ใส่รหัสผ่าน"
                            class="w-full p-3 pr-12 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500" />
                        {{-- <small class="text-gray-500 mx-3">ปล่อยว่างไว้หากไม่ต้องการเปลี่ยนรหัสผ่าน</small> --}}
                        <span class="mx-2 mt-3 absolute right-4 transform -translate-y-2/2 cursor-pointer text-gray-500"
                            id="togglePassword">
                            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 24 24"
                                fill="none" stroke="#aba6a6" stroke-width="0.9375" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-eye-off-icon lucide-eye-off">
                                <path
                                    d="M10.733 5.076a10.744 10.744 0 0 1 11.205 6.575 1 1 0 0 1 0 .696 10.747 10.747 0 0 1-1.444 2.49" />
                                <path d="M14.084 14.158a3 3 0 0 1-4.242-4.242" />
                                <path
                                    d="M17.479 17.499a10.75 10.75 0 0 1-15.417-5.151 1 1 0 0 1 0-.696 10.75 10.75 0 0 1 4.446-5.143" />
                                <path d="m2 2 20 20" />
                            </svg>
                        </span>
                        {{-- <small class="text-gray-500 mx-3">ปล่อยว่างไว้หากไม่ต้องการเปลี่ยนรหัสผ่าน</small> --}}

                        @error('password')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- <div class="relative">
                        <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">ยืนยันรหัสผ่าน</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="ยืนยันรหัสผ่าน"
                            class="w-full p-3 pr-12 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    </div> --}}

                    <div>
                        <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">แผนกดำเนินการ</label>
                        <div class="dropdown" id="departmentDropdown">
                            <div style="height: 50px;" class="text-gray-500 dropdown-btn" id="departmentBtn">--
                                เลือกแผนกดำเนินการ --</div>
                            <div class="dropdown-list" id="departmentList">
                                <div class="dropdown-item text-gray-500" data-value="">-- เลือกแผนกดำเนินการ --</div>
                                <div class="dropdown-item" data-value="Registration">ทะเบียน</div>
                                <div class="dropdown-item" data-value="InternationalProcurement">จัดซื้อต่างประเทศ
                                </div>
                                <div class="dropdown-item" data-value="ResearchAndDevelopment">วิจัยและพัฒนา</div>
                                <div class="dropdown-item" data-value="Academic">วิชาการ</div>
                                <div class="dropdown-item" data-value="SalesDepartment">ฝ่ายขาย</div>
                                <div class="dropdown-item" data-value="IT">เทคโนโลยีสารสนเทศ</div>
                                <div class="dropdown-item" data-value="no">ไม่มีสิทธิ์ดำเนินการ</div>
                            </div>
                        </div>
                        <input type="hidden" name="department" id="departmentInput"
                            value="{{ old('department', $user->department) }}">
                        @error('department')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        @php
                            function translateRoleName($roleName)
                            {
                                $positions = [
                                    'ceo' => 'ผู้บริหาร',
                                    'manager' => 'ผู้จัดการแผนก',
                                    'head' => 'หัวหน้า',
                                    'staff' => 'พนักงาน',
                                ];
                                $departments = [
                                    'Registration' => 'ทะเบียน',
                                    'InternationalProcurement' => 'จัดซื้อต่างประเทศ',
                                    'ResearchAndDevelopment' => 'วิจัยและพัฒนา',
                                    'Academic' => 'วิชาการ',
                                    'SalesDepartment' => 'ฝ่ายขาย',
                                    'IT' => 'เทคโนโลยีสารสนเทศ',
                                ];
                                $parts = explode(' ', $roleName);
                                $position = $positions[$parts[0]] ?? $parts[0];
                                $department = $departments[$parts[1] ?? ''] ?? ($parts[1] ?? '');
                                return trim("$position $department");
                            }
                            $currentRoleId = optional($user->roles->first())->id;
                        @endphp
                        <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">สิทธิ์</label>
                        <div class="dropdown" id="roleDropdown">
                            <div style="height: 50px;" class="text-gray-500 dropdown-btn" id="roleBtn">--
                                เลือกสิทธิ์
                                --</div>
                            <div class="dropdown-list" id="roleList">
                                <div class="dropdown-item text-gray-500" data-value="">-- เลือกสิทธิ์ --</div>
                                @foreach ($roles as $role)
                                    <div class="dropdown-item" data-value="{{ $role->id }}">
                                        {{ translateRoleName($role->name) }}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <input type="hidden" name="role_id" id="roleInput"
                            value="{{ old('role_id', $currentRoleId) }}">
                        @error('role_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">สถานะการทำงาน</label>
                        <div class="dropdown" id="statusDropdown">
                            <div style="height: 50px;" class="text-gray-500 dropdown-btn" id="statusBtn">--
                                เลือกสถานะ --</div>
                            <div class="dropdown-list" id="statusList">
                                <div class="dropdown-item text-gray-500" data-value="">-- เลือกสถานะ --</div>
                                <div class="dropdown-item" data-value="active">Active</div>
                                <div class="dropdown-item" data-value="inactive">Inactive</div>
                            </div>
                        </div>
                        <input type="hidden" name="employment_status" id="statusInput"
                            value="{{ old('employment_status', $user->employment_status) }}">
                        @error('employment_status')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="flex justify-center gap-4 pt-4">
                <a href="{{ route('admin.users.index') }}"
                    class="bg-gray-500 hover:bg-gray-500 text-white font-bold py-2 px-6 rounded-lg shadow-md flex items-center justify-center">
                    ยกเลิก
                </a>
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg shadow-md">
                    บันทึก
                </button>

            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('password');
            const togglePassword = document.getElementById('togglePassword');

            togglePassword.addEventListener('click', function() {
                const isPassword = passwordInput.type === 'password';
                passwordInput.type = isPassword ? 'text' : 'password';
            });
        });
    </script>

    <script>
        document.getElementById('menu-users')?.classList.add('side-menu--active');

        document.addEventListener('DOMContentLoaded', () => {

            function setupDropdown(btnId, listId, inputId, oldValue = null) {
                const btn = document.getElementById(btnId);
                const list = document.getElementById(listId);
                const input = document.getElementById(inputId);
                const items = list.querySelectorAll('.dropdown-item');

                function updateBtn(label, value) {
                    btn.textContent = label;
                    if (value === "" || label.includes('--')) {
                        btn.classList.add('text-gray-500');
                    } else {
                        btn.classList.remove('text-gray-500');
                    }
                    input.value = value;
                }

                // Initial state and restore old value
                let selectedItem = null;
                if (oldValue) {
                    selectedItem = [...items].find(item => item.dataset.value == oldValue);
                }

                if (selectedItem) {
                    updateBtn(selectedItem.textContent, selectedItem.dataset.value);
                } else {
                    const initial = [...items].find(item => item.dataset.value === "");
                    if (initial) updateBtn(initial.textContent, "");
                }


                btn.addEventListener('click', () => {
                    list.classList.toggle('open');
                    btn.classList.toggle('open');
                });

                items.forEach(item => {
                    item.addEventListener('click', () => {
                        updateBtn(item.textContent, item.dataset.value);
                        list.classList.remove('open');
                        btn.classList.remove('open');
                    });
                });

                document.addEventListener('click', (e) => {
                    if (!btn.closest('.dropdown').contains(e.target)) {
                        list.classList.remove('open');
                        btn.classList.remove('open');
                    }
                });
            }

            // Setup for 'position' dropdown
            setupDropdown('positionBtn', 'positionList', 'positionInput',
                "{{ old('position', $user->position) }}");

            // Setup for 'department' dropdown
            setupDropdown('departmentBtn', 'departmentList', 'departmentInput',
                "{{ old('department', $user->department) }}");

            // Setup for 'role' dropdown
            setupDropdown('roleBtn', 'roleList', 'roleInput', "{{ old('role_id', $currentRoleId) }}");

            // Setup for 'employment_status' dropdown
            setupDropdown('statusBtn', 'statusList', 'statusInput',
                "{{ old('employment_status', $user->employment_status) }}");

            setupDropdown('prefixBtn', 'prefixList', 'prefixInput', "{{ old('prefix', $user->prefix) }}");

        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'บันทึกสำเร็จ!',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'ตกลง'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('admin.users.index') }}";
                }
            })
        </script>
    @endif

    <style>
        * {
            box-sizing: border-box;
        }

        .dropdown-container {
            max-width: 300px;
            margin: auto;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #374151;
            font-size: 16px;
        }

        .dropdown {
            position: relative;
        }

        .dropdown-btn {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #edeff3;
            border-radius: 9999px;
            background-color: #fff;
            cursor: pointer;
            font-size: 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .dropdown-btn:after {
            content: "▾";
            font-size: 26px;
            color: #7f838a;
            margin-left: 8px;
        }

        .dropdown-list {
            position: absolute;
            top: 105%;
            left: 0;
            width: 100%;
            background-color: #fff;
            border: 1px solid #edeff3;
            border-radius: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 10;
            display: none;
            max-height: 230px;
            overflow-y: auto;
        }

        .dropdown-list::-webkit-scrollbar {
            width: 6px;
        }

        .dropdown-list::-webkit-scrollbar-thumb {
            background-color: #cbd5e1;
            border-radius: 3px;
        }

        .dropdown-list::-webkit-scrollbar-track {
            background-color: #f1f5f9;
        }

        .dropdown-list.open {
            display: block;
        }

        .dropdown-item {
            padding: 12px 16px;
            cursor: pointer;
            border-radius: 20px;
        }

        .dropdown-item:last-child {
            border-bottom: none;
        }

        .dropdown-item:hover {
            background-color: #e0f2fe;
        }

        .hidden-input {
            display: none;
        }
    </style>
</x-app-layout>
