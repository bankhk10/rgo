<x-app-layout>
    <div class="max-w-7xl mx-auto p-8 bg-white shadow-lg rounded-2xl space-y-10 mt-6">
        <h2 class="text-4xl font-extrabold text-gray-700 mb-8 pb-4 text-center border-b border-gray-300">
            แก้ไขข้อมูลการขึ้นทะเบียน
        </h2>

        {{-- The form action will now point to the update route and use the PUT method --}}
        <form method="POST" action="{{ route('newregis.updateall', $registration->id) }}" class="space-y-10">
            @csrf
            @method('PUT') {{-- This tells Laravel to treat the request as a PUT/PATCH --}}

            {{-- General Information Section --}}
            <div>
                <h3
                    class="text-2xl font-semibold text-white bg-gradient-to-r from-blue-400 to-indigo-400 px-4 py-3 rounded-t-md">
                    ข้อมูลทั่วไป
                </h3>
                <div class="grid grid-cols-2 md:grid-cols-2 gap-6 mt-4">
                    <div>
                        <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">เลขที่ทะเบียน</label>
                        <input type="text" name="registration_number"
                            value="{{ $registration->registration_number ?? '-' }}" disabled
                            class="w-full p-3 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 disabled-field bg-gray-100 text-gray-700" />
                        @error('registration_number')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">วันที่หมดอายุ</label>
                        <input type="date" name="expired_license_number"
                            value="{{ $registration->expired_license_number ?? '-' }}" disabled
                            class="w-full p-3 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 disabled-field bg-gray-100 text-gray-700" />
                        @error('expired_license_number')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">ชื่อสามัญ</label>
                        {{-- This field was already disabled, ensuring consistency --}}
                        <input type="text" id="productSearch"
                            class="w-full p-3 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 disabled-field bg-gray-100 text-gray-700"
                            placeholder="ไม่มีข้อมูล" value="{{ $registration->chemical_name_th ?? '-' }}" disabled />
                        {{-- Autocomplete list and hidden inputs can remain, but they won't be interactive --}}
                        <ul id="autocomplete-list"
                            class="absolute z-10 bg-white border w-80 rounded-2xl shadow max-h-60 overflow-y-auto hidden">
                        </ul>
                        <input type="hidden" id="hazardous_name_th" name="chemical_name_th"
                            value="{{ $registration->chemical_name_th ?? '-' }}" />
                        <input type="hidden" id="formulation_ratio" name="common_name"
                            value="{{ $registration->common_name ?? '-' }}" />
                        <input type="hidden" id="chemical_imports_id" name="chemical_imports_id"
                            value="{{ $registration->chemical_imports_id ?? '-' }}" />
                    </div>

                    <div>
                        <label
                            class="mx-3 text-base block text-gray-700 mb-1 mt-3">สูตรอัตราส่วนผสมของสารสำคัญและลักษณะ</label>
                        <input type="text" name="formula_of_ratio"
                            value="{{ $registration->formula_of_ratio ?? '-' }}" disabled
                            class="w-full p-3 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 disabled-field bg-gray-100 text-gray-700" />
                        @error('formula_of_ratio')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">ผู้ขอขึ้นทะเบียน</label>
                        {{-- For dropdowns, replace the dropdown structure with a simple disabled input --}}
                        <input type="text" name="registrant_display" value="{{ $registration->registrant ?? '-' }}"
                            disabled
                            class="w-full p-3 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 disabled-field bg-gray-100 text-gray-700" />
                        <input type="hidden" name="registrant" id="registrantInput"
                            value="{{ $registration->registrant ?? '-' }}">
                        @error('registrant')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">ชนิดทะเบียน</label>
                        <input type="text" name="type_registration_display"
                            value="{{ $registration->type_registration ?? '-' }}" disabled
                            class="w-full p-3 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 disabled-field bg-gray-100 text-gray-700" />
                        <input type="hidden" name="type_registration" id="typeRegistrationInput"
                            value="{{ $registration->type_registration ?? '-' }}">
                        @error('type_registration')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">ประเภททะเบียน</label>
                        <input type="text" name="registration_type_display"
                            value="{{ $registration->registration_type ?? '-' }}" disabled
                            class="w-full p-3 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 disabled-field bg-gray-100 text-gray-700" />
                        <input type="hidden" name="registration_type" id="registrationTypeInput"
                            value="{{ $registration->registration_type ?? '-' }}">
                        @error('registration_type')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">ชื่อการค้า</label>
                        <input type="text" name="trade_name" value="{{ $registration->trade_name ?? '-' }}" disabled
                            class="w-full p-3 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 disabled-field bg-gray-100 text-gray-700" />
                        @error('trade_name')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">ชื่อการที่</label>
                        <input type="text" name="name_position_display"
                            value="{{ $registration->name_position ?? '-' }}" disabled
                            class="w-full p-3 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 disabled-field bg-gray-100 text-gray-700" />
                        <input type="hidden" name="name_position" id="namePositionInput"
                            value="{{ $registration->name_position ?? '-' }}">
                        @error('name_position')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">ชื่อผู้นำเข้า</label>
                        <input type="text" name="importer_display" value="{{ $registration->importer ?? '-' }}"
                            disabled
                            class="w-full p-3 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 disabled-field bg-gray-100 text-gray-700" />
                        <input type="hidden" name="importer" id="importerInput"
                            value="{{ $registration->importer ?? '-' }}">
                        @error('importer')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">ชื่อผู้จำหน่าย</label>
                        <input type="text" name="distributor_display"
                            value="{{ $registration->distributor ?? '-' }}" disabled
                            class="w-full p-3 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 disabled-field bg-gray-100 text-gray-700" />
                        <input type="hidden" name="distributor" id="distributorInput"
                            value="{{ $registration->distributor ?? '-' }}">
                        @error('distributor')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">ชื่อผู้ผลิตและแหล่งผลิต</label>
                        <input type="text" name="manufacturer" value="{{ $registration->manufacturer ?? '-' }}"
                            disabled
                            class="w-full p-3 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 disabled-field bg-gray-100 text-gray-700" />
                        @error('manufacturer')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">ประเภทของการใช้</label>
                        <input type="text" name="type_of_use_display"
                            value="{{ $registration->type_of_use ?? '-' }}" disabled
                            class="w-full p-3 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 disabled-field bg-gray-100 text-gray-700" />
                        <input type="hidden" name="type_of_use" id="typeOfUseInput"
                            value="{{ $registration->type_of_use ?? '-' }}">
                        @error('type_of_use')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">รายละเอียดขนาดบรรจุ</label>
                        <textarea name="packaging_size_details" disabled
                            class="w-full p-3 border rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-500 disabled-field bg-gray-100 text-gray-700"
                            rows="2">{{ $registration->packaging_size_details ?? '-' }}</textarea>
                        @error('packaging_size_details')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">วันที่ยื่นคำขอ</label>
                        <input type="date" name="date_submit_request"
                            value="{{ $registration->date_submit_request ?? '-' }}" disabled
                            class="w-full p-3 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 disabled-field bg-gray-100 text-gray-700" />
                        @error('date_submit_request')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">เลขที่รับคำขอ</label>
                        <input type="text" name="request_number_1"
                            value="{{ $registration->request_number_1 ?? '-' }}" disabled
                            class="w-full p-3 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 disabled-field bg-gray-100 text-gray-700" />
                        @error('request_number_1')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="md:col-span-2">
                        <div class="flex flex-col md:flex-row gap-6">
                            <div class="w-full md:w-1/3">
                                <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">วันที่ยื่น Phase
                                    III</label>
                                <input type="date" name="date_request_phase_3"
                                    value="{{ $registration->date_request_phase_3 ?? '-' }}" disabled
                                    class="w-full p-3 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 disabled-field bg-gray-100 text-gray-700" />
                                @error('date_request_phase_3')
                                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="w-full md:w-1/3">
                                <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">เลข # Phase III</label>
                                <input type="text" value="{{ $registration->request_number_phase_3 ?? '-' }}"
                                    disabled
                                    class="w-full p-3 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 disabled-field bg-gray-100 text-gray-700"
                                    name="request_number_phase_3" />
                                @error('request_number_phase_3')
                                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="w-full md:w-1/3">
                                <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">เลข # Phase I</label>
                                <input type="text" name="request_number_phase_1"
                                    value="{{ $registration->request_number_phase_1 ?? '-' }}" disabled
                                    class="w-full p-3 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 disabled-field bg-gray-100 text-gray-700" />
                                @error('request_number_phase_1')
                                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="md:col-span-2">
                        <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">อื่นๆ (ระบุ)</label>
                        <textarea name="remarks" disabled
                            class="w-full p-3 border rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-500 disabled-field bg-gray-100 text-gray-700"
                            rows="2">{{ $registration->remarks ?? '-' }}</textarea>
                        @error('remarks')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="flex justify-center gap-4 pt-4">
                <a href="{{ route('newregis.index') }}"
                    class="bg-gray-500 hover:bg-gray-500 text-white font-bold py-2 px-6 rounded-lg shadow-md flex items-center justify-center">
                    ยกเลิก
                </a>
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg shadow-md">
                    บันทึก
                </button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('menu-newregisall')?.classList.add('side-menu--active');

        let typingTimer;
        const delay = 300;
        const listElement = document.getElementById("autocomplete-list");

        const productSearchInput = document.getElementById("productSearch");
        const hazardousNameThInput = document.getElementById("hazardous_name_th");
        const formulationRatioInput = document.getElementById("formulation_ratio");
        const chemicalImportsId = document.getElementById("chemical_imports_id");

        function clearFields() {
            hazardousNameThInput.value = "";
            formulationRatioInput.value = "";
            chemicalImportsId.value = "";
            // Add any other fields you want to clear here
        }

        function autocompleteSearch(keyword) {
            clearTimeout(typingTimer);

            if (!keyword.trim()) {
                listElement.innerHTML = "";
                listElement.classList.add("hidden");
                clearFields();
                return;
            }

            typingTimer = setTimeout(() => {
                fetch('/api/products/search-list?name=' + encodeURIComponent(keyword))
                    .then(res => res.json())
                    .then(data => {
                        listElement.innerHTML = "";
                        listElement.classList.remove("hidden");

                        if (Array.isArray(data) && data.length > 0) {
                            data.forEach(item => {
                                const li = document.createElement("li");
                                li.className = "px-4 py-2 hover:bg-blue-100 cursor-pointer";
                                li.textContent = item.chemical_name_th;
                                li.addEventListener("click", () => {
                                    fillProductData(item);
                                    listElement.classList.add("hidden");
                                });
                                listElement.appendChild(li);
                            });
                        } else {
                            // กรณีไม่พบข้อมูล
                            const li = document.createElement("li");
                            li.className = "px-4 py-2 text-gray-500 text-center cursor-default";
                            li.textContent = "ไม่พบข้อมูล";
                            listElement.appendChild(li);
                            clearFields(); // เคลียร์ค่าเมื่อไม่พบข้อมูล
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching data:', error);
                        listElement.innerHTML =
                            '<li class="p-2 text-red-500">เกิดข้อผิดพลาดในการดึงข้อมูล</li>';
                        listElement.classList.remove("hidden");
                        clearFields();
                    });
            }, delay);
        }

        function fillProductData(product) {
            productSearchInput.value = product.chemical_name_th || "";
            hazardousNameThInput.value = product.chemical_name_th || ""; // เติมค่าใน hidden field
            formulationRatioInput.value = product.formula || "";
            chemicalImportsId.value = product.id || "";
            // ถ้ามีการนำ expiry_date กลับมาใช้ ให้ uncomment บรรทัดนี้
            // expiryDateInput.value = product.expiry_date || "";
        }

        document.addEventListener('DOMContentLoaded', () => {
            function setupDropdown(btnId, listId, inputId, oldValue = null) {
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

                // Restore old value from Laravel if available
                if (oldValue) {
                    const match = [...items].find(i => i.dataset.value == oldValue);
                    if (match) updateBtn(match.textContent, match.dataset.value);
                    else updateBtn(initial.textContent, ""); // If no match, set to default
                } else {
                    // Set initial state if no old value
                    const initial = [...items].find(item => item.dataset.value === "");
                    if (initial) updateBtn(initial.textContent, "");
                }


                btn.addEventListener('click', (event) => {
                    event.stopPropagation(); // Prevent document click from closing immediately
                    list.classList.toggle('open');
                    btn.classList.toggle('open');
                });

                items.forEach(item => {
                    item.addEventListener('click', () => {
                        updateBtn(item.textContent, item.dataset.value);
                        list.classList.remove('open');
                        btn.classList.remove('open');
                    });
                });

                document.addEventListener('click', (e) => {
                    if (!btn.closest('.dropdown').contains(e.target) && !list.contains(e.target)) {
                        list.classList.remove('open');
                        btn.classList.remove('open');
                    }
                });
            }
            setupDropdown('registrantBtn', 'registrantList', 'registrantInput',
                "{{ old('registrant', $registration->registrant) }}");
            setupDropdown('typeRegistrationBtn', 'typeRegistrationList', 'typeRegistrationInput',
                "{{ old('type_registration', $registration->type_registration) }}");
            setupDropdown('registrationTypeBtn', 'registrationTypeList', 'registrationTypeInput',
                "{{ old('registration_type', $registration->registration_type) }}");
            setupDropdown('namePositionBtn', 'namePositionList', 'namePositionInput',
                "{{ old('name_position', $registration->name_position) }}");
            setupDropdown('importerBtn', 'importerList', 'importerInput',
                "{{ old('importer', $registration->importer) }}");
            setupDropdown('distributorBtn', 'distributorList', 'distributorInput',
                "{{ old('distributor', $registration->distributor) }}");
            setupDropdown('typeOfUseBtn', 'typeOfUseList', 'typeOfUseInput',
                "{{ old('type_of_use', $registration->type_of_use) }}");
            productSearchInput.value = "{{ old('chemical_name_th', $registration->chemical_name_th) }}";
        });
    </script>
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
                    window.location.href = "{{ route('newregis.productall') }}";
                }
            })
        </script>
    @endif

    <style>
        * {
            box-sizing: border-box;
        }

        .dropdown-container {
            max-width: 300px;
            margin: auto;
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

        .autocomplete-list {
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
        }

        .autocomplete-item {
            color: #333;
            background-color: #fff;
        }
    </style>
</x-app-layout>
