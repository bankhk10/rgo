<x-app-layout>
    <div>
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100">
            <div class="container mx-auto px-6 py-6">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-4xl font-extrabold text-gray-800 tracking-wide">
                        <span class="text-gray-600">จัดการโพสต์</span>
                    </h1>
                    @can('Post create')
                        <a href="{{ route('admin.posts.create') }}"
                           class="bg-blue-500 text-white font-bold px-5 py-2 rounded-lg shadow hover:bg-blue-600 transition duration-300">
                            + สร้างโพสต์ใหม่
                        </a>
                    @endcan
                </div>

                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <table class="min-w-full bg-white">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">หัวข้อ</th>
                                <th class="py-3 px-6 text-left">สถานะ</th>
                                <th class="py-3 px-6 text-right">การดำเนินการ</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700 text-sm font-light">
                            @can('Post access')
                                @foreach ($posts as $post)
                                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                                        <td class="py-3 px-6 text-left whitespace-normal">
                                            <span class="font-medium">{{ $post->title }}</span>
                                        </td>
                                        <td class="py-3 px-6 text-left">
                                            @if ($post->publish)
                                                <span
                                                      class="inline-block bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-full">Publish</span>
                                            @else
                                                <span
                                                      class="inline-block bg-gray-500 text-white text-xs font-bold px-2 py-1 rounded-full">Draft</span>
                                            @endif
                                        </td>
                                        <td class="py-3 px-6 text-right">
                                            <div class="flex justify-end space-x-2">
                                                @can('Post edit')
                                                    <a href="{{ route('admin.posts.edit', $post->id) }}"
                                                       class="bg-yellow-500 text-white font-bold py-2 px-4 rounded-lg shadow hover:bg-yellow-600 transition duration-300">
                                                        แก้ไข
                                                    </a>
                                                @endcan

                                                @can('Post delete')
                                                    <button onclick="confirmDelete({{ $post->id }})"
                                                            class="bg-red-500 text-white font-bold py-2 px-4 rounded-lg shadow hover:bg-red-600 transition duration-300">
                                                        ลบ
                                                    </button>

                                                    <form id="delete-form-{{ $post->id }}"
                                                          action="{{ route('admin.posts.destroy', $post->id) }}"
                                                          method="POST"
                                                          style="display: none;">
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

                @can('Post access')
                    <div class="mt-6">
                        {{ $posts->links() }}
                    </div>
                @endcan
            </div>
        </main>
    </div>
</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(postId) {
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
                document.getElementById(`delete-form-${postId}`).submit();
            }
        });
    }
</script>
