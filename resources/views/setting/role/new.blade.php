<x-app-layout>
    <div>
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100">
            <div class="container mx-auto px-6 py-6">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-4xl font-extrabold text-gray-800 tracking-wide">
                        <span class="text-gray-600">สร้าง Role ใหม่</span>
                    </h1>
                    <div>
                        <a href="{{ route('admin.roles.index') }}"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-lg shadow transition duration-300">
                            <i class="fa-solid fa-arrow-left mr-2"></i> ย้อนกลับ
                        </a>
                    </div>
                </div>
                <div class="bg-white shadow-md rounded-lg p-6">
                    <form method="POST" action="{{ route('admin.roles.store') }}">
                        @csrf
                        @method('post')
                        <div class="mb-4">
                            <label for="role_name" class="block text-gray-700 text-sm font-bold mb-2">ชื่อ Role</label>
                            <input id="role_name" type="text" name="name" value="{{ old('name') }}"
                                placeholder="ใส่ชื่อ Role"
                                class="w-80 px-4 py-2 rounded-lg border border-gray-300 focus:blue-green-500 focus:ring-2 focus:ring-gray-200 text-gray-800  shadow transition placeholder-gray-400" />
                            @error('name')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <h3 class="text-xl mt-6 mb-4 text-gray-600">รายชื่อสิทธิ์</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach ($permissions as $permission)
                                <label class="flex items-center cursor-pointer select-none">
                                    <input type="checkbox" id="permission_{{ $permission->id }}"
                                        class="form-checkbox h-5 w-5 text-blue-600 rounded border-gray-300 focus:ring-blue-500"
                                        name="permissions[]" value="{{ $permission->id }}"
                                        @if (is_array(old('permissions')) && in_array($permission->id, old('permissions'))) checked @endif>
                                    <span class="ml-2 text-gray-700">{{ $permission->name }}</span>
                                </label>
                            @endforeach
                        </div>

                        <div class="text-center mt-8">
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
