<x-app-layout>
    <div>
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100">
            <div class="container mx-auto px-6 py-6">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-4xl font-extrabold text-gray-800 tracking-wide">
                        <span class="text-gray-600">จัดการ Roles</span>
                    </h1>
                    @can('Role create')
                        <a href="{{ route('admin.roles.create') }}"
                           class="bg-blue-500 text-white font-bold px-5 py-2 rounded-lg shadow hover:bg-blue-600 transition duration-300">
                            + สร้าง Role
                        </a>
                    @endcan
                </div>

                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <table class="min-w-full bg-white">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 text-sm leading-normal">
                                <th class="py-3 px-6 text-left w-1/6 min-w-[180px]">ชื่อ Role</th>
                                <th class="py-3 px-6 text-left">สิทธิ์</th>
                                <th class="py-3 px-6 text-right w-1/6 min-w-[180px]">การดำเนินการ</th>
                                {{-- <th class="py-3 px-6 text-right">การดำเนินการ</th> --}}
                            </tr>
                        </thead>
                        <tbody class="text-gray-700 text-sm font-light">
                            @can('Role access')
                                @foreach ($roles as $role)
                                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                                        <td class="py-3 px-6 text-left whitespace-nowrap">
                                            <span class="font-medium">{{ $role->name }}</span>
                                        </td>
                                        <td class="py-3 px-6 text-left">
                                            <div class="flex flex-wrap gap-2">
                                                @foreach ($role->permissions as $permission)
                                                    <span
                                                     class="inline-block bg-gray-500 text-white text-xs font-bold px-2 py-1 rounded-full">
                                                        {{-- class="inline-block bg-gradient-to-r from-indigo-400 to-pink-400 text-white text-xs font-bold px-3 py-1 rounded-full shadow"> --}}
                                                        {{ $permission->name }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        </td>
                                        <td class="py-3 px-6 text-right">
                                            @can('Role edit')
                                                <a href="{{ route('admin.roles.edit', $role->id) }}"
                                                   class="bg-yellow-500 text-white font-bold py-2 px-4 rounded-lg shadow hover:bg-yellow-600 transition duration-300 mr-2">
                                                    แก้ไข
                                                </a>
                                            @endcan

                                            @can('Role delete')
                                                <button onclick="confirmDelete({{ $role->id }})"
                                                        class="bg-red-500 text-white font-bold py-2 px-4 rounded-lg shadow hover:bg-red-600 transition duration-300">
                                                    ลบ
                                                </button>

                                                <form id="delete-form-{{ $role->id }}"
                                                      action="{{ route('admin.roles.destroy', $role->id) }}" method="POST"
                                                      style="display: none;">
                                                    @csrf
                                                    @method('delete')
                                                </form>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            @endcan
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(roleId) {
            Swal.fire({
                title: 'คุณแน่ใจหรือไม่?',
                text: "คุณจะไม่สามารถกู้คืนข้อมูลนี้ได้!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ใช่, ลบเลย!',
                cancelButtonText: 'ยกเลิก'
            }).then((result) => {
                if (result.isConfirmed) {
                    // ส่งฟอร์มลบ
                    document.getElementById(`delete-form-${roleId}`).submit();
                }
            });
        }
    </script>
</x-app-layout>
