<x-app-layout>
    <div>
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100">
            <div class="container mx-auto px-6 py-6">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-4xl font-extrabold text-gray-600 tracking-wide">
                        จัดการผู้ใช้งาน
                        {{-- <span class="inline-flex items-center gap-2">
                            <svg class="w-10 h-10 text-indigo-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </span> --}}
                    </h1>
                    @can('User create')
                        <a href="{{ route('admin.users.create') }}"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300">
                            + สร้างผู้ใช้งาน
                        </a>
                    @endcan
                </div>

                <div class="bg-white rounded-2xl overflow-hidden border border-gray-200">
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead>
                                <tr class="bg-indigo-600 text-white text-left">
                                    <th class="py-4 px-6 rounded-tl-2xl">ชื่อผู้ใช้งาน</th>
                                    {{-- <th class="py-3 px-6">ชื่อผู้ใช้งาน</th> --}}
                                    <th class="py-3 px-6">อีเมล์เข้าสู่ระบบ</th>
                                    <th class="py-3 px-6">สิทธิ์</th>
                                    <th class="py-3 px-6 rounded-tr-2xl text-right">การดำเนินการ</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-700 text-sm font-light">
                                @can('User read')
                                    @php
                                        function translateRoleName($roleName)
                                        {
                                            $positions = [
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
                                    @endphp
                                    @foreach ($users as $user)
                                        <tr class="border-b hover:bg-indigo-50 transition">
                                            <td class="py-4 px-6 whitespace-nowrap">
                                                <span class="font-semibold">{{ $user->name }}</span>
                                            </td>
                                              <td class="py-4 px-6 whitespace-nowrap">
                                                <span class="font-semibold">{{ $user->email }}</span>
                                            </td>
                                            <td class="py-4 px-6">
                                                <div class="flex flex-wrap gap-2">
                                                    @foreach ($user->roles as $role)
                                                        <span
                                                            class="inline-block bg-gray-500 text-white text-xs font-bold px-2 py-1 rounded-full">
                                                            {{ translateRoleName($role->name) }}
                                                        </span>
                                                    @endforeach
                                                </div>
                                            </td>
                                            <td class="py-4 px-6 text-right">
                                                <div class="flex items-center justify-end gap-2">
                                                    @can('User update')
                                                        <a href="{{ route('admin.users.edit', $user->id) }}"
                                                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-green-500 rounded-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition duration-150 ease-in-out">
                                                            แก้ไข
                                                        </a>
                                                    @endcan

                                                    @can('User delete')
                                                        <button onclick="confirmDelete({{ $user->id }})"
                                                            class="bg-red-500 text-white font-bold py-2 px-4 rounded-lg shadow hover:bg-red-600 transition duration-300">
                                                            ลบ
                                                        </button>

                                                        <form id="delete-form-{{ $user->id }}"
                                                            action="{{ route('admin.users.destroy', $user->id) }}"
                                                            method="POST" style="display: none;">
                                                            @csrf
                                                            @method('delete')
                                                        </form>
                                                    @endcan
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endcan
                            </tbody>
                        </table>
                    </div>
                    <div class="px-6 py-4 bg-white border-t border-gray-100 rounded-b-2xl">
                        @if ($users->hasPages())
                            <div class="text-center">
                                <nav class="inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                                    {{-- Previous Page Link --}}
                                    @if ($users->onFirstPage())
                                        <span
                                            class="px-3 py-2 text-sm text-gray-400 bg-white border border-gray-300 rounded-l-md cursor-not-allowed">&laquo;</span>
                                    @else
                                        <a href="{{ $users->previousPageUrl() }}"
                                            class="px-3 py-2 text-sm text-gray-700 bg-white border border-gray-300 hover:bg-gray-50 rounded-l-md">&laquo;</a>
                                    @endif

                                    {{-- Page Numbers --}}
                                    @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                                        @if ($page == $users->currentPage())
                                            <span
                                                class="px-4 py-2 text-sm font-semibold text-white bg-indigo-600 border border-indigo-600">{{ $page }}</span>
                                        @else
                                            <a href="{{ $url }}"
                                                class="px-4 py-2 text-sm text-gray-700 bg-white border border-gray-300 hover:bg-gray-50">{{ $page }}</a>
                                        @endif
                                    @endforeach

                                    {{-- Next Page Link --}}
                                    @if ($users->hasMorePages())
                                        <a href="{{ $users->nextPageUrl() }}"
                                            class="px-3 py-2 text-sm text-gray-700 bg-white border border-gray-300 hover:bg-gray-50 rounded-r-md">&raquo;</a>
                                    @else
                                        <span
                                            class="px-3 py-2 text-sm text-gray-400 bg-white border border-gray-300 rounded-r-md cursor-not-allowed">&raquo;</span>
                                    @endif
                                </nav>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(roleId) {
            Swal.fire({
                title: 'คุณแน่ใจหรือไม่',
                text: "คุณจะไม่สามารถกู้คืนข้อมูลนี้ได้!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ตกลง',
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
