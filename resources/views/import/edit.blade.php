<x-app-layout>
    <div class="max-w-5xl mx-auto p-6 bg-white shadow-lg rounded-2xl space-y-6 mt-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4 text-center">แก้ไขข้อมูลทะเบียนนำเข้า</h2>

        <form method="POST" action="{{ route('import.update', $import->id) }}"
            class="grid grid-cols-2 md:grid-cols-2 gap-4">
            @csrf
            @method('PUT')

            {{-- บริษัทนำเข้า (company_id) --}}
            <div>
                <label class="block text-gray-700 mb-1">บริษัทนำเข้า</label>
                <select class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    name="company_id">
                    <option value="">-- เลือก --</option>
                    @foreach ($companies as $company)
                        <option value="{{ $company->id }}" {{ $import->company_id == $company->id ? 'selected' : '' }}>
                            {{ $company->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- เลขที่ทะเบียน --}}
            <div>
                <label class="block text-gray-700 mb-1">เลขที่ทะเบียน</label>
                <input type="text" name="registration_no"
                    value="{{ old('registration_no', $import->registration_no) }}"
                    class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            {{-- วันหมดอายุ --}}
            <div>
                <label class="block text-gray-700 mb-1">วันหมดอายุ</label>
                <input type="date" name="expiry_date"
                    {{-- value="{{ old('expiry_date', optional($import->expiry_date)->format('Y-m-d')) }}" --}}
                    value="{{ old('expiry_date', $import->expiry_date) }}"
                    class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            {{-- ชื่อวัตถุอันตราย (ไทย) --}}
            <div>
                <label class="block text-gray-700 mb-1">ชื่อวัตถุอันตราย (ไทย)</label>
                <input type="text" name="chemical_name_th"
                    value="{{ old('chemical_name_th', $import->chemical_name_th) }}"
                    class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            {{-- ชื่อวัตถุอันตราย (อังกฤษ) --}}
            <div>
                <label class="block text-gray-700 mb-1">ชื่อวัตถุอันตราย (อังกฤษ)</label>
                <input type="text" name="chemical_name_en"
                    value="{{ old('chemical_name_en', $import->chemical_name_en) }}"
                    class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            {{-- % และสูตร --}}
            <div>
                <label class="block text-gray-700 mb-1">% และสูตร</label>
                <input type="text" name="formula" value="{{ old('formula', $import->formula) }}"
                    class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            {{-- ชื่อการค้า --}}
            <div>
                <label class="block text-gray-700 mb-1">ชื่อการค้า</label>
                <input type="text" name="trade_name" value="{{ old('trade_name', $import->trade_name) }}"
                    class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            {{-- ผู้ผลิต --}}
            <div>
                <label class="block text-gray-700 mb-1">ผู้ผลิตและแหล่งผลิต</label>
                <input type="text" name="manufacturer" value="{{ old('manufacturer', $import->manufacturer) }}"
                    class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            {{-- ผู้จำหน่าย --}}
            <div>
                <label class="block text-gray-700 mb-1">ผู้จำหน่าย</label>
                <select class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    name="supplier">
                    <option value="">-- เลือก --</option>
                    @foreach ($companies as $company)
                        <option value="{{ $company->id }}" {{ $import->supplier == $company->id ? 'selected' : '' }}>
                            {{ $company->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- ใบอนุญาต --}}
            <div>
                <label for="license_no" class="block text-gray-700 mb-1">ใบอนุญาตเลขที่</label>
                <input type="text" name="license_no" id="license_no"
                    value="{{ old('license_no', $import->license_no) }}"
                    class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            {{-- ที่จัดเก็บ (Dropdowns และห้ามเลือกซ้ำ) --}}
            <div class="flex flex-col md:flex-row md:space-x-4">
                <div class="flex-1 mb-4 md:mb-0">
                    <label for="store_company_1" class="block text-gray-700 mb-1">บริษัทจัดเก็บ 1</label>
                    <select name="store_company_1" id="store_company_1"
                        class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">-- เลือก --</option>
                        {{-- ตัวอย่างข้อมูลสำหรับ dropdowns; ในการใช้งานจริงควรดึงมาจากฐานข้อมูล --}}
                        @php
                            $companies_list = ['บริษัท A', 'บริษัท B', 'บริษัท C', 'บริษัท D', 'บริษัท E'];
                        @endphp
                        @foreach ($companies_list as $comp)
                            <option value="{{ $comp }}" {{ old('store_company_1', $import->store_company_1) == $comp ? 'selected' : '' }}>
                                {{ $comp }}
                            </option>
                        @endforeach
                    </select>
                    @error('store_company_1')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex-1">
                    <label for="store_company_2" class="block text-gray-700 mb-1">บริษัทจัดเก็บ 2</label>
                    <select name="store_company_2" id="store_company_2"
                        class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">-- เลือก --</option>
                        @foreach ($companies_list as $comp)
                            <option value="{{ $comp }}" {{ old('store_company_2', $import->store_company_2) == $comp ? 'selected' : '' }}>
                                {{ $comp }}
                            </option>
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
                <input type="number" step="0.01" name="import_quantity" id="import_quantity"
                    value="{{ old('import_quantity', $import->import_quantity) }}"
                    class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            {{-- ปริมาณคงเหลือ --}}
            {{-- <div>
                <label class="block text-gray-700 mb-1">ปริมาณคงเหลือ</label>
                <input type="text" name="remaining_quantity"
                    value="{{ old('remaining_quantity', $import->remaining_quantity) }}"
                    class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div> --}}

            {{-- วันหมดอายุ (สำรอง) --}}
            {{-- <div>
                <label class="block text-gray-700 mb-1">วันหมดอายุ (สำรอง)</label>
                <input type="date" name="second_expiry_date"
                    value="{{ old('second_expiry_date', optional($import->second_expiry_date)->format('Y-m-d')) }}"
                    class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div> --}}

            {{-- ใบแจ้งครอบครอง วอ.2 --}}
            {{-- <div>
                <label class="block text-gray-700 mb-1">ใบแจ้งครอบครอง วอ.2</label>
                <input type="text" name="possession_form_wo2"
                    value="{{ old('possession_form_wo2', $import->possession_form_wo2) }}"
                    class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div> --}}

            {{-- วันหมดอายุใบแจ้งครอบครอง วอ.2 --}}
            {{-- <div>
                <label class="block text-gray-700 mb-1">วันหมดอายุใบแจ้งครอบครอง วอ.2</label>
                <input type="date" name="possession_form_expiry"
                    value="{{ old('possession_form_expiry', optional($import->possession_form_expiry)->format('Y-m-d')) }}"
                    class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div> --}}

            {{-- ขนาดบรรจุ --}}
            <div class="md:col-span-2">
                <label class="block text-gray-700 mb-1">ขนาดบรรจุ</label>
                <textarea name="packaging" class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    rows="2">{{ old('packaging', $import->packaging) }}</textarea>
            </div>

            {{-- หมายเหตุ --}}
            <div class="md:col-span-2">
                <label class="block text-gray-700 mb-1">หมายเหตุ</label>
                <textarea name="remarks" class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    rows="2">{{ old('remarks', $import->remarks) }}</textarea>
            </div>

            {{-- ปุ่ม --}}
            <div class="col-span-2 flex justify-between mt-6">
                <a href="{{ route('import.index') }}"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-lg shadow transition duration-300">
                    <i class="fa-solid fa-arrow-left mr-2"></i> ย้อนกลับ
                </a>

                <button type="submit"
                    class="bg-blue-800 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md">
                    บันทึก
                </button>
            </div>
        </form>
    </div>

    {{-- Custom Message Box --}}
    <div id="customMessageBox" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <h3 class="text-lg leading-6 font-medium text-gray-900" id="messageBoxTitle">ข้อผิดพลาด</h3>
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
            const storeCompany1Select = document.getElementById('store_company_1');
            const storeCompany2Select = document.getElementById('store_company_2');
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
                const value1 = storeCompany1Select.value;
                const value2 = storeCompany2Select.value;

                if (value1 && value2 && value1 === value2) {
                    // หากค่าซ้ำกัน ให้เคลียร์ค่าของช่องที่เลือกทีหลัง
                    if (event.target.id === 'store_company_1') {
                        storeCompany2Select.value = ''; // ถ้าเปลี่ยน store_company_1 แล้วซ้ำ ให้รีเซ็ต store_company_2
                        showMessageBox('ชื่อบริษัทจัดเก็บ 1 และ 2 ต้องไม่เหมือนกัน');
                    } else if (event.target.id === 'store_company_2') {
                        storeCompany1Select.value = ''; // ถ้าเปลี่ยน store_company_2 แล้วซ้ำ ให้รีเซ็ต store_company_1
                        showMessageBox('ชื่อบริษัทจัดเก็บ 1 และ 2 ต้องไม่เหมือนกัน');
                    }
                }
            }

            storeCompany1Select.addEventListener('change', enforceUniqueSelection);
            storeCompany2Select.addEventListener('change', enforceUniqueSelection);
        });
    </script>
</x-app-layout>
