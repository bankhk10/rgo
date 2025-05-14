<x-app-layout>
    <div>
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100">
            <div class="container mx-auto px-6 py-6">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-4xl font-extrabold text-gray-800 tracking-wide">
                        <span class="text-gray-600">แก้ไข Permission</span>
                    </h1>
                    <div>
                        <a href="{{ route('admin.permissions.index') }}"
                           class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-lg shadow transition duration-300">
                            <i class="fa-solid fa-arrow-left mr-2"></i> ย้อนกลับ
                        </a>
                    </div>
                </div>
                <div class="bg-white shadow-md rounded-lg p-6">
                    <form method="POST" action="{{ route('admin.permissions.update',$permission->id) }}">
                        @csrf
                        @method('put')
                        <div class="mb-4">
                            <label for="role_name" class="block text-gray-700 text-sm font-bold mb-2">ชื่อ Permission</label>
                            <input id="role_name" type="text" name="name" value="{{ old('name',$permission->name) }}"
                                   placeholder="ใส่ชื่อ Permission"
                                   class="w-80 px-4 py-2 rounded-lg border border-gray-300 focus:blue-green-500 focus:ring-2 focus:ring-gray-200 text-gray-800 shadow transition placeholder-gray-400"/>
                            @error('name')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="text-center mt-8">
                            <button type="submit"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline">
                                บันทึกการเปลี่ยนแปลง
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
