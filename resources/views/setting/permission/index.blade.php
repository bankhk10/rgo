<x-app-layout>
    <div>
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100">
            <div class="container mx-auto px-6 py-6">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-4xl font-extrabold text-gray-800 tracking-wide">
                        <span class="text-gray-600">จัดการ Permissions</span>
                    </h1>
                    @can('Permission create')
                        <a href="{{ route('admin.permissions.create') }}"
                           class="bg-blue-500 text-white font-bold px-5 py-2 rounded-lg shadow hover:bg-blue-600 transition duration-300">
                            + สร้าง Permission
                        </a>
                    @endcan
                </div>

                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <table class="min-w-full bg-white">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 text-sm leading-normal">
                                <th class="py-3 px-6 text-left w-1/2 min-w-[200px]">ชื่อ Permission</th>
                                <th class="py-3 px-6 text-right w-1/6 min-w-[140px]">การดำเนินการ</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700 text-sm font-light">
                            @can('Permission access')
                                @foreach($permissions as $permission)
                                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                                        <td class="py-3 px-6 text-left whitespace-nowrap">
                                            <span class="font-medium">{{ $permission->name }}</span>
                                        </td>
                                        <td class="py-3 px-6 text-right">
                                            @can('Permission edit')
                                                <a href="{{ route('admin.permissions.edit', $permission->id) }}"
                                                   class="bg-yellow-500 text-white font-bold py-2 px-4 rounded-lg shadow hover:bg-yellow-600 transition duration-300 mr-2">
                                                    แก้ไข
                                                </a>
                                            @endcan

                                            @can('Permission delete')
                                                <form action="{{ route('admin.permissions.destroy', $permission->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="bg-red-500 text-white font-bold py-2 px-4 rounded-lg shadow hover:bg-red-600 transition duration-300"
                                                            onclick="return confirm('คุณแน่ใจหรือไม่ที่จะลบ Permission นี้?')">
                                                        ลบ
                                                    </button>
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
</x-app-layout>
