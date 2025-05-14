@php
    $expiredCount = 2;
    $nearExpiryCount = 3;
    $activeCount = 5;

    $nearExpiryDrugs = collect([
        (object)[
            'name' => 'ยาเม็ดวิตามินรวม',
            'registration_number' => '123456',
            'expiry_date' => \Carbon\Carbon::now()->addDays(10),
        ],
        (object)[
            'name' => 'น้ำมันตับปลาชนิดแคปซูล',
            'registration_number' => '654321',
            'expiry_date' => \Carbon\Carbon::now()->addDays(20),
        ],
        (object)[
            'name' => 'ยาแก้ปวดพาราเซตามอล',
            'registration_number' => '987654',
            'expiry_date' => \Carbon\Carbon::now()->addDays(5),
        ],
    ]);
@endphp


<x-app-layout>
    <div>
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
            <div class="container mx-auto px-6 py-8">

                <h1 class="text-4xl font-bold text-center text-indigo-600 mt-8 mb-8">
                    รายงานทะเบียนยา
                </h1>

                {{-- สรุปสถานะทะเบียน --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-white p-6 rounded-lg shadow text-center">
                        <h2 class="text-xl font-semibold text-gray-700 mb-2">ทะเบียนหมดอายุ</h2>
                        <p class="text-3xl text-red-600 font-bold">{{ $expiredCount }}</p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow text-center">
                        <h2 class="text-xl font-semibold text-gray-700 mb-2">ทะเบียนใกล้หมดอายุ</h2>
                        <p class="text-3xl text-yellow-600 font-bold">{{ $nearExpiryCount }}</p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow text-center">
                        <h2 class="text-xl font-semibold text-gray-700 mb-2">ทะเบียนใช้งานอยู่</h2>
                        <p class="text-3xl text-green-600 font-bold">{{ $activeCount }}</p>
                    </div>
                </div>

                {{-- รายการทะเบียนใกล้หมดอายุ --}}
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <h2 class="text-2xl font-semibold text-gray-700 bg-indigo-100 px-6 py-4">ทะเบียนใกล้หมดอายุ</h2>
                    <table class="min-w-full bg-white">
                        <thead>
                            <tr class="bg-indigo-600 text-white text-left">
                                <th class="py-3 px-6">ลำดับ</th>
                                <th class="py-3 px-6">ชื่อสามัญ</th>
                                <th class="py-3 px-6">เลขที่ทะเบียน</th>
                                <th class="py-3 px-6">วันหมดอายุ</th>
                                <th class="py-3 px-6">สถานะ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($nearExpiryDrugs as $index => $drug)
                                <tr class="border-b hover:bg-gray-100">
                                    <td class="py-3 px-6">{{ $index + 1 }}</td>
                                    <td class="py-3 px-6">{{ $drug->name }}</td>
                                    <td class="py-3 px-6">{{ $drug->registration_number }}</td>
                                    <td class="py-3 px-6">{{ $drug->expiry_date->format('d/m/Y') }}</td>
                                    <td class="py-3 px-6">
                                        <span class="bg-yellow-200 text-yellow-800 py-1 px-3 rounded-full text-xs">ใกล้หมดอายุ</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-4 px-6 text-center text-gray-500">ไม่มีทะเบียนใกล้หมดอายุ</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </main>
    </div>
</x-app-layout>
