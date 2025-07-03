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

            {{-- <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                width="50" height="30" fill="currentColor" viewBox="0 0 24 24">
                <path fill-rule="evenodd"
                    d="M7 2a2 2 0 0 0-2 2v1a1 1 0 0 0 0 2v1a1 1 0 0 0 0 2v1a1 1 0 1 0 0 2v1a1 1 0 1 0 0 2v1a1 1 0 1 0 0 2v1a2 2 0 0 0 2 2h11a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H7Zm3 8a3 3 0 1 1 6 0 3 3 0 0 1-6 0Zm-1 7a3 3 0 0 1 3-3h2a3 3 0 0 1 3 3 1 1 0 0 1-1 1h-6a1 1 0 0 1-1-1Z"
                    clip-rule="evenodd" />
            </svg> --}}


            <div class="flex flex-row justify-around mb-10">
                <div
                    class="group h-full bg-gradient-to-br from-red-100 to-red-50 p-4 rounded-3xl text-center border-2 border-red-200 hover:scale-105 transition-all duration-300">
                    <div class="flex justify-center mb-2">
                        <div class="bg-red-200 rounded-full p-3 group-hover:bg-red-300 transition">
                            {{-- <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3" />
                                <circle cx="12" cy="12" r="10" />
                            </svg> --}}
                              <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-clipboard-pen-icon lucide-clipboard-pen">
                                <rect width="8" height="4" x="8" y="2" rx="1" />
                                <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-5.5" />
                                <path d="M4 13.5V6a2 2 0 0 1 2-2h2" />
                                <path
                                    d="M13.378 15.626a1 1 0 1 0-3.004-3.004l-5.01 5.012a2 2 0 0 0-.506.854l-.837 2.87a.5.5 0 0 0 .62.62l2.87-.837a2 2 0 0 0 .854-.506z" />
                            </svg>
                        </div>
                    </div>
                    <h2 class="text-lg font-bold text-red-700 mb-1 tracking-wide">ทะเบียนสินค้าหมดอายุ</h2>
                    <p class="text-4xl text-red-600 font-extrabold mb-1">{{ $expiredCount ?? 0 }}</p>
                </div>

                     <div
                    class="group h-full bg-gradient-to-br from-red-100 to-red-50 p-4 rounded-3xl text-center border-2 border-red-200 hover:scale-105 transition-all duration-300">
                    <div class="flex justify-center mb-2">
                        <div class="bg-red-200 rounded-full p-3 group-hover:bg-red-300 transition">
                              <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-clipboard-check-icon lucide-clipboard-check">
                                <rect width="8" height="4" x="8" y="2" rx="1" ry="1" />
                                <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2" />
                                <path d="m9 14 2 2 4-4" />
                            </svg>
                            {{-- <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3" />
                                <circle cx="12" cy="12" r="10" />
                            </svg> --}}
                        </div>
                    </div>
                    <h2 class="text-lg font-bold text-red-700 mb-1 tracking-wide">ทะเบียนผลิตหมดอายุ</h2>
                    <p class="text-4xl text-red-600 font-extrabold mb-1">{{ $expiredCount ?? 0 }}</p>
                </div>


                <div
                    class="group h-full bg-gradient-to-br from-yellow-100 to-yellow-50 p-4 rounded-3xl text-center border-2 border-yellow-200 hover:scale-105 transition-all duration-300">
                    <div class="flex justify-center mb-2">
                        <div class="bg-yellow-200 rounded-full p-3 group-hover:bg-yellow-300 transition">
                            {{-- <svg class="w-8 h-8 text-yellow-500" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3" />
                                <circle cx="12" cy="12" r="10" />
                            </svg> --}}
                              <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-clipboard-pen-icon lucide-clipboard-pen">
                                <rect width="8" height="4" x="8" y="2" rx="1" />
                                <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-5.5" />
                                <path d="M4 13.5V6a2 2 0 0 1 2-2h2" />
                                <path
                                    d="M13.378 15.626a1 1 0 1 0-3.004-3.004l-5.01 5.012a2 2 0 0 0-.506.854l-.837 2.87a.5.5 0 0 0 .62.62l2.87-.837a2 2 0 0 0 .854-.506z" />
                            </svg>
                        </div>
                    </div>
                    <h2 class="text-lg font-bold text-yellow-700 mb-1 tracking-wide">ทะเบียนสินค้าใกล้หมดอายุ</h2>
                    <p class="text-4xl text-yellow-600 font-extrabold mb-1">{{ $nearExpiryCount ?? 0 }}</p>
                </div>


                <div
                    class="group h-full bg-gradient-to-br from-yellow-100 to-yellow-50 p-4 rounded-3xl text-center border-2 border-yellow-200 hover:scale-105 transition-all duration-300">
                    <div class="flex justify-center mb-2">
                        <div class="bg-yellow-200 rounded-full p-3 group-hover:bg-yellow-300 transition">
                               <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-clipboard-check-icon lucide-clipboard-check">
                                <rect width="8" height="4" x="8" y="2" rx="1" ry="1" />
                                <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2" />
                                <path d="m9 14 2 2 4-4" />
                            </svg>
                            {{-- <svg class="w-8 h-8 text-yellow-500" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3" />
                                <circle cx="12" cy="12" r="10" />
                            </svg> --}}
                        </div>
                    </div>
                    <h2 class="text-lg font-bold text-yellow-700 mb-1 tracking-wide">ทะเบียนผลิตใกล้หมดอายุ</h2>
                    <p class="text-4xl text-yellow-600 font-extrabold mb-1">{{ $nearExpiryCount ?? 0 }}</p>
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
