<x-app-layout>
    <div>
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100">
            <div class="container mx-auto px-6 py-6">
                <!-- Header -->
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-4xl font-extrabold text-gray-800 tracking-wide">
                        <span class="text-gray-600">จัดการผู้ใช้งาน</span>
                    </h1>
                    @can('User create')
                        <a href="{{ route('admin.users.create') }}"
                            class="bg-blue-500 text-white font-bold px-5 py-2 rounded-lg shadow hover:bg-blue-600 transition duration-300">
                            + สร้างผู้ใช้งาน
                        </a>
                    @endcan
                </div>

                <!-- Table -->
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <table class="min-w-full bg-white">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">ชื่อผู้ใช้งาน</th>
                                <th class="py-3 px-6 text-left">สิทธิ์</th>
                                <th class="py-3 px-6 text-right">การดำเนินการ</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700 text-sm font-light">
                            @can('User access')
                                @foreach ($users as $user)
                                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                                        <td class="py-3 px-6 text-left whitespace-nowrap">
                                            <span class="font-medium">{{ $user->name }}</span>
                                        </td>
                                        <td class="py-3 px-6 text-left">
                                            @foreach ($user->roles as $role)
                                                <span
                                                    class="inline-block bg-gray-500 text-white text-xs font-bold px-2 py-1 rounded-full">
                                                    {{ $role->name }}
                                                </span>
                                            @endforeach
                                        </td>
                                        <td class="py-3 px-6 text-right">
                                            @can('User edit')
                                                <a href="{{ route('admin.users.edit', $user->id) }}"
                                                    class="bg-yellow-500 text-white font-bold py-2 px-4 rounded-lg shadow hover:bg-yellow-600 transition duration-300 mr-2">
                                                    แก้ไข
                                                </a>
                                            @endcan

                                            @can('User delete')
                                                <button onclick="confirmDelete({{ $user->id }})"
                                                    class="bg-red-500 text-white font-bold py-2 px-4 rounded-lg shadow hover:bg-red-600 transition duration-300">
                                                    ลบ
                                                </button>

                                                <form id="delete-form-{{ $user->id }}"
                                                    action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
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
                   <div class="px-6 py-4 bg-white border-t border-gray-200">
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
</x-app-layout>


<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(userId) {
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
                document.getElementById(`delete-form-${userId}`).submit();
            }
        });
    }
</script>
