<x-app-layout>
    <div>
        <main class="content flex-1 overflow-x-hidden overflow-y-auto">
            <div class="container mx-auto px-6 py-6">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-4xl font-extrabold text-gray-800 tracking-wide">
                        <span class="text-gray-600">จัดการสิทธิ์การใช้งาน</span>
                    </h1>
                    @can('Role create')
                        <a href="{{ route('admin.roles.create') }}"
                            class="bg-blue-500 text-white font-bold px-5 py-2 rounded-lg shadow hover:bg-blue-600 transition duration-300">
                            + สร้างสิทธิ์การใช้งาน
                        </a>
                    @endcan
                </div>

                <div class="bg-white rounded-2xl overflow-hidden border border-gray-200">
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead>
                                <tr class="bg-indigo-600 text-white text-left">
                                    {{-- <th class="py-4 px-8 rounded-tl-2xl">ลำดับ</th> --}}
                                    <th class="py-3 px-6 text-left w-1/6 min-w-[180px]">ชื่อสิทธิ์การใช้งาน</th>
                                    <th class="py-3 px-6 text-left">สิทธิ์</th>
                                    <th class="py-3 px-6 text-right w-1/6 min-w-[180px]">การดำเนินการ</th>
                                    {{-- <th class="py-3 px-6 text-right">การดำเนินการ</th> --}}
                                </tr>
                            </thead>
                            <tbody class="text-gray-700 text-sm font-light">
                                @can('Role read')
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
                                                'no' => 'ไม่มีสิทธิ์ดำเนินการ',
                                            ];

                                            $parts = explode(' ', $roleName);
                                            $position = $positions[$parts[0]] ?? $parts[0];
                                            $department = $departments[$parts[1] ?? ''] ?? ($parts[1] ?? '');

                                            return trim("$position $department");
                                        }
                                    @endphp

                                    @foreach ($roles as $index => $role)
                                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                                            {{-- <td class="py-4 px-8 font-semibold text-gray-700">{{ $index + 1 }}</td> --}}
                                            <td class="py-3 px-6 text-left whitespace-nowrap">
                                                <span class="font-medium">{{ translateRoleName($role->name) }}</span>
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
                                                @can('Role update')
                                                    <a href="{{ route('admin.roles.edit', $role->id) }}"
                                                        class="inline-flex items-center justify-center p-2 rounded-full text-white bg-yellow-500 hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200"
                                                        title="แก้ไข">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="w-6 h-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                        </svg>
                                                    </a>
                                                @endcan

                                                @can('Role delete')
                                                    <button onclick="confirmDelete({{ $role->id }})"
                                                        class="inline-flex items-center justify-center p-2 rounded-full text-white bg-red-500 hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all duration-200"
                                                        title="ลบ">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="w-6 h-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.92a2.25 2.25 0 0 1-2.244-2.077L4.74 5.959m1.049-.165c.51-.158 1.029-.28 1.563-.35L12 4.75m-4.78 2.152A.75.75 0 0 1 9 6.75h6m-3 0V4.5m-2.25 4.5h.008v.008H9.75V9Zm0 0H9.75Zm4.5 0h.008v.008H14.25V9Z" />
                                                        </svg>
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
