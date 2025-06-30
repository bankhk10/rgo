@php
    $expiredCount = 2;
    $nearExpiryDrugs = collect([
        (object) [
            'name' => 'ยาเม็ดวิตามินรวม',
            'registration_number' => '123456',
            'expiry_date' => \Carbon\Carbon::now()->addDays(10),
        ],
        (object) [
            'name' => 'น้ำมันตับปลาชนิดแคปซูล',
            'registration_number' => '654321',
            'expiry_date' => \Carbon\Carbon::now()->addDays(20),
        ],
        (object) [
            'name' => 'ยาแก้ปวดพาราเซตามอล',
            'registration_number' => '987654',
            'expiry_date' => \Carbon\Carbon::now()->addDays(5),
        ],
        (object) [
            'name' => 'ยาเม็ดวิตามินรวม',
            'registration_number' => '123456',
            'expiry_date' => \Carbon\Carbon::now()->addDays(10),
        ],
        (object) [
            'name' => 'น้ำมันตับปลาชนิดแคปซูล',
            'registration_number' => '654321',
            'expiry_date' => \Carbon\Carbon::now()->addDays(20),
        ],
        (object) [
            'name' => 'ยาแก้ปวดพาราเซตามอล',
            'registration_number' => '987654',
            'expiry_date' => \Carbon\Carbon::now()->addDays(5),
        ],
        (object) [
            'name' => 'ยาเม็ดวิตามินรวม',
            'registration_number' => '123456',
            'expiry_date' => \Carbon\Carbon::now()->addDays(10),
        ],
        (object) [
            'name' => 'น้ำมันตับปลาชนิดแคปซูล',
            'registration_number' => '654321',
            'expiry_date' => \Carbon\Carbon::now()->addDays(20),
        ],
        (object) [
            'name' => 'ยาแก้ปวดพาราเซตามอล',
            'registration_number' => '987654',
            'expiry_date' => \Carbon\Carbon::now()->addDays(5),
        ],
        (object) [
            'name' => 'ยาเม็ดวิตามินรวม',
            'registration_number' => '123456',
            'expiry_date' => \Carbon\Carbon::now()->addDays(10),
        ],
        (object) [
            'name' => 'น้ำมันตับปลาชนิดแคปซูล',
            'registration_number' => '654321',
            'expiry_date' => \Carbon\Carbon::now()->addDays(20),
        ],
        (object) [
            'name' => 'ยาแก้ปวดพาราเซตามอล',
            'registration_number' => '987654',
            'expiry_date' => \Carbon\Carbon::now()->addDays(5),
        ],
    ]);
    $nearExpiryCount = $nearExpiryDrugs->count();
    $activeCount = 5;

    // Manually paginate the collection
    $perPage = 5;
    $currentPage = request()->get('page', 1);
    $paginatedNearExpiryDrugs = new \Illuminate\Pagination\LengthAwarePaginator(
        $nearExpiryDrugs->forPage($currentPage, $perPage),
        $nearExpiryDrugs->count(),
        $perPage,
        $currentPage,
        ['path' => request()->url()],
    );
