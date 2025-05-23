<x-app-layout>
    <a href="{{ route('import.create') }}"
       class="bg-blue-500 text-white font-bold px-5 py-2 rounded-lg shadow hover:bg-blue-600 transition duration-300">
        + สร้าง Role
    </a>
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
            ข้อมูลทะเบียนนำเข้า
        </h2>

        @if (session('success'))
            <div class="bg-green-200 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                 role="alert">
                <strong class="font-bold">{{ session('success') }}</strong>
            </div>
        @endif

        <div class="bg-white shadow-md rounded-md overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            บริษัท</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            เลขที่ทะเบียน</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            ชื่อวัตถุอันตราย (ไทย)</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            ชื่อการค้า</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            ปริมาณนำเข้า</th>
                        <th scope="col"
                            class="relative px-6 py-3">
                            <span class="sr-only">Actions</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($imports as $import)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $import->company }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $import->registration_number }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $import->hazardous_name_th }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $import->trade_name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $import->import_quantity }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="#"
                                   class="text-indigo-600 hover:text-indigo-900">แก้ไข</a>
                                <a href="#"
                                   class="text-red-600 hover:text-red-900 ml-2">ลบ</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap"
                                colspan="6">ไม่มีข้อมูลทะเบียนนำเข้า</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
