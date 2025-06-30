<x-app-layout>
    <div class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-2xl space-y-6 mt-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4 text-center">แบบฟอร์มข้อมูลทะเบียนนำเข้าวัตถุดิบ</h2>

        <form method="POST" action="{{ route('import.store') }}" class="grid grid-cols-2 md:grid-cols-2 gap-4">
            @csrf

            {{-- บริษัท (company_id) --}}
            <div>
                <label class="block text-gray-700 mb-1">บริษัทนำเข้า</label>
                <select class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    name="company_id">
                    <option value="">-- เลือก --</option>
                    @foreach ($companies as $company)
                        <option value="{{ $company->id }}">{{ $company->full_name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- เลขที่ทะเบียน --}}
            <div>
                <label class="block text-gray-700 mb-1">เลขที่ทะเบียน</label>
                <input type="text" name="registration_no"
                    class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            {{-- วันหมดอายุ --}}
            <div>
                <label class="block text-gray-700 mb-1">วันหมดอายุ</label>
                <input type="date" name="expiry_date"
                    class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            {{-- ชื่อวัตถุอันตราย (ไทย) --}}
            <div>
                <label class="block text-gray-700 mb-1">ชื่อวัตถุอันตราย (ไทย)</label>
                <input type="text" name="chemical_name_th"
                    class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            {{-- ชื่อวัตถุอันตราย (อังกฤษ) --}}
            <div>
                <label class="block text-gray-700 mb-1">ชื่อวัตถุอันตราย (อังกฤษ)</label>
                <input type="text" name="chemical_name_en"
                    class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            {{-- % และสูตร --}}
            <div>
                <label class="block text-gray-700 mb-1">% และสูตร</label>
                <input type="text" name="formula"
                    class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            {{-- ชื่อการค้า --}}
            <div>
                <label class="block text-gray-700 mb-1">ชื่อการค้า</label>
                <input type="text" name="trade_name"
                    class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            {{-- ผู้ผลิต --}}
            <div>
                <label class="block text-gray-700 mb-1">ผู้ผลิตและแหล่งผลิต</label>
                <input type="text" name="manufacturer"
                    class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            {{-- ผู้จำหน่าย --}}
            <div>
                <label class="block text-gray-700 mb-1">ผู้จำหน่าย</label>
                <select class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    name="supplier">
                    <option value="">-- เลือก --</option>
                    @foreach ($companies as $company)
                        <option value="{{ $company->id }}">{{ $company->full_name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- ใบอนุญาต --}}
            <div>
                <label for="license_no" class="block text-gray-700 mb-1">ใบอนุญาตเลขที่</label>
                <input type="text" name="license_no" id="license_no"
                    class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            {{-- ที่จัดเก็บ (ปรับปรุงใหม่เป็น Dropdown และห้ามเลือกซ้ำ) --}}
            <div class="flex flex-col md:flex-row md:space-x-4">
                <div class="flex-1 mb-4 md:mb-0">
                    <label for="store_company_1" class="block text-gray-700 mb-1">สถานที่จัดเก็บที่ 1</label>
                    <select name="store_company_1" id="store_company_1"
                        class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">-- เลือก --</option>
                        {{-- @php
                            $companies_list = ['บริษัท A', 'บริษัท B', 'บริษัท C', 'บริษัท D', 'บริษัท E']; // ตัวอย่างข้อมูล
                        @endphp --}}
                        @foreach ($companies as $company)
                            <option value="{{ $company->full_name }}">{{ $company->full_name }}</option>
                        @endforeach
                    </select>
                    @error('store_company_1')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex-1">
                    <label for="store_company_2" class="block text-gray-700 mb-1">สถานที่จัดเก็บที่ 2</label>
                    <select name="store_company_2" id="store_company_2"
                        class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">-- เลือก --</option>
                        @foreach ($companies as $company)
                            <option value="{{ $company->full_name }}">{{ $company->full_name }}</option>
                        @endforeach
                    </select>
                    @error('store_company_2')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- ปริมาณนำเข้า --}}
            <div>
                <label for="import_quantity" class="block text-gray-700 mb-1">ปริมาณนำเข้า</label>
                <input type="number" name="import_quantity" id="import_quantity"
                    class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            {{-- ขนาดบรรจุ --}}
            <div class="md:col-span-2">
                <label class="block text-gray-700 mb-1">ขนาดบรรจุ</label>
                <textarea name="packaging" class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    rows="2"></textarea>
            </div>

            {{-- หมายเหตุ --}}
            <div class="md:col-span-2">
                <label class="block text-gray-700 mb-1">หมายเหตุ</label>
                <textarea name="remarks" class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    rows="2"></textarea>
            </div>

            {{-- ปุ่ม --}}
            <div class="text-right mt-8">
                <a href="{{ route('import.index') }}"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-lg shadow transition duration-300">
                    <i class="fa-solid fa-arrow-left mr-2"></i> ย้อนกลับ
                </a>
            </div>
            <div class="text-left mt-6">
                <button type="submit"
                    class="bg-blue-800 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md">
                    บันทึก
                </button>
            </div>
        </form>
    </div>

    {{-- Custom Message Box --}}
    <div id="customMessageBox"
        class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <h3 class="text-lg leading-6 font-medium text-gray-900" id="messageBoxTitle">แจ้งเตือน</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500" id="messageBoxContent"></p>
                </div>
                <div class="items-center px-4 py-3">
                    <button id="closeMessageBox"
                        class="px-4 py-2 bg-blue-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        ตกลง
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- SweetAlert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'บันทึกสำเร็จ!',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'ตกลง'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('import.index') }}";
                }
            });
        </script>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const companySelect = document.getElementById('store_company_1');
            const storeCompanySelect = document.getElementById('store_company_2');
            const messageBox = document.getElementById('customMessageBox');
            const messageBoxContent = document.getElementById('messageBoxContent');
            const closeMessageBox = document.getElementById('closeMessageBox');

            function showMessageBox(message) {
                messageBoxContent.textContent = message;
                messageBox.classList.remove('hidden');
            }

            function hideMessageBox() {
                messageBox.classList.add('hidden');
            }

            closeMessageBox.addEventListener('click', hideMessageBox);

            function enforceUniqueSelection(event) {
                const companyValue = companySelect.value;
                const storeCompanyValue = storeCompanySelect.value;

                if (companyValue && storeCompanyValue && companyValue === storeCompanyValue) {
                    // หากค่าซ้ำกัน ให้เคลียร์ค่าของช่องที่เลือกทีหลัง
                    if (event.target.id === 'store_company_1') {
                        storeCompanySelect.value = ''; // ถ้าเปลี่ยน company แล้วซ้ำ ให้รีเซ็ต store_company
                        showMessageBox('สถานที่จัดเก็บที่ 1 และ 2 ต้องไม่เหมือนกัน');
                    } else if (event.target.id === 'store_company_2') {
                        companySelect.value = ''; // ถ้าเปลี่ยน store_company แล้วซ้ำ ให้รีเซ็ต company
                        showMessageBox('สถานที่จัดเก็บที่ 1 และ 2 ต้องไม่เหมือนกัน');
                    }
                }
            }

            companySelect.addEventListener('change', enforceUniqueSelection);
            storeCompanySelect.addEventListener('change', enforceUniqueSelection);
        });
    </script>
</x-app-layout>