@endphp

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
                    Dashboard
                </span>
            </h1>

            {{-- สรุปสถานะทะเบียน --}}
            <div class="flex flex-row justify-around mb-10">
                <div
                    class="group h-full bg-gradient-to-br from-red-100 to-red-50 p-4 rounded-3xl text-center border-2 border-red-200 hover:scale-105 transition-all duration-300">
                    <div class="flex justify-center mb-2">
                        <div class="bg-red-200 rounded-full p-3 group-hover:bg-red-300 transition">
                            <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3" />
                                <circle cx="12" cy="12" r="10" />
                            </svg>
                        </div>
                    </div>
                    <h2 class="text-lg font-bold text-red-700 mb-1 tracking-wide">ทะเบียนสินค้าหมดอายุ</h2>
                    <p class="text-4xl text-red-600 font-extrabold mb-1">{{ $expiredCount }}</p>
                </div>

                <div
                    class="group h-full bg-gradient-to-br from-yellow-100 to-yellow-50 p-4 rounded-3xl text-center border-2 border-yellow-200 hover:scale-105 transition-all duration-300">
                    <div class="flex justify-center mb-2">
                        <div class="bg-yellow-200 rounded-full p-3 group-hover:bg-yellow-300 transition">
                            <svg class="w-8 h-8 text-yellow-500" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3" />
                                <circle cx="12" cy="12" r="10" />
                            </svg>
                        </div>
                    </div>
                    <h2 class="text-lg font-bold text-yellow-700 mb-1 tracking-wide">ทะเบียนสินค้าใกล้หมดอายุ</h2>
                    <p class="text-4xl text-yellow-600 font-extrabold mb-1">{{ $nearExpiryCount }}</p>
                </div>

                <div
                    class="group h-full bg-gradient-to-br from-red-100 to-red-50 p-4 rounded-3xl text-center border-2 border-red-200 hover:scale-105 transition-all duration-300">
                    <div class="flex justify-center mb-2">
                        <div class="bg-red-200 rounded-full p-3 group-hover:bg-red-300 transition">
                            <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3" />
                                <circle cx="12" cy="12" r="10" />
                            </svg>
                        </div>
                    </div>
                    <h2 class="text-lg font-bold text-red-700 mb-1 tracking-wide">ทะเบียนผลิตหมดอายุ</h2>
                    <p class="text-4xl text-red-600 font-extrabold mb-1">{{ $expiredCount }}</p>
                </div>

                <div
                    class="group h-full bg-gradient-to-br from-yellow-100 to-yellow-50 p-4 rounded-3xl text-center border-2 border-yellow-200 hover:scale-105 transition-all duration-300">
                    <div class="flex justify-center mb-2">
                        <div class="bg-yellow-200 rounded-full p-3 group-hover:bg-yellow-300 transition">
                            <svg class="w-8 h-8 text-yellow-500" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3" />
                                <circle cx="12" cy="12" r="10" />
                            </svg>
                        </div>
                    </div>
                    <h2 class="text-lg font-bold text-yellow-700 mb-1 tracking-wide">ทะเบียนผลิตใกล้หมดอายุ</h2>
                    <p class="text-4xl text-yellow-600 font-extrabold mb-1">{{ $nearExpiryCount }}</p>
                </div>
            </div>

            {{-- รายการทะเบียนใกล้หมดอายุ --}}
            <div class="bg-white rounded-2xl overflow-hidden border border-gray-200">
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white">
                        <thead>
                            <tr class="bg-indigo-600 text-white text-left">
                                <th class="py-4 px-8 rounded-tl-2xl">ลำดับ</th>
                                <th class="py-4 px-8">ชื่อสามัญ</th>
                                <th class="py-4 px-8">เลขที่ทะเบียน</th>
                                <th class="py-4 px-8">วันหมดอายุ</th>
                                <th class="py-4 px-12 rounded-tr-2xl">สถานะ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($paginatedNearExpiryDrugs as $index => $drug)
                                <tr class="border-b hover:bg-yellow-50 transition">
                                    <td class="py-4 px-8 font-semibold text-gray-700">
                                        {{ ($paginatedNearExpiryDrugs->currentPage() - 1) * $paginatedNearExpiryDrugs->perPage() + $index + 1 }}
                                    </td>
                                    <td class="py-4 px-8">{{ $drug->name }}</td>
                                    <td class="py-4 px-8">{{ $drug->registration_number }}</td>
                                    <td class="py-4 px-8">{{ $drug->expiry_date->format('d/m/Y') }}</td>
                                    <td class="py-4 px-8">
                                        <span
                                            class="bg-yellow-200 text-yellow-900 py-1 px-4 rounded-full text-xs font-bold">
                                            ใกล้หมดอายุ
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-6 px-8 text-center text-gray-400">
                                        ไม่มีทะเบียนใกล้หมดอายุ</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="px-8 py-6 bg-white border-t border-gray-100 rounded-b-2xl">
                    {{ $paginatedNearExpiryDrugs->links() }}
                </div>
            </div>

        </div>
    </main>
</x-app-layout>
