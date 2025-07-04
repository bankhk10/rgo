<x-app-layout>
    <div class="max-w-5xl mx-auto p-8 bg-white shadow-lg rounded-2xl space-y-10 mt-6">
        <h2 class="text-4xl font-extrabold text-gray-700 mb-8 pb-4 text-center border-b border-gray-300">
            แก้ไขข้อมูลทะเบียนนำเข้าวัตถุดิบ
        </h2>

        {{-- Form method for update should be PUT/PATCH and action should point to update route with the record ID --}}
        <form method="POST" action="{{ route('import.update', $import->id) }}" class="space-y-10">
            @csrf
            @method('PUT') {{-- This blade directive tells Laravel to treat the request as PUT --}}

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
                            <div style="height: 50px;" class="text-gray-500 dropdown-btn" id="companyBtn">
                                {{-- Display selected company name or default --}}
                                @if (old('company_id'))
                                    {{ $companies->firstWhere('id', old('company_id'))->full_name ?? '-- เลือก --' }}
                                @else
                                    {{ $import->company->full_name ?? '-- เลือก --' }}
                                @endif
                            </div>
                            <div class="dropdown-list" id="companyList">
                                <div class="dropdown-item text-gray-500" data-value="">-- เลือก --</div>
                                @foreach ($companies as $company)
                                    <div class="dropdown-item" data-value="{{ $company->id }}">
                                        {{ $company->full_name }}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        {{-- Set initial value from $import or old input --}}
                        <input type="hidden" name="company_id" id="companyInput"
                            value="{{ old('company_id', $import->company_id) }}">
                        @error('company_id')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- เลขที่ทะเบียน --}}
                    <div>
                        <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">เลขที่ทะเบียน</label>
                        <input type="text" name="registration_no"
                            value="{{ old('registration_no', $import->registration_no) }}"
                            placeholder="ใส่เลขที่ทะเบียน"
                            class="w-full p-3 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500" />
                        @error('registration_no')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- ชื่อการค้า --}}
                    <div>
                        <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">ชื่อการค้า</label>
                        <input type="text" name="trade_name" value="{{ old('trade_name', $import->trade_name) }}"
                            placeholder="ใส่ชื่อการค้า"
                            class="w-full p-3 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500" />
                        @error('trade_name')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    {{-- วันหมดอายุ --}}
                    <div>
                        <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">วันหมดอายุ</label>
                        <input type="date" name="expiry_date" value="{{ old('expiry_date', $import->expiry_date) }}"
                            class="w-full p-3 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500" />
                        @error('expiry_date')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- ชื่อวัตถุอันตราย (ไทย) --}}
                    <div>
                        <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">ชื่อวัตถุอันตราย (ไทย)</label>
                        <input type="text" name="chemical_name_th"
                            value="{{ old('chemical_name_th', $import->chemical_name_th) }}"
                            placeholder="ใส่ชื่อวัตถุอันตราย (ไทย)"
                            class="w-full p-3 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500" />
                        @error('chemical_name_th')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- ชื่อวัตถุอันตราย (อังกฤษ) --}}
                    <div>
                        <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">ชื่อวัตถุอันตราย (อังกฤษ)</label>
                        <input type="text" name="chemical_name_en"
                            value="{{ old('chemical_name_en', $import->chemical_name_en) }}"
                            placeholder="ใส่ชื่อวัตถุอันตราย (อังกฤษ)"
                            class="w-full p-3 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500" />
                        @error('chemical_name_en')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- % และสูตร --}}
                    <div>
                        <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">% และสูตร</label>
                        <input type="text" name="formula" value="{{ old('formula', $import->formula) }}"
                            placeholder="ใส่ % และสูตร"
                            class="w-full p-3 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500" />
                        @error('formula')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>


                    {{-- ผู้ผลิต --}}
                    <div>
                        <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">ผู้ผลิตและแหล่งผลิต</label>
                        <input type="text" name="manufacturer"
                            value="{{ old('manufacturer', $import->manufacturer) }}"
                            placeholder="ใส่ผู้ผลิตและแหล่งผลิต"
                            class="w-full p-3 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500" />
                        @error('manufacturer')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- ผู้จำหน่าย --}}
                    <div>
                        <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">ผู้จำหน่าย</label>
                        <div class="dropdown" id="supplierDropdown">
                            <div style="height: 50px;" class="text-gray-500 dropdown-btn" id="supplierBtn">
                                {{-- Display selected supplier name or default --}}
                                @if (old('supplier'))
                                    {{ $companies->firstWhere('id', old('supplier'))->full_name ?? '-- เลือก --' }}
                                @else
                                    {{ $import->supplierCompany->full_name ?? '-- เลือก --' }}
                                @endif
                            </div>
                            <div class="dropdown-list" id="supplierList">
                                <div class="dropdown-item text-gray-500" data-value="">-- เลือก --</div>
                                @foreach ($companies as $company)
                                    <div class="dropdown-item" data-value="{{ $company->id }}">
                                        {{ $company->full_name }}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        {{-- Set initial value from $import or old input --}}
                        <input type="hidden" name="supplier" id="supplierInput"
                            value="{{ old('supplier', $import->supplier) }}">
                        @error('supplier')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- ใบอนุญาต --}}
                    <div>
                        <label for="license_no"
                            class="mx-3 text-base block text-gray-700 mb-1 mt-3">ใบอนุญาตเลขที่</label>
                        <input type="text" name="license_no" id="license_no"
                            value="{{ old('license_no', $import->license_no) }}" placeholder="ใส่ใบอนุญาตเลขที่"
                            class="w-full p-3 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500" />
                        @error('license_no')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
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
                        <input type="number" name="import_quantity" id="import_quantity"
                            value="{{ old('import_quantity', $import->import_quantity) }}"
                            placeholder="ใส่ปริมาณนำเข้า"
                            class="w-full p-3 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500" />
                        @error('import_quantity')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- ที่จัดเก็บ (ปรับปรุงใหม่เป็น Dropdown และห้ามเลือกซ้ำ) --}}
                    <div>
                        <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">สถานที่จัดเก็บที่ 1</label>
                        <div class="dropdown" id="storeCompany1Dropdown">
                            <div style="height: 50px;" class="text-gray-500 dropdown-btn" id="storeCompany1Btn">
                                {{-- Display selected store company 1 name or default --}}
                                @if (old('store_company_1'))
                                    {{ $companies->firstWhere('id', old('store_company_1'))->full_name ?? '-- เลือก --' }}
                                @else
                                    {{ $import->storeCompany1->full_name ?? '-- เลือก --' }}
                                @endif
                            </div>
                            <div class="dropdown-list" id="storeCompany1List">
                                <div class="dropdown-item text-gray-500" data-value="">-- เลือก --</div>
                                @foreach ($companies as $company)
                                    <div class="dropdown-item" data-value="{{ $company->id }}">
                                        {{ $company->full_name }}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        {{-- Set initial value from $import or old input --}}
                        <input type="hidden" name="store_company_1" id="storeCompany1Input"
                            value="{{ old('store_company_1', $import->store_company_1) }}">
                        @error('store_company_1')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">สถานที่จัดเก็บที่ 2</label>
                        <div class="dropdown" id="storeCompany2Dropdown">
                            <div style="height: 50px;" class="text-gray-500 dropdown-btn" id="storeCompany2Btn">
                                {{-- Display selected store company 2 name or default --}}
                                @if (old('store_company_2'))
                                    {{ $companies->firstWhere('id', old('store_company_2'))->full_name ?? '-- เลือก --' }}
                                @else
                                    {{ $import->storeCompany2->full_name ?? '-- เลือก --' }}
                                @endif
                            </div>
                            <div class="dropdown-list" id="storeCompany2List">
                                <div class="dropdown-item text-gray-500" data-value="">-- เลือก --</div>
                                @foreach ($companies as $company)
                                    <div class="dropdown-item" data-value="{{ $company->id }}">
                                        {{ $company->full_name }}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        {{-- Set initial value from $import or old input --}}
                        <input type="hidden" name="store_company_2" id="storeCompany2Input"
                            value="{{ old('store_company_2', $import->store_company_2) }}">
                        @error('store_company_2')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>


                    {{-- รายละเอียดขนาดบรรจุ --}}
                    <div class="md:col-span-3">
                        <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">รายละเอียดขนาดบรรจุ</label>
                        <textarea name="packaging" placeholder="ใส่รายละเอียดขนาดบรรจุ"
                            class="w-full p-3 border rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-500" rows="2">{{ old('packaging', $import->packaging) }}</textarea>
                        @error('packaging')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- หมายเหตุ --}}
                    <div class="md:col-span-3">
                        <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">หมายเหตุ</label>
                        <textarea name="remarks" placeholder="เพิ่มหมายเหตุ (ถ้ามี)"
                            class="w-full p-3 border rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-500" rows="2">{{ old('remarks', $import->remarks) }}</textarea>
                        @error('remarks')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            {{-- Buttons --}}
            <div class="flex justify-center gap-4 pt-4">
                <a href="{{ route('import.index') }}"
                    class="bg-gray-500 hover:bg-gray-500 text-white font-bold py-2 px-6 rounded-lg shadow-md flex items-center justify-center">
                    ยกเลิก
                </a>
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg shadow-md">
                    บันทึกการแก้ไข
                </button>
            </div>
        </form>
    </div>

    {{-- Custom Message Box (for unique selection error) --}}
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
                    // Redirect to the index page after successful update
                    window.location.href = "{{ route('import.index') }}";
                }
            });
        </script>
    @endif

    <script>
        document.getElementById('menu-inregister')?.classList.add('side-menu--active');

        document.addEventListener('DOMContentLoaded', () => {
            // Function to set up custom dropdowns
            function setupDropdown(btnId, listId, inputId, oldValue = null, isStoreCompanyDropdown = false) {
                const btn = document.getElementById(btnId);
                const list = document.getElementById(listId);
                const input = document.getElementById(inputId);
                const items = list.querySelectorAll('.dropdown-item');

                function updateBtn(label, value) {
                    btn.textContent = label;
                    if (value === "" || label.includes('--')) {
                        btn.classList.add('text-gray-500');
                    } else {
                        btn.classList.remove('text-gray-500');
                    }
                    input.value = value;
                }

                // Restore old value from Laravel if available, otherwise use initial value
                if (oldValue !== null) {
                    const match = [...items].find(i => i.dataset.value == oldValue);
                    if (match) {
                        updateBtn(match.textContent, match.dataset.value);
                    } else {
                        // If oldValue exists but no match (e.g., initial load with a valid ID),
                        // ensure the button text reflects the current selected value.
                        const currentSelection = [...items].find(i => i.dataset.value === input.value);
                        if (currentSelection) {
                            updateBtn(currentSelection.textContent, currentSelection.dataset.value);
                        } else {
                            // Fallback to default if no valid selection
                            const initial = [...items].find(item => item.dataset.value === "");
                            if (initial) updateBtn(initial.textContent, "");
                        }
                    }
                } else {
                    // Initial state for when no old value is set (shouldn't happen on edit)
                    const initial = [...items].find(item => item.dataset.value === "");
                    if (initial) updateBtn(initial.textContent, "");
                }


                btn.addEventListener('click', (e) => {
                    e.stopPropagation(); // Prevent document click from closing immediately
                    list.classList.toggle('open');
                    btn.classList.toggle('open');
                    // Close other dropdowns
                    document.querySelectorAll('.dropdown-list.open').forEach(openlist => {
                        if (openlist.id !== listId) {
                            openlist.classList.remove('open');
                            document.getElementById(openlist.id.replace('List', 'Btn')).classList
                                .remove('open');
                        }
                    });
                });

                items.forEach(item => {
                    item.addEventListener('click', (e) => {
                        e.stopPropagation();
                        const selectedValue = item.dataset.value;
                        const selectedLabel = item.textContent;

                        // Specific logic for store company dropdowns to ensure unique selection
                        if (isStoreCompanyDropdown) {
                            const storeCompany1Input = document.getElementById(
                                'storeCompany1Input');
                            const storeCompany2Input = document.getElementById(
                                'storeCompany2Input');
                            const currentInputId = inputId; // Get the ID of the current hidden input

                            let otherValue = '';
                            if (currentInputId === 'storeCompany1Input') {
                                otherValue = storeCompany2Input.value;
                            } else if (currentInputId === 'storeCompany2Input') {
                                otherValue = storeCompany1Input.value;
                            }

                            if (selectedValue && selectedValue === otherValue) {
                                showMessageBox('สถานที่จัดเก็บที่ 1 และ 2 ต้องไม่เหมือนกัน');
                                // Don't update the dropdown if values are the same
                                return;
                            }
                        }

                        updateBtn(selectedLabel, selectedValue);
                        list.classList.remove('open');
                        btn.classList.remove('open');
                    });
                });

                document.addEventListener('click', (e) => {
                    // Check if the click is outside any dropdown
                    if (!e.target.closest('.dropdown')) {
                        list.classList.remove('open');
                        btn.classList.remove('open');
                    }
                });
            }

            // Custom message box functions
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

            // Setup for all dropdowns, passing the current $import values
            setupDropdown('companyBtn', 'companyList', 'companyInput', "{{ old('company_id', $import->company_id) }}");
            setupDropdown('supplierBtn', 'supplierList', 'supplierInput', "{{ old('supplier', $import->supplier) }}");
            setupDropdown('storeCompany1Btn', 'storeCompany1List', 'storeCompany1Input',
                "{{ old('store_company_1', $import->store_company_1) }}", true);
            setupDropdown('storeCompany2Btn', 'storeCompany2List', 'storeCompany2Input',
                "{{ old('store_company_2', $import->store_company_2) }}", true);
        });
    </script>

    <style>
        /* Shared Dropdown Styles from รูปแบบที่ 1 */
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
            /* Apply border-radius to each item for consistent look */
        }

        .dropdown-item:last-child {
            border-bottom: none;
        }

        .dropdown-item:hover {
            background-color: #e0f2fe;
        }

        .hidden-input {
            display: none;
        }
    </style>
</x-app-layout>
