<x-app-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-tr from-purple-200 to-blue-100">
        <main class="w-full max-w-5xl bg-white rounded-3xl shadow-lg p-10 flex flex-col items-start justify-center">
            <div class="flex justify-between items-center w-full mb-8">
                <h1 class="text-2xl font-bold text-gray-700">รายการทะเบียนออนไลน์</h1>
                @can('Post create')
                    <a href="{{ route('admin.posts.create') }}"
                       class="bg-indigo-600 text-white font-bold px-6 py-2 rounded-full shadow hover:bg-indigo-700 transition-colors text-lg">
                        + เพิ่มข้อมูลใหม่
                    </a>
                @endcan
            </div>
            <hr class="mb-8 w-full max-w-3xl mx-auto">

            <div class="overflow-x-auto w-full">
                <table class="min-w-full bg-white rounded-lg shadow">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-left text-gray-700 font-semibold">#</th>
                            <th class="px-4 py-2 text-left text-gray-700 font-semibold">ชื่อสามัญ (Eng)</th>
                            <th class="px-4 py-2 text-left text-gray-700 font-semibold">ชื่อการค้า</th>
                            <th class="px-4 py-2 text-left text-gray-700 font-semibold">ผู้ยื่นขอ</th>
                            <th class="px-4 py-2 text-left text-gray-700 font-semibold">สถานะ</th>
                            <th class="px-4 py-2 text-center text-gray-700 font-semibold">การจัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($posts as $post)
                            <tr class="border-b hover:bg-blue-50 transition">
                                <td class="px-4 py-2">{{ $loop->iteration }}</td>
                                <td class="px-4 py-2">{{ $post->common_name }}</td>
                                <td class="px-4 py-2">{{ $post->trade_name }}</td>
                                <td class="px-4 py-2">{{ $post->registrant }}</td>
                                <td class="px-4 py-2">
                                    <span
                                          class="inline-block px-3 py-1 rounded-full
                                    @if ($post->status === 'completed') bg-green-200 text-green-800
                                    @elseif($post->status === 'pending') bg-yellow-200 text-yellow-800
                                    @else bg-gray-200 text-gray-800 @endif">
                                        {{ ucfirst($post->status) }}
                                    </span>
                                </td>
                                <td class="px-4 py-2 text-center">
                                    <a href="{{ route('admin.posts.show', $post->id) }}"
                                       class="text-blue-600 hover:underline font-semibold">ดู</a>
                                    <a href="{{ route('admin.posts.edit', $post->id) }}"
                                       class="ml-3 text-indigo-600 hover:underline font-semibold">แก้ไข</a>
                                    @can('Post delete')
                                        <form action="{{ route('admin.posts.destroy', $post->id) }}"
                                              method="POST"
                                              class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="ml-3 text-red-600 hover:underline font-semibold"
                                                    onclick="return confirm('ยืนยันการลบข้อมูลนี้?')">ลบ</button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6"
                                    class="px-4 py-8 text-center text-gray-500">ไม่พบข้อมูล</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</x-app-layout>
