<x-app-layout>
    <main class="flex-1 overflow-x-hidden overflow-y-auto">
        <div class="container mx-auto px-6 py-6">
            <h1 class="text-4xl font-extrabold text-center text-indigo-700 mt-5 mb-10 tracking-wide">
                <span class="inline-flex items-center gap-2">
                    <svg class="w-10 h-10 text-indigo-400"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="2"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M12 8c-1.657 0-3 1.343-3 3v1c0 1.657 1.343 3 3 3s3-1.343 3-3v-1c0-1.657-1.343-3-3-3z" />
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M12 2v2m0 16v2m8-10h2M2 12H4m15.364-7.364l1.414 1.414M4.222 19.778l1.414-1.414m12.728 0l1.414 1.414M4.222 4.222l1.414 1.414" />
                    </svg>
                    ข้อมูลทะเบียนนำเข้า
                </span>
            </h1>

            <div class="mb-6 text-right">
                <a href="{{ route('import.create') }}"
                   class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300 shadow-md">
                    + เพิ่มข้อมูลทะเบียน
                </a>
            </div>

            <div class="bg-white rounded-2xl overflow-hidden border border-gray-200">
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white">
                        <thead>
                            <tr class="bg-indigo-600 text-white text-left">
                                <th class="py-4 px-8 rounded-tl-2xl">ลำดับ</th>
                                <th class="py-4 px-8">บริษัท</th>
                                <th class="py-4 px-8">เลขที่ทะเบียน</th>
                                <th class="py-4 px-8">ชื่อวัตถุอันตราย (ไทย)</th>
                                <th class="py-4 px-8">ชื่อการค้า</th>
                                <th class="py-4 px-8">ปริมาณนำเข้า</th>
                                <th class="py-4 px-8 rounded-tr-2xl">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($imports as $index => $import)
                                <tr class="border-b hover:bg-indigo-50 transition">
                                    <td class="py-4 px-8 font-semibold text-gray-700">{{ $index + 1 }}</td>
                                    <td class="py-4 px-8">{{ $import->company }}</td>
                                    <td class="py-4 px-8">{{ $import->registration_number }}</td>
                                    <td class="py-4 px-8">{{ $import->hazardous_name_th }}</td>
                                    <td class="py-4 px-8">{{ $import->trade_name }}</td>
                                    <td class="py-4 px-8">{{ $import->import_quantity }}</td>
                                    <td class="py-4 px-8 text-right">
                                        <ahref="#"
                                        class="text-indigo-600 hover:text-indigo-900">แก้ไข</a>
                                        <a href="#"
                                           class="text-red-600 hover:text-red-900 ml-2">ลบ</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7"
                                        class="py-6 px-8 text-center text-gray-400">ไม่มีข้อมูลทะเบียนนำเข้า</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{-- Pagination (ถ้ามี) --}}
                {{-- <div class="px-8 py-6 bg-white border-t border-gray-100 rounded-b-2xl">
                    {{ $imports->links() }}
                </div> --}}
            </div>

        </div>
    </main>
</x-app-layout>
