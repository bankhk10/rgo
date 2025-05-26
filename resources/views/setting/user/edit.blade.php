<x-app-layout>
    <div>
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100">
            <div class="container mx-auto px-6 py-6">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-4xl font-extrabold text-gray-800 tracking-wide">
                        <span class="text-gray-600">แก้ไขผู้ใช้งาน</span>
                    </h1>
                </div>
                <div class="bg-white shadow-md rounded-lg p-6">
                    <form method="POST"
                          action="{{ route('admin.users.update', $user->id) }}">
                        @csrf
                        @method('put')
                        <div class="mb-4">
                            <label for="name"
                                   class="block text-gray-700 text-sm font-bold mb-2">ชื่อผู้ใช้งาน</label>
                            <input id="name"
                                   type="text"
                                   name="name"
                                   value="{{ old('name', $user->name) }}"
                                   placeholder="ใส่ชื่อผู้ใช้งาน"
                                   class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:blue-green-500 focus:ring-2 focus:ring-gray-200 text-gray-800 shadow transition placeholder-gray-400" />
                            @error('name')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="email"
                                   class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                            <input id="email"
                                   type="email"
                                   name="email"
                                   value="{{ old('email', $user->email) }}"
                                   placeholder="ใส่อีเมล"
                                   class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:blue-green-500 focus:ring-2 focus:ring-gray-200 text-gray-800 shadow transition placeholder-gray-400" />
                            @error('email')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>


                        {{-- เพิ่มฟิลด์ แผนก --}}
                        <div class="mb-4">
                            <label for="department"
                                   class="block text-gray-700 text-sm font-bold mb-2">แผนก</label>
                            <input id="department"
                                   type="text"
                                   name="department"
                                   value="{{ old('department', $user->department) }}"
                                   placeholder="ใส่แผนก"
                                   class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:blue-green-500 focus:ring-2 focus:ring-gray-200 text-gray-800 shadow transition placeholder-gray-400" />
                            @error('department')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- เพิ่มฟิลด์ ตำแหน่ง --}}
                        <div class="mb-4">
                            <label for="position"
                                   class="block text-gray-700 text-sm font-bold mb-2">ตำแหน่ง</label>
                            <input id="position"
                                   type="text"
                                   name="position"
                                   value="{{ old('position', $user->position) }}"
                                   placeholder="ใส่ตำแหน่ง"
                                   class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:blue-green-500 focus:ring-2 focus:ring-gray-200 text-gray-800 shadow transition placeholder-gray-400" />
                            @error('position')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- เพิ่มฟิลด์ รหัสพนักงาน --}}
                        <div class="mb-4">
                            <label for="employee_id"
                                   class="block text-gray-700 text-sm font-bold mb-2">รหัสพนักงาน</label>
                            <input id="employee_id"
                                   type="text"
                                   name="employee_id"
                                   value="{{ old('employee_id', $user->employee_id) }}"
                                   placeholder="ใส่รหัสพนักงาน"
                                   class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:blue-green-500 focus:ring-2 focus:ring-gray-200 text-gray-800 shadow transition placeholder-gray-400" />
                            @error('employee_id')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- เพิ่มฟิลด์ เบอร์โทรศัพท์ --}}
                        <div class="mb-4">
                            <label for="phone_number"
                                   class="block text-gray-700 text-sm font-bold mb-2">เบอร์โทรศัพท์</label>
                            <input id="phone_number"
                                   type="text"
                                   name="phone_number"
                                   value="{{ old('phone_number', $user->phone_number) }}"
                                   placeholder="ใส่เบอร์โทรศัพท์"
                                   class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:blue-green-500 focus:ring-2 focus:ring-gray-200 text-gray-800 shadow transition placeholder-gray-400" />
                            @error('phone_number')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- เพิ่มฟิลด์ สถานะการทำงาน --}}
                        <div class="mb-4">
                            <label for="employment_status"
                                   class="block text-gray-700 text-sm font-bold mb-2">สถานะการทำงาน</label>
                            <select id="employment_status"
                                    name="employment_status"
                                    class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:blue-green-500 focus:ring-2 focus:ring-gray-200 text-gray-800 shadow transition">
                                <option value="">-- เลือกสถานะ --</option>
                                <option value="active"
                                        {{ old('employment_status', $user->employment_status) == 'active' ? 'selected' : '' }}>
                                    Active</option>
                                <option value="inactive"
                                        {{ old('employment_status', $user->employment_status) == 'inactive' ? 'selected' : '' }}>
                                    Inactive</option>
                                {{-- คุณสามารถเพิ่มตัวเลือกสถานะอื่นๆ ได้ตามต้องการ --}}
                            </select>
                            @error('employment_status')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password"
                                   class="block text-gray-700 text-sm font-bold mb-2">รหัสผ่าน</label>
                            <input id="password"
                                   type="password"
                                   name="password"
                                   placeholder="ใส่รหัสผ่านใหม่ (ถ้าต้องการเปลี่ยน)"
                                   class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:blue-green-500 focus:ring-2 focus:ring-gray-200 text-gray-800 shadow transition placeholder-gray-400" />
                            @error('password')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                            <small class="text-gray-500">ปล่อยว่างไว้หากไม่ต้องการเปลี่ยนรหัสผ่าน</small>
                        </div>

                        <div class="mb-6">
                            <label for="password_confirmation"
                                   class="block text-gray-700 text-sm font-bold mb-2">ยืนยันรหัสผ่าน</label>
                            <input id="password_confirmation"
                                   type="password"
                                   name="password_confirmation"
                                   placeholder="ยืนยันรหัสผ่านใหม่"
                                   class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:blue-green-500 focus:ring-2 focus:ring-gray-200 text-gray-800 shadow transition placeholder-gray-400" />
                        </div>


                        <h3 class="text-xl mt-6 mb-4 text-gray-600">สิทธิ์</h3>
                        <div class="grid grid-cols-4 gap-4">
                            @foreach ($roles as $role)
                                <label class="flex items-center cursor-pointer select-none">
                                    <input type="checkbox"
                                           class="form-checkbox h-5 w-5 text-blue-600 rounded border-gray-300 focus:ring-blue-500"
                                           name="roles[]"
                                           value="{{ $role->id }}"
                                           @if (count($user->roles->where('id', $role->id))) checked @endif>
                                    <span class="ml-2 text-gray-700">{{ $role->name }}</span>
                                </label>
                            @endforeach
                        </div>

                        <div class="text-center mt-10">
                            <a href="{{ route('admin.users.index') }}"
                               class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-lg shadow transition duration-300 mr-4">
                                <i class="fa-solid fa-arrow-left mr-2"></i> ย้อนกลับ
                            </a>
                            <button type="submit"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline">
                                บันทึก
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'สำเร็จ!',
                text: '{{ session('success') }}',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'ตกลง'
            });
        </script>
    @endif
</x-app-layout>
