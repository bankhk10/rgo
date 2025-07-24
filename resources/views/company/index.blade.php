<x-app-layout>
    <div>
        <main class="flex-1 overflow-x-hidden overflow-y-auto">
            <div class="mx-auto px-6 py-6">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-4xl font-extrabold text-gray-600 tracking-wide">
                        จัดการบริษัท
                    </h1>
                    @can('Company create')
                        <a href="{{ route('company.create') }}"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300">
                            + เพิ่มบริษัท
                        </a>
                    @endcan
                </div>

                <div class="bg-white rounded-2xl overflow-hidden border border-gray-200">
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead>
                                <tr class="bg-indigo-600 text-white text-left">
                                    <th class="py-3 px-4 rounded-tl-2xl">id</th>
                                    <th class="py-3 px-6">ชื่อบริษัท</th>
                                    <th class="py-3 px-6">ตัวย่อ</th>
                                    <th class="py-3 px-6">ที่อยู่</th>
                                    <th class="py-3 px-6">อีเมล</th>
                                    <th class="py-3 px-6">เบอร์โทร</th>
                                    <th class="py-3 px-6">เลขประจำตัวผู้เสียภาษี</th>
                                    <th class="py-3 px-6 rounded-tr-2xl text-right">การดำเนินการ</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-700 text-sm font-light">
                                @can('Company read')
                                    @foreach ($companies as $company)
                                        <tr class="border-b hover:bg-indigo-50 transition">
                                            <td class="py-4 px-6">{{ $company->id }}</td>
                                            <td class="py-4 px-6">{{ $company->full_name }}</td>
                                            <td class="py-4 px-6">{{ $company->name }}</td>
                                            <td class="py-4 px-6">{{ $company->address }}</td>
                                            <td class="py-4 px-6">{{ $company->email }}</td>
                                            <td class="py-4 px-6">{{ $company->phone }}</td>
                                            <td class="py-4 px-6">{{ $company->tax_id }}</td>
                                            <td class="py-4 px-6 text-right">
                                                <div class="flex items-center justify-end gap-2">
                                                    @can('Company update')
                                                        <a href="{{ route('company.edit', $company->id) }}"
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

                                                    @can('Company delete')
                                                        <button onclick="confirmDelete({{ $company->id }})"
                                                            class="inline-flex items-center justify-center p-2 rounded-full text-white bg-red-500 hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all duration-200"
                                                            title="ลบ">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                                class="w-6 h-6">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.92a2.25 2.25 0 0 1-2.244-2.077L4.74 5.959m1.049-.165c.51-.158 1.029-.28 1.563-.35L12 4.75m-4.78 2.152A.75.75 0 0 1 9 6.75h6m-3 0V4.5m-2.25 4.5h.008v.008H9.75V9Zm0 0H9.75Zm4.5 0h.008v.008H14.25V9Z" />
                                                            </svg>
                                                        </button>
                                                        <form id="delete-form-{{ $company->id }}"
                                                            action="{{ route('company.destroy', $company->id) }}"
                                                            method="POST" style="display: none;">
                                                            @csrf
                                                            @method('DELETE')
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
                        @if ($companies->hasPages())
                            <div class="text-center">
                                <nav class="inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                                    @if ($companies->onFirstPage())
                                        <span
                                            class="px-3 py-2 text-sm text-gray-400 bg-white border border-gray-300 rounded-l-md cursor-not-allowed">&laquo;</span>
                                    @else
                                        <a href="{{ $companies->previousPageUrl() }}"
                                            class="px-3 py-2 text-sm text-gray-700 bg-white border border-gray-300 hover:bg-gray-50 rounded-l-md">&laquo;</a>
                                    @endif

                                    @foreach ($companies->getUrlRange(1, $companies->lastPage()) as $page => $url)
                                        @if ($page == $companies->currentPage())
                                            <span
                                                class="px-4 py-2 text-sm font-semibold text-white bg-indigo-600 border border-indigo-600">{{ $page }}</span>
                                        @else
                                            <a href="{{ $url }}"
                                                class="px-4 py-2 text-sm text-gray-700 bg-white border border-gray-300 hover:bg-gray-50">{{ $page }}</a>
                                        @endif
                                    @endforeach

                                    @if ($companies->hasMorePages())
                                        <a href="{{ $companies->nextPageUrl() }}"
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
        function confirmDelete(companyId) {
            Swal.fire({
                title: 'คุณแน่ใจหรือไม่?',
                text: "คุณจะไม่สามารถกู้คืนข้อมูลนี้ได้",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ตกลง',
                cancelButtonText: 'ยกเลิก'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete-form-${companyId}`).submit();
                }
            });
        }
    </script>
</x-app-layout>
