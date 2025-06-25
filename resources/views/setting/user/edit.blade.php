<x-app-layout>
    <div class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-2xl space-y-6 mt-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4 text-center">แก้ไขผู้ใช้งาน</h2>
        <form method="POST" action="{{ route('admin.users.update', $user->id) }}" class="grid md:grid-cols-2 gap-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-gray-700 mb-1">ชื่อผู้ใช้งาน</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                    class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
                @error('name')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-gray-700 mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                    class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
                @error('email')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-gray-700 mb-1">แผนก</label>
                <select name="department"
                    class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">-- เลือกแผนก --</option>
                    <option value="regis" {{ old('department', $user->department) == 'regis' ? 'selected' : '' }}>
                        ทะเบียน</option>
                    <option value="po" {{ old('department', $user->department) == 'po' ? 'selected' : '' }}>
                        จัดซื้อต่างประเทศ</option>
                    <option value="rd" {{ old('department', $user->department) == 'rd' ? 'selected' : '' }}>
                        วิจัยและพัฒนา</option>
                    <option value="acad" {{ old('department', $user->department) == 'acad' ? 'selected' : '' }}>
                        วิชาการ</option>
                    <option value="sale" {{ old('department', $user->department) == 'sale' ? 'selected' : '' }}>
                        ฝ่ายขาย</option>
                    <option value="it" {{ old('department', $user->department) == 'it' ? 'selected' : '' }}>ไอที
                    </option>
                </select>
                @error('department')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-gray-700 mb-1">ตำแหน่ง</label>
                <input type="text" name="position" value="{{ old('position', $user->position) }}"
                    class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
                @error('position')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-gray-700 mb-1">รหัสพนักงาน</label>
                <input type="text" name="employee_id" value="{{ old('employee_id', $user->employee_id) }}"
                    class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
                @error('employee_id')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-gray-700 mb-1">เบอร์โทรศัพท์</label>
                <input type="text" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}"
                    class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
                @error('phone_number')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-gray-700 mb-1">รหัสผ่าน</label>
                <input type="password" name="password"
                    class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
                <small class="text-gray-500">ปล่อยว่างไว้หากไม่ต้องการเปลี่ยนรหัสผ่าน</small>
                @error('password')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-gray-700 mb-1">ยืนยันรหัสผ่าน</label>
                <input type="password" name="password_confirmation"
                    class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            <div>
                <label class="block text-gray-700 mb-1">สถานะการทำงาน</label>
                <select name="employment_status"
                    class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">-- เลือกสถานะ --</option>
                    <option value="active"
                        {{ old('employment_status', $user->employment_status) == 'active' ? 'selected' : '' }}>
                        Active</option>
                    <option value="inactive"
                        {{ old('employment_status', $user->employment_status) == 'inactive' ? 'selected' : '' }}>
                        Inactive</option>
                </select>
                @error('employment_status')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="md:col-span-2">
                <label class="block text-gray-700 mb-2">สิทธิ์</label>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-2">
                    @foreach ($roles as $role)
                        <label class="flex items-center">
                            <input type="checkbox" name="roles[]" value="{{ $role->id }}"
                                class="form-checkbox h-5 w-5 text-blue-600 border-gray-300"
                                @if ($user->roles->pluck('id')->contains($role->id)) checked @endif>
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
