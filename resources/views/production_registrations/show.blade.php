<x-app-layout>
    <div class="max-w-5xl mx-auto p-8 bg-white shadow-lg rounded-2xl space-y-10 mt-6">
        <h2 class="text-4xl font-extrabold text-gray-700 mb-8 pb-4 text-center border-b border-gray-300">
            รายละเอียดข้อมูลทะเบียนผลิต
        </h2>

        {{-- Section: ข้อมูลการผลิตทั่วไป --}}
        <div>
            <h3
                class="text-2xl font-semibold text-white bg-gradient-to-r from-blue-400 to-indigo-400 px-4 py-3 rounded-t-md">
                ข้อมูลการผลิตทั่วไป
            </h3>
            <div class="grid grid-cols-2 md:grid-cols-2 gap-6 mt-4">
                <div>
                    <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">บริษัทที่ขึ้นทะเบียนผลิต</label>
                    <p class="w-full p-3 border rounded-full bg-gray-100 text-gray-700">
                        {{ $product->company->full_name ?? '-' }}
                    </p>
                </div>
                <div>
                    <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">เลขที่ทะเบียนผลิต</label>
                    <p class="w-full p-3 border rounded-full bg-gray-100 text-gray-700">
                        {{ $product->registration_number ?? '-' }}
                    </p>
                </div>
                <div>
                    <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">วันหมดอายุทะเบียน</label>
                    <p class="w-full p-3 border rounded-full bg-gray-100 text-gray-700">
                        {{ $product->expired_license_date ? \Carbon\Carbon::parse($product->expired_license_date)->format('d/m/Y') : '-' }}
                    </p>
                </div>
                <div>
                    <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">ชื่อวัตถุอันตราย (ไทย)</label>
                    <p class="w-full p-3 border rounded-full bg-gray-100 text-gray-700">
                        {{ $product->chemical_name_th ?? '-' }}
                    </p>
                </div>
                <div>
                    <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">ชื่อวัตถุอันตราย (อังกฤษ)</label>
                    <p class="w-full p-3 border rounded-full bg-gray-100 text-gray-700">
                        {{ $product->chemical_name_en ?? '-' }}
                    </p>
                </div>
                <div>
                    <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">% และสูตร</label>
                    <p class="w-full p-3 border rounded-full bg-gray-100 text-gray-700">
                        {{ $product->composition ?? '-' }}
                    </p>
                </div>
                <div>
                    <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">ผู้ผลิตและแหล่งผลิต</label>
                    <p class="w-full p-3 border rounded-full bg-gray-100 text-gray-700">
                        {{ $product->manufacturer ?? '-' }}
                    </p>
                </div>
                <div>
                    <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">ประเภททะเบียน</label>
                    <p class="w-full p-3 border rounded-full bg-gray-100 text-gray-700">
                        {{ $product->registration_type ?? '-' }}
                    </p>
                </div>
                <div>
                    <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">ชื่อผู้นำเข้า</label>
                    <p class="w-full p-3 border rounded-full bg-gray-100 text-gray-700">
                        {{ $product->importerCompany->full_name ?? '-' }}
                    </p>
                </div>
                <div>
                    <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">ชื่อผู้จำหน่าย</label>
                    <p class="w-full p-3 border rounded-full bg-gray-100 text-gray-700">
                        {{ $product->distributorCompany->full_name ?? '-' }}
                    </p>
                </div>
                <div>
                    <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">ชื่อการค้า</label>
                    <p class="w-full p-3 border rounded-full bg-gray-100 text-gray-700">
                        {{ $product->trade_name ?? '-' }}
                    </p>
                </div>
                <div>
                    <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">ชื่อการค้าที่</label>
                    <p class="w-full p-3 border rounded-full bg-gray-100 text-gray-700">
                        {{ $product->trade_name_at ?? '-' }}
                    </p>
                </div>
                <div>
                    <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">ชนิด</label>
                    <p class="w-full p-3 border rounded-full bg-gray-100 text-gray-700">
                        {{ $product->type_production_registration ?? '-' }}
                    </p>
                </div>
                <div>
                    <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">การใช้</label>
                    <p class="w-full p-3 border rounded-full bg-gray-100 text-gray-700">
                        {{ $product->usage_production_registration ?? '-' }}
                    </p>
                </div>
                <div>
                    <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">กลุ่มสาร</label>
                    <p class="w-full p-3 border rounded-full bg-gray-100 text-gray-700">
                        {{ $product->group_of_substances ?? '-' }}
                    </p>
                </div>
                <div>
                    <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">พืช</label>
                    <p class="w-full p-3 border rounded-full bg-gray-100 text-gray-700">
                        {{ $product->plant ?? '-' }}
                    </p>
                </div>
                <div>
                    <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">ศัตรูพืช</label>
                    <p class="w-full p-3 border rounded-full bg-gray-100 text-gray-700">
                        {{ $product->pests ?? '-' }}
                    </p>
                </div>
                <div>
                    <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">เลขที่ใบอนุญาตผลิต</label>
                    <p class="w-full p-3 border rounded-full bg-gray-100 text-gray-700">
                        {{ $product->production_license_number ?? '-' }}
                    </p>
                </div>
                <div>
                    <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">วันหมดอายุใบอนุญาต</label>
                    <p class="w-full p-3 border rounded-full bg-gray-100 text-gray-700">
                        {{ $product->production_license_expiry ? \Carbon\Carbon::parse($product->production_license_expiry)->format('d/m/Y') : '-' }}
                    </p>
                </div>
                <div>
                    <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">ปริมาณผลิต (ตามใบอนุญาต)</label>
                    <p class="w-full p-3 border rounded-full bg-gray-100 text-gray-700">
                        {{ $product->production_license_quantity ?? '-' }}
                    </p>
                </div>
                <div>
                    <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">ใบแจ้งครอบครอง วอ.2</label>
                    <p class="w-full p-3 border rounded-full bg-gray-100 text-gray-700">
                        {{ $product->possession_form_wo2 ?? '-' }}
                    </p>
                </div>
                <div>
                    <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">วันหมดอายุใบแจ้งครอบครอง วอ.2</label>
                    <p class="w-full p-3 border rounded-full bg-gray-100 text-gray-700">
                        {{ $product->possession_form_expiry ? \Carbon\Carbon::parse($product->possession_form_expiry)->format('d/m/Y') : '-' }}
                    </p>
                </div>
                <div>
                    <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">เลขที่ใบอนุญาตหมดอายุ</label>
                    <p class="w-full p-3 border rounded-full bg-gray-100 text-gray-700">
                        {{ $product->registration_number_pass ?? '-' }}
                    </p>
                </div>
                <div>
                    <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">หมดอายุเมื่อ</label>
                    <p class="w-full p-3 border rounded-full bg-gray-100 text-gray-700">
                        {{ $product->expired_at ? \Carbon\Carbon::parse($product->expired_at)->format('d/m/Y') : '-' }}
                    </p>
                </div>
            </div>
        </div>

        {{-- Section: ข้อมูลอื่นๆ --}}
        <div>
            <h3
                class="text-2xl font-semibold text-white bg-gradient-to-r from-blue-400 to-indigo-400 px-4 py-3 rounded-t-md">
                ข้อมูลอื่นๆ
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                <div class="md:col-span-2">
                    <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">รายละเอียดขนาดบรรจุ</label>
                    <textarea readonly name="packaging_size_details" placeholder=""
                        class="text-gray-700 bg-gray-100 w-full p-3 border rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                        rows="2">{{ old('packaging_size_details', $product->packaging_size_details) }}</textarea>
                </div>
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="flex justify-center gap-4 pt-4">
            <a href="{{ route('createproduct.index') }}"
                class="bg-gray-500 hover:bg-gray-500 text-white font-bold py-2 px-6 rounded-lg shadow-md flex items-center justify-center">
                ย้อนกลับ
            </a>
            {{-- <a href="{{ route('createproduct.edit', $product->id) }}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg shadow-md flex items-center justify-center">
                แก้ไข
            </a> --}}
        </div>
    </div>

    <script>
        document.getElementById('menu-manufacture')?.classList.add('side-menu--active');
    </script>

    {{-- Remove SweetAlert and Custom Message Box script and style if not needed for show page --}}
    {{-- You can keep them if you plan to add dynamic alerts on this page --}}
</x-app-layout>
