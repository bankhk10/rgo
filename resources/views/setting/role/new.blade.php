<x-app-layout>
    <div>
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100">
            <div class="container mx-auto px-6 py-6">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-4xl font-extrabold text-gray-800 tracking-wide">
                        <span class="text-gray-600">สร้างสิทธิ์การใช้งาน</span>
                    </h1>

                </div>
                <form method="POST"
                      action="{{ route('admin.roles.store') }}">
                    @csrf
                    @method('post')
                    <div class="mb-4">
                        <label for="role_name"
                               class="inline-block text-xl mt-10 mb-4 text-gray-600 mr-4">ชื่อสิทธิ์การใช้งาน : </label>
                        <input id="role_name"
                               type="text"
                               name="name"
                               value="{{ old('name') }}"
                               placeholder="ใส่ชื่อสิทธิ์"
                               class="inline-block w-auto px-4 py-2 rounded-lg border border-gray-300 focus:blue-green-500 focus:ring-2 focus:ring-gray-200 text-gray-800 shadow transition placeholder-gray-400 mt-2" />
                        @error('name')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>

                    <h3 class="text-xl mt-10 mb-4 text-gray-600">สิทธิ์การเข้าถึงแต่ละเมนู</h3>
                    <div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-200">
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white">
                                <thead>
                                    <tr class="bg-indigo-600 text-white text-left">
                                        <th class="py-4 px-8 rounded-tl-2xl">เมนู</th>
                                        <th class="py-4 px-8 text-center">อ่าน</th>
                                        <th class="py-4 px-8 text-center">สร้าง</th>
                                        <th class="py-4 px-8 text-center">แก้ไข</th>
                                        <th class="py-4 px-8 rounded-tr-2xl text-center">ลบ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permissions as $menu => $actions)
                                        <tr class="border-b hover:bg-gray-50 transition">
                                            <td class="py-4 px-8 font-semibold text-gray-700">{{ $menu }}
                                            </td>
                                            @foreach (['read', 'create', 'update', 'delete'] as $action)
                                                <td class="py-4 px-8 text-center">
                                                    @if (isset($actions[$action]))
                                                        <input type="checkbox"
                                                               id="permission_{{ $actions[$action]->id }}"
                                                               name="permissions[]"
                                                               value="{{ $actions[$action]->id }}"
                                                               class="form-checkbox h-5 w-5 text-blue-600 rounded border-gray-300 focus:ring-blue-500"
                                                               @if (is_array(old('permissions')) && in_array($actions[$action]->id, old('permissions'))) checked @endif>
                                                    @endif
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="text-center mt-8">
                        <a href="{{ route('admin.roles.index') }}"
                           class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-lg shadow transition duration-300 mr-2">
                            <i class="fa-solid fa-arrow-left mr-2"></i> ย้อนกลับ
                        </a>
                        <button type="submit"
                                class="bg-blue-800 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline shadow-md ml-2">
                            บันทึก
                        </button>
                    </div>
                </form>
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
