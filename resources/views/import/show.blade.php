<x-app-layout>
    <div class="max-w-5xl mx-auto p-6 bg-white shadow-lg rounded-2xl space-y-6 mt-6">
        <h1 class="text-4xl font-extrabold text-center text-indigo-700 mt-5 mb-10 tracking-wide">
            <span class="inline-flex items-center gap-2">
                <svg class="w-10 h-10 text-indigo-400" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 8c-1.657 0-3 1.343-3 3v1c0 1.657 1.343 3 3 3s3-1.343 3-3v-1c0-1.657-1.343-3-3-3z" />
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 2v2m0 16v2m8-10h2M2 12H4m15.364-7.364l1.414 1.414M4.222 19.778l1.414-1.414m12.728 0l1.414 1.414M4.222 4.222l1.414 1.414" />
                </svg>
                รายละเอียดข้อมูลทะเบียนนำเข้าวัตถุดิบ
            </span>
        </h1>

        <form class="grid grid-cols-2 md:grid-cols-2 gap-4">
            {{-- บริษัท --}}
            <div>
                <label class="block text-gray-700 mb-1">บริษัทนำเข้า</label>
                <input type="text0" class="w-full p-2 border rounded-lg bg-gray-200"
                    value="{{ $import->company->full_name ?? '-' }}" disabled>
            </div>

            {{-- เลขที่ทะเบียน --}}
            <div>
                <label class="block text-gray-700 mb-1">เลขที่ทะเบียน</label>
                <input type="text0" class="w-full p-2 border rounded-lg bg-gray-200"
                    value="{{ $import->registration_no }}" disabled>
            </div>

            {{-- วันหมดอายุ --}}
            <div>
                <label class="block text-gray-700 mb-1">วันหมดอายุ</label>
                <input type="date" class="w-full p-2 border rounded-lg bg-gray-200"
                    value="{{ \Carbon\Carbon::parse($import->expiry_date)->addYears(543)->format('Y-m-d') }}" disabled>
            </div>

            {{-- ชื่อวัตถุอันตราย (ไทย) --}}
            <div>
                <label class="block text-gray-700 mb-1">ชื่อวัตถุอันตราย (ไทย)</label>
                <input type="text0" class="w-full p-2 border rounded-lg bg-gray-200"
                    value="{{ $import->chemical_name_th }}" disabled>
            </div>

            {{-- ชื่อวัตถุอันตราย (อังกฤษ) --}}
            <div>
                <label class="block text-gray-700 mb-1">ชื่อวัตถุอันตราย (อังกฤษ)</label>
                <input type="text0" class="w-full p-2 border rounded-lg bg-gray-200"
                    value="{{ $import->chemical_name_en }}" disabled>
            </div>

            {{-- สูตรและ % --}}
            <div>
                <label class="block text-gray-700 mb-1">% และสูตร</label>
                <input type="text0" class="w-full p-2 border rounded-lg bg-gray-200" value="{{ $import->formula }}"
                    disabled>
            </div>

            {{-- ชื่อการค้า --}}
            <div>
                <label class="block text-gray-700 mb-1">ชื่อการค้า</label>
                <input type="text0" class="w-full p-2 border rounded-lg bg-gray-200" value="{{ $import->trade_name }}"
                    disabled>
            </div>

            {{-- ผู้ผลิต --}}
            <div>
                <label class="block text-gray-700 mb-1">ผู้ผลิต</label>
                <input type="text0" class="w-full p-2 border rounded-lg bg-gray-200"
                    value="{{ $import->manufacturer }}" disabled>
            </div>

            {{-- ผู้จำหน่าย --}}
            <div>
                <label class="block text-gray-700 mb-1">ผู้จำหน่าย</label>
                <input type="text0" class="w-full p-2 border rounded-lg bg-gray-200"
                    value="{{ $import->company->full_name }}" disabled>
            </div>

            {{-- ใบอนุญาต --}}
            <div>
                <label class="block text-gray-700 mb-1">ใบอนุญาตเลขที่</label>
                <input type="text0" class="w-full p-2 border rounded-lg bg-gray-200" value="{{ $import->license_no }}"
                    disabled>
            </div>

            <div class="flex flex-col md:flex-row md:space-x-4">
                <div class="flex-1 mb-4 md:mb-0">
                    <label for="store_company_1" class="block text-gray-700 mb-1">สถานที่จัดเก็บที่ 1</label>
                    <input type="text0" class="w-full p-2 border rounded-lg bg-gray-200"
                        value="{{ $import->storeCompany1->full_name ?? '-' }}" disabled>
                </div>
                <div class="flex-1">
                    <label for="store_company_2" class="block text-gray-700 mb-1">สถานที่จัดเก็บที่ 2</label>
                    <input type="text0" class="w-full p-2 border rounded-lg bg-gray-200"
                        value="{{ $import->storeCompany2->full_name ?? '-' }}" disabled>
                </div>
            </div>

            {{-- ปริมาณนำเข้า --}}
            <div>
                <label class="block text-gray-700 mb-1">ปริมาณนำเข้า</label>
                <input type="number0" class="w-full p-2 border rounded-lg bg-gray-200"
                    value="{{ $import->import_quantity }}" disabled>
            </div>


            <div class="md:col-span-2">
                <label class="block text-gray-700 mb-1">รายละเอียดขนาดบรรจุ</label>
                <textarea class="w-full p-2 border rounded-lg bg-gray-200" rows="2" disabled>{{ $import->packaging }}</textarea>
            </div>

            {{-- หมายเหตุ --}}
            <div class="md:col-span-2">
                <label class="block text-gray-700 mb-1">หมายเหตุ</label>
                <textarea class="w-full p-2 border rounded-lg bg-gray-200" rows="1" disabled>{{ $import->remarks }}</textarea>
            </div>
        </form>

        <div class="text-center mt-8">
            <a href="{{ route('import.index') }}"
                class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-lg shadow transition duration-300">
                <i class="fa-solid fa-arrow-left mr-2"></i> ย้อนกลับ
            </a>
        </div>
    </div>
    <script>
        document.getElementById('menu-inregister')?.classList.add('side-menu--active');
    </script>
</x-app-layout>
