<x-app-layout>
    <div>
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100">
            <div class="container mx-auto px-6 py-6">
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
                                    <th class="py-3 px-6 rounded-tl-2xl">ชื่อบริษัท</th>
                                    <th class="py-3 px-6">ตัวย่อบริษัท</th>
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
                                                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-green-500 rounded-md hover:bg-green-600">
                                                            แก้ไข
                                                        </a>
                                                    @endcan

                                                    @can('Company delete')
                                                        <button onclick="confirmDelete({{ $company->id }})"
                                                            class="bg-red-500 text-white font-bold py-2 px-4 rounded-lg shadow hover:bg-red-600 transition duration-300">
                                                            ลบ
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
                text: "คุณจะไม่สามารถกู้คืนข้อมูลนี้ได้!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ใช่, ลบเลย!',
                cancelButtonText: 'ยกเลิก'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete-form-${companyId}`).submit();
                }
            });
        }
    </script>
</x-app-layout>
