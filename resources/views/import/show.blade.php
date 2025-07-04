<x-app-layout>
    <div class="max-w-5xl mx-auto p-8 bg-white shadow-lg rounded-2xl space-y-10 mt-6">
        <h2 class="text-4xl font-extrabold text-gray-700 mb-8 pb-4 text-center border-b border-gray-300">
            รายละเอียดข้อมูลทะเบียนนำเข้าวัตถุดิบ
        </h2>

        {{-- Form is kept for structure, but inputs are disabled --}}
        <form class="space-y-10">
            {{-- General Import Information Section --}}
            <div>
                <h3
                    class="text-2xl font-semibold text-white bg-gradient-to-r from-blue-400 to-indigo-400 px-4 py-3 rounded-t-md">
                    ข้อมูลการนำเข้าทั่วไป
                </h3>
                <div class="grid grid-cols-2 md:grid-cols-2 gap-6 mt-4">
                    {{-- บริษัท (company_id) --}}
                    <div>
                        <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">บริษัทนำเข้า</label>
                        <div class="dropdown" id="companyDropdown">
                            {{-- Display selected company name or default --}}
                            <div style="height: 50px;"
                                class="text-gray-700 dropdown-btn disabled-field bg-gray-100 cursor-not-allowed"
                                id="companyBtn">
                                {{ $import->company->full_name ?? '-- ไม่มีข้อมูล --' }}
                            </div>
                            {{-- Hidden input is still here for data, but dropdown is disabled via JS --}}
                            <input type="hidden" name="company_id" id="companyInput" value="{{ $import->company_id }}">
                        </div>
                    </div>

                    {{-- เลขที่ทะเบียน --}}
                    <div>
                        <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">เลขที่ทะเบียน</label>
                        <input type="text" name="registration_no" value="{{ $import->registration_no ?? '-' }}"
                            placeholder="ไม่มีข้อมูล" disabled
                            class="w-full p-3 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 disabled-field bg-gray-100 text-gray-700" />
                    </div>

                    {{-- ชื่อการค้า --}}
                    <div>
                        <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">ชื่อการค้า</label>
                        <input type="text" name="trade_name" value="{{ $import->trade_name ?? '-' }}"
                            placeholder="ไม่มีข้อมูล" disabled
                            class="w-full p-3 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 disabled-field bg-gray-100 text-gray-700" />
                    </div>
                    {{-- วันหมดอายุ --}}
                    <div>
                        <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">วันหมดอายุ</label>
                        <input type="text" name="expiry_date"
                            value="{{ $import->expiry_date ? \Carbon\Carbon::parse($import->expiry_date)->format('d/m/Y') : '-' }}"
                            placeholder="ไม่มีข้อมูล" disabled
                            class="w-full p-3 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 disabled-field bg-gray-100 text-gray-700" />
                        {{-- ใช้ type="text" เพื่อแสดงวันที่แบบ formatted ไม่ใช่ input date picker --}}
                    </div>

                    {{-- ชื่อวัตถุอันตราย (ไทย) --}}
                    <div>
                        <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">ชื่อวัตถุอันตราย (ไทย)</label>
                        <input type="text" name="chemical_name_th" value="{{ $import->chemical_name_th ?? '-' }}"
                            placeholder="ไม่มีข้อมูล" disabled
                            class="w-full p-3 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 disabled-field bg-gray-100 text-gray-700" />
                    </div>

                    {{-- ชื่อวัตถุอันตราย (อังกฤษ) --}}
                    <div>
                        <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">ชื่อวัตถุอันตราย (อังกฤษ)</label>
                        <input type="text" name="chemical_name_en" value="{{ $import->chemical_name_en ?? '-' }}"
                            placeholder="ไม่มีข้อมูล" disabled
                            class="w-full p-3 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 disabled-field bg-gray-100 text-gray-700" />
                    </div>

                    {{-- % และสูตร --}}
                    <div>
                        <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">% และสูตร</label>
                        <input type="text" name="formula" value="{{ $import->formula ?? '-' }}"
                            placeholder="ไม่มีข้อมูล" disabled
                            class="w-full p-3 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 disabled-field bg-gray-100 text-gray-700" />
                    </div>


                    {{-- ผู้ผลิต --}}
                    <div>
                        <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">ผู้ผลิตและแหล่งผลิต</label>
                        <input type="text" name="manufacturer" value="{{ $import->manufacturer ?? '-' }}"
                            placeholder="ไม่มีข้อมูล" disabled
                            class="w-full p-3 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 disabled-field bg-gray-100 text-gray-700" />
                    </div>

                    {{-- ผู้จำหน่าย --}}
                    <div>
                        <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">ผู้จำหน่าย</label>
                        <div class="dropdown" id="supplierDropdown">
                            {{-- Display selected supplier name or default --}}
                            <div style="height: 50px;"
                                class="text-gray-700 dropdown-btn disabled-field bg-gray-100 cursor-not-allowed"
                                id="supplierBtn">
                                {{ $import->supplierCompany->full_name ?? '-- ไม่มีข้อมูล --' }}
                            </div>
                            {{-- Hidden input is still here for data, but dropdown is disabled via JS --}}
                            <input type="hidden" name="supplier" id="supplierInput" value="{{ $import->supplier }}">
                        </div>
                    </div>

                    {{-- ใบอนุญาต --}}
                    <div>
                        <label for="license_no"
                            class="mx-3 text-base block text-gray-700 mb-1 mt-3">ใบอนุญาตเลขที่</label>
                        <input type="text" name="license_no" id="license_no"
                            value="{{ $import->license_no ?? '-' }}" placeholder="ไม่มีข้อมูล" disabled
                            class="w-full p-3 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 disabled-field bg-gray-100 text-gray-700" />
                    </div>
                </div>
            </div>

            {{-- Storage Information Section --}}
            <div>
                <h3
                    class="text-2xl font-semibold text-white bg-gradient-to-r from-blue-400 to-indigo-400 px-4 py-3 rounded-t-md">
                    ข้อมูลการจัดเก็บ
                </h3>
                <div class="grid grid-cols-3 md:grid-cols-4 gap-6 mt-4">
                    {{-- ปริมาณนำเข้า --}}
                    <div>
                        <label for="import_quantity"
                            class="mx-3 text-base block text-gray-700 mb-1 mt-3">ปริมาณนำเข้า</label>
                        <input type="text" name="import_quantity" id="import_quantity"
                            value="{{ $import->import_quantity ?? '-' }}" placeholder="ไม่มีข้อมูล" disabled
                            class="w-full p-3 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 disabled-field bg-gray-100 text-gray-700" />
                        {{-- เปลี่ยนเป็น type="text" เพื่อแสดงค่าเฉยๆ ไม่ใช่ input number ที่มีลูกศร --}}
                    </div>

                    {{-- ที่จัดเก็บ 1 --}}
                    <div>
                        <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">สถานที่จัดเก็บที่ 1</label>
                        <div class="dropdown" id="storeCompany1Dropdown">
                            <div style="height: 50px;"
                                class="text-gray-700 dropdown-btn disabled-field bg-gray-100 cursor-not-allowed"
                                id="storeCompany1Btn">
                                {{ $import->storeCompany1->full_name ?? '-- ไม่มีข้อมูล --' }}
                            </div>
                            <input type="hidden" name="store_company_1" id="storeCompany1Input"
                                value="{{ $import->store_company_1 }}">
                        </div>
                    </div>

                    {{-- ที่จัดเก็บ 2 --}}
                    <div>
                        <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">สถานที่จัดเก็บที่ 2</label>
                        <div class="dropdown" id="storeCompany2Dropdown">
                            <div style="height: 50px;"
                                class="text-gray-700 dropdown-btn disabled-field bg-gray-100 cursor-not-allowed"
                                id="storeCompany2Btn">
                                {{ $import->storeCompany2->full_name ?? '-- ไม่มีข้อมูล --' }}
                            </div>
                            <input type="hidden" name="store_company_2" id="storeCompany2Input"
                                value="{{ $import->store_company_2 }}">
                        </div>
                    </div>


                    {{-- รายละเอียดขนาดบรรจุ --}}
                    <div class="md:col-span-3">
                        <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">รายละเอียดขนาดบรรจุ</label>
                        <textarea name="packaging" placeholder="ไม่มีข้อมูล" disabled
                            class="w-full p-3 border rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-500 disabled-field bg-gray-100 text-gray-700"
                            rows="2">{{ $import->packaging ?? '-' }}</textarea>
                    </div>

                    {{-- หมายเหตุ --}}
                    <div class="md:col-span-3">
                        <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">หมายเหตุ</label>
                        <textarea name="remarks" placeholder="ไม่มีข้อมูล" disabled
                            class="w-full p-3 border rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-500 disabled-field bg-gray-100 text-gray-700"
                            rows="2">{{ $import->remarks ?? '-' }}</textarea>
                    </div>
                </div>
            </div>
            {{-- Buttons --}}
            <div class="flex justify-center gap-4 pt-4">
                <a href="{{ route('import.index') }}"
                    class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-6 rounded-lg shadow-md flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H16a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                            clip-rule="evenodd" />
                    </svg>
                    กลับ
                </a>
            </div>
        </form>
    </div>

    {{-- SweetAlert is not needed for a read-only page, but keeping for completeness if you reuse parts --}}
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
        document.getElementById('menu-inregister')?.classList.add('side-menu--active');

        document.addEventListener('DOMContentLoaded', () => {
            // Function to setup dropdowns for read-only mode
            function setupReadonlyDropdown(btnId) {
                const btn = document.getElementById(btnId);
                if (btn) {
                    // Prevent clicking and opening the dropdown list
                    btn.addEventListener('click', (e) => {
                        e.preventDefault();
                        e.stopPropagation();
                    });
                    // Ensure it has the disabled appearance
                    btn.classList.add('disabled-field', 'bg-gray-100', 'cursor-not-allowed', 'text-gray-700');
                    // Remove the dropdown arrow (pseudo-element)
                    btn.style.setProperty('--tw-content', 'none'); // Tailwind way to remove ::after content
                }
                // Hide the dropdown list as it's not interactive
                const list = document.getElementById(btnId.replace('Btn', 'List'));
                if (list) {
                    list.style.display = 'none';
                }
            }

            // Setup all dropdowns as read-only
            setupReadonlyDropdown('companyBtn');
            setupReadonlyDropdown('supplierBtn');
            setupReadonlyDropdown('storeCompany1Btn');
            setupReadonlyDropdown('storeCompany2Btn');
        });
    </script>

    <style>
        /* Shared Dropdown Styles */
        * {
            box-sizing: border-box;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #374151;
            font-size: 16px;
        }

        .dropdown {
            position: relative;
        }

        .dropdown-btn {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #edeff3;
            border-radius: 9999px;
            background-color: #fff;
            cursor: pointer;
            font-size: 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .dropdown-btn:after {
            content: "▾";
            font-size: 26px;
            color: #7f838a;
            margin-left: 8px;
        }

        /* Override for disabled dropdown buttons */
        .dropdown-btn.disabled-field:after {
            content: none !important;
            /* Remove the arrow for disabled dropdowns */
        }

        .dropdown-list {
            position: absolute;
            top: 105%;
            left: 0;
            width: 100%;
            background-color: #fff;
            border: 1px solid #edeff3;
            border-radius: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 10;
            display: none;
            max-height: 230px;
            overflow-y: auto;
        }

        .dropdown-list::-webkit-scrollbar {
            width: 6px;
        }

        .dropdown-list::-webkit-scrollbar-thumb {
            background-color: #cbd5e1;
            border-radius: 3px;
        }

        .dropdown-list::-webkit-scrollbar-track {
            background-color: #f1f5f9;
        }

        .dropdown-list.open {
            display: block;
        }

        .dropdown-item {
            padding: 12px 16px;
            cursor: pointer;
            border-radius: 20px;
        }

        .dropdown-item:last-child {
            border-bottom: none;
        }

        .dropdown-item:hover {
            background-color: #e0f2fe;
        }

        /* New styles for disabled fields */
        .disabled-field {
            background-color: #f3f4f6;
            /* Lighter gray background */
            color: #4b5563;
            /* Darker gray text color */
            cursor: not-allowed;
        }

        input[disabled],
        textarea[disabled] {
            opacity: 0.9;
            /* Slightly reduce opacity to indicate disabled state */
        }
    </style>
</x-app-layout>
