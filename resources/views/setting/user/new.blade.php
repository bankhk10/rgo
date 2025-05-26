<x-app-layout>
    <div class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-2xl space-y-6 mt-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4 text-center">สร้างผู้ใช้งานใหม่</h2>

        <form method="POST"
              action="{{ route('admin.users.store') }}"
              class="grid grid-cols-2 md:grid-cols-2 gap-4">
            @csrf
            @method('post')

            <div>
                <label class="block text-gray-700 mb-1">ชื่อผู้ใช้งาน</label>
                <input type="text"
                       name="name"
                       value="{{ old('name') }}"
                       placeholder="ใส่ชื่อผู้ใช้งาน"
                       class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
                @error('name')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-gray-700 mb-1">Email</label>
                <input type="email"
                       name="email"
                       value="{{ old('email') }}"
                       placeholder="ใส่อีเมล"
                       class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
                @error('email')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-gray-700 mb-1">แผนก</label>
                <input type="text"
                       name="department"
                       value="{{ old('department') }}"
                       placeholder="ใส่แผนก"
                       class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
                @error('department')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-gray-700 mb-1">ตำแหน่ง</label>
                <input type="text"
                       name="position"
                       value="{{ old('position') }}"
                       placeholder="ใส่ตำแหน่ง"
                       class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
                @error('position')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-gray-700 mb-1">รหัสพนักงาน</label>
                <input type="text"
                       name="employee_id"
                       value="{{ old('employee_id') }}"
                       placeholder="ใส่รหัสพนักงาน"
                       class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
                @error('employee_id')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-gray-700 mb-1">เบอร์โทรศัพท์</label>
                <input type="text"
                       name="phone_number"
                       value="{{ old('phone_number') }}"
                       placeholder="ใส่เบอร์โทรศัพท์"
                       class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
                @error('phone_number')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-gray-700 mb-1">รหัสผ่าน</label>
                <input type="password"
                       name="password"
                       placeholder="ใส่รหัสผ่าน"
                       class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
                @error('password')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-gray-700 mb-1">ยืนยันรหัสผ่าน</label>
                <input type="password"
                       name="password_confirmation"
                       placeholder="ยืนยันรหัสผ่าน"
                       class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            <div>
                <label class="block text-gray-700 mb-1">สถานะการทำงาน</label>
                <select name="employment_status"
                        class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">-- เลือกสถานะ --</option>
                    <option value="active"
                            {{ old('employment_status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive"
                            {{ old('employment_status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
                @error('employment_status')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="md:col-span-2">
                <h3 class="text-lg font-medium text-gray-700 mb-2 mt-4">สิทธิ์</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach ($roles as $role)
                        <label class="flex items-center">
                            <input type="checkbox"
                                   name="roles[]"
                                   value="{{ $role->id }}"
                                   class="form-checkbox h-5 w-5 text-blue-600 rounded border-gray-300 focus:ring-blue-500">
                            <span class="ml-2 text-gray-700">{{ $role->name }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="text-right mt-8">
                <a href="{{ route('admin.users.index') }}"
                   class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-lg shadow transition duration-300">
                    <i class="fa-solid fa-arrow-left mr-2"></i> ย้อนกลับ
                </a>
            </div>

            <div class="text-left mt-6">
                <button type="submit"
                        class="bg-blue-800 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline shadow-md">
                    บันทึก
                </button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'บันทึกสำเร็จ!',
                // text: '{{ session('success') }}',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'ตกลง'
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    window.location.href = "{{ route('admin.users.index') }}";
                }
            })
        </script>
    @endif
</x-app-layout>
