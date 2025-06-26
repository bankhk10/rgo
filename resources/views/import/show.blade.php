<x-app-layout>
    <div class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-2xl space-y-6 mt-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4 text-center">ดูข้อมูลทะเบียนนำเข้า</h2>
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
                <input type="date0" class="w-full p-2 border rounded-lg bg-gray-200"
                    value="{{ $import->expiry_date }}" disabled>
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
                    <label for="store_company_1" class="block text-gray-700 mb-1">บริษัทจัดเก็บ 1</label>
                    <input type="text0" class="w-full p-2 border rounded-lg bg-gray-200"
                        value="{{ $import->storeCompany1->full_name ?? '-' }}" disabled>
                </div>
                <div class="flex-1">
                    <label for="store_company_2" class="block text-gray-700 mb-1">บริษัทจัดเก็บ 2</label>
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
                <label class="block text-gray-700 mb-1">ขนาดบรรจุ</label>
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
</x-app-layout>
