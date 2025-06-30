<x-app-layout>
    <main class="flex-1 overflow-x-hidden overflow-y-auto">
        <div class="container mx-auto px-6 py-6">
            <h1 class="text-4xl font-extrabold text-center text-indigo-700 mt-5 mb-10 tracking-wide">
                <span class="inline-flex items-center gap-2">
                    <svg class="w-10 h-10 text-indigo-400" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 8c-1.657 0-3 1.343-3 3v1c0 1.657 1.343 3 3 3s3-1.343 3-3v-1c0-1.657-1.343-3-3-3z" />
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 2v2m0 16v2m8-10h2M2 12H4m15.364-7.364l1.414 1.414M4.222 19.778l1.414-1.414m12.728 0l1.414 1.414M4.222 4.222l1.414 1.414" />
                    </svg>
                    ข้อมูลทะเบียนนำเข้าวัตถุดิบ
                </span>
            </h1>
            @can('Inregister create')
                <div class="flex flex-col sm:flex-row justify-between items-center mx-3 mb-2">
                    <form action="{{ route('import.index') }}" method="GET" class="flex items-center gap-2 mb-4">
                        <div class="relative w-72">
                            <!-- ไอคอนแว่น -->
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                                </svg>


                            </div>
                            <!-- ช่องค้นหา -->
                            <input type="text" name="search" placeholder="ชื่อวัตถุอันตราย หรือเลขที่ทะเบียน..."
                                value="{{ request('search') }}"
                                class="pl-10 pr-4 py-2 w-full rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500" />
                        </div>

                        <!-- ปุ่มค้นหา -->
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white px-5 py-2 rounded-lg transition">
                            ค้นหา
                        </button>
                    </form>
                    <a href="{{ route('import.create') }}"
                        class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300 shadow-md">
                        + เพิ่มข้อมูลทะเบียน
                    </a>
                </div>
            @endcan
            <div class="bg-white rounded-2xl overflow-hidden border border-gray-200">
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white">
                        <thead>
                            <tr class="bg-indigo-600 text-white text-left">
                                <th class="py-4 px-8 rounded-tl-2xl">ลำดับ</th>
                                <th class="py-4 px-6">ชื่อวัตถุอันตราย (ไทย)</th>
                                {{-- <th class="py-4 px-6">ชื่อวัตถุอันตราย (อังกฤษ)</th> --}}
                                <th class="py-4 px-6 text-center">บริษัท</th>
                                <th class="py-4 px-8">เลขที่ทะเบียน</th>
                                <th class="py-4 px-8">วันหมดอายุ</th>
                                <th class="py-4 px-8 rounded-tr-2xl text-center">การดำเนินการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @can('Inregister read')
                                @forelse ($imports as $index => $import)
                                    <tr class="border-b hover:bg-indigo-50 transition">
                                        <td class="py-4 px-6 font-semibold text-gray-700">
                                            {{ $loop->iteration + ($imports->currentPage() - 1) * $imports->perPage() }}
                                        </td>
                                        <td class="py-4 px-6">{{ $import->chemical_name_th }}</td>
                                        <td class="py-4 px-6 text-center">{{ $import->company->name ?? '' }}</td>
                                        <td class="py-4 px-8">{{ $import->registration_no }}</td>
                                        <td class="py-4 px-8">
                                            {{ \Carbon\Carbon::parse($import->expiry_date)->addYears(543)->format('d/m/Y') }}
                                        </td>

                                        <td class="py-4 px-8 text-center">
                                            <div class="flex items-center gap-3 justify-center">
                                                @can('Inregister read')
                                                    <a href="{{ route('import.show', $import->id) }}"
                                                        class="inline-flex items-center justify-center p-2 rounded-full text-white bg-green-500 hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-200"
                                                        title="ดูรายละเอียด">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="w-6 h-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                        </svg>
                                                    </a>
                                                @endcan
                                                @can('Inregister update')
                                                    <a href="{{ route('import.edit', $import->id) }}"
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
                                                @can('Inregister delete')
                                                    <button onclick="confirmDelete({{ $import->id }})"
                                                        class="inline-flex items-center justify-center p-2 rounded-full text-white bg-red-500 hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all duration-200"
                                                        title="ลบ">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="w-6 h-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.92a2.25 2.25 0 0 1-2.244-2.077L4.74 5.959m1.049-.165c.51-.158 1.029-.28 1.563-.35L12 4.75m-4.78 2.152A.75.75 0 0 1 9 6.75h6m-3 0V4.5m-2.25 4.5h.008v.008H9.75V9Zm0 0H9.75Zm4.5 0h.008v.008H14.25V9Z" />
                                                        </svg>
                                                    </button>
                                                    <form id="delete-form-{{ $import->id }}"
                                                        action="{{ route('import.destroy', $import->id) }}" method="POST"
                                                        style="display: none;">
                                                        @csrf
                                                        @method('delete')
                                                    </form>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="py-6 px-8 text-center text-gray-400">
                                            ไม่มีข้อมูลทะเบียนนำเข้า</td>
                                    </tr>
                                @endforelse
                            @endcan
                        </tbody>
                    </table>
                </div>
                <div class="px-8 py-6 bg-white border-t border-gray-100 rounded-b-2xl">
                    {{ $imports->links() }}
                </div>
            </div>

        </div>
    </main>

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
