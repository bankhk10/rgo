<x-app-layout>
    <div class="max-w-5xl mx-auto p-8 bg-white shadow-lg rounded-2xl space-y-10 mt-6">
        <h2 class="text-4xl font-extrabold text-gray-700 mb-8 pb-4 text-center border-b border-gray-300">
            แก้ไขข้อมูลทะเบียนผลิต
        </h2>

        {{-- The form action now points to the 'update' route and passes the import ID --}}
        <form method="POST" action="{{ route('createproduct.update', $import->id) }}" class="space-y-10">
            @csrf
            @method('PUT') {{-- Use PUT method for updating --}}

            <div>
                <h3
                    class="text-2xl font-semibold text-white bg-gradient-to-r from-blue-400 to-indigo-400 px-4 py-3 rounded-t-md">
                    ข้อมูลการนำเข้าทั่วไป
                </h3>
                <div class="grid grid-cols-2 md:grid-cols-2 gap-6 mt-4">

                    <div>
                        <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">เลขที่ทะเบียน</label>
                        <input type="text" id="registration_number" name="registration_number"
                            value="{{ old('registration_number', $import->registration_number) }}"
                            placeholder="เช่น 123-2568"
                            class="w-full p-3 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500"
                            inputmode="numeric" pattern="^\d+-\d{4}$"
                            title="รูปแบบต้องเป็น ตัวเลขใดๆ ตามด้วย - และเลขท้าย 4 หลัก เช่น 123-2568"
                            oninput="filterRegisNo(this)" required />
                        @error('registration_number')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="w-full md:w-1/3">
                        <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">วันหมดอายุ</label>
                        <input type="text" name="expired_license_date" id="expired_license_date"
                            class="date-th w-full p-3 pl-2 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500"
                            value="{{ old('expired_license_date', $import->expired_license_date ? \Carbon\Carbon::parse($import->expired_license_date)->addYears(543)->format('d/m/Y') : '') }}"
                            placeholder="วว/ดด/ปปปป">
                        @error('expired_license_date')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">บริษัทที่ขึ้นทะเบียน
                            <span class="text-red-500"> *</span>
                        </label>
                        <div class="dropdown" id="companyDropdown">
                            <div style="height: 50px;" class="text-gray-500 dropdown-btn" id="companyBtn">
                                @php
                                    $selectedCompanyId = old('company_id', $import->company_id);
                                    $companyName =
                                        $companies->firstWhere('id', $selectedCompanyId)->full_name ?? '-- เลือก --';
                                @endphp
                                {{ $companyName }}
                            </div>
                            <div class="dropdown-list" id="companyList">
                                <div class="dropdown-item text-gray-500" data-value="">-- เลือก --</div>
                                @foreach ($companies as $company)
                                    @if ($company->type == 1)
                                        <div class="dropdown-item" data-value="{{ $company->id }}">
                                            {{ $company->full_name }}
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <input type="hidden" name="company_id" id="companyInput"
                            value="{{ old('company_id', $import->company_id) }}">
                        @error('company_id')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">เปอร์เซ็นต์และสูตร</label>
                        <input type="text" name="composition" value="{{ old('composition', $import->composition) }}"
                            placeholder="ใส่เปอร์เซ็นต์และสูตร"
                            class="w-full p-3 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500" />
                        @error('composition')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

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
                    <div>
                        <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">ประเภททะเบียน</label>
                        <div class="dropdown" id="registrationTypeDropdown">
                            <div style="height: 50px;" class="text-gray-500 dropdown-btn" id="registrationTypeBtn">
                                @php
                                    $registrationTypes = ['T' => 'T', 'I' => 'I', 'R(F)' => 'R(F)'];
                                    $selectedType = old('registration_type', $import->registration_type);
                                @endphp
                                {{ $registrationTypes[$selectedType] ?? '-- เลือก --' }}
                            </div>
                            <div class="dropdown-list" id="registrationTypeList">
                                <div class="dropdown-item text-gray-500" data-value="">-- เลือกประเภททะเบียน --</div>
                                <div class="dropdown-item" data-value="T : นำเข้าสารเข้มข้น">T :
                                    นำเข้าสารเข้มข้น</div>
                                <div class="dropdown-item" data-value="I : นำเข้าสำเร็จรูป">I :
                                    นำเข้าสำเร็จรูป</div>
                                <div class="dropdown-item" data-value="F : ผลิตผสมปรุงแต่ง">F :
                                    ผลิตผสมปรุงแต่ง</div>
                                <div class="dropdown-item" data-value="R : ผลิตแบ่งบรรจุ (จากนำเข้า)">R :
                                    ผลิตแบ่งบรรจุ (จากนำเข้า)</div>
                                <div class="dropdown-item" data-value="R(F) : ผลิตแบ่งบรรจุ (จากผสมปรุงแต่ง)">R(F) :
                                    ผลิตแบ่งบรรจุ
                                    (จากผสมปรุงแต่ง)</div>
                                <div class="dropdown-item" data-value="F(E) : ผลิตเพื่อส่งออก">F(E) :
                                    ผลิตเพื่อส่งออก</div>
                            </div>
                        </div>
                        <input type="hidden" name="registration_type" id="registrationTypeInput"
                            value="{{ old('registration_type', $import->registration_type) }}">
                        @error('registration_type')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">ชื่อผู้นำเข้า</label>
                        <div class="dropdown" id="importerDropdown">
                            <div style="height: 50px;" class="text-gray-500 dropdown-btn" id="importerBtn">
                                @php
                                    $selectedImporterId = old('importer', $import->importer);
                                    $importerName =
                                        $companies->firstWhere('id', $selectedImporterId)->full_name ?? '-- เลือก --';
                                @endphp
                                {{ $importerName }}
                            </div>
                            <div class="dropdown-list" id="importerList">
                                <div class="dropdown-item text-gray-500" data-value="">-- เลือก --</div>
                                @foreach ($companies as $company)
                                    {{-- @if ($company->type == 1) --}}
                                    <div class="dropdown-item" data-value="{{ $company->id }}">
                                        {{ $company->full_name }}
                                    </div>
                                    {{-- @endif --}}
                                @endforeach
                            </div>
                        </div>
                        <input type="hidden" name="importer" id="importerInput"
                            value="{{ old('importer', $import->importer) }}">
                        @error('importer')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">ชื่อผู้จำหน่าย</label>
                        <div class="dropdown" id="distributorDropdown">
                            <div style="height: 50px;" class="text-gray-500 dropdown-btn" id="distributorBtn">
                                @php
                                    $selectedDistributorId = old('distributor', $import->distributor);
                                    $distributorName =
                                        $companies->firstWhere('id', $selectedDistributorId)->full_name ??
                                        '-- เลือก --';
                                @endphp
                                {{ $distributorName }}
                            </div>
                            <div class="dropdown-list" id="distributorList">
                                <div class="dropdown-item text-gray-500" data-value="">-- เลือก --</div>
                                @foreach ($companies as $company)
                                    <div class="dropdown-item" data-value="{{ $company->id }}">
                                        {{ $company->full_name }}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <input type="hidden" name="distributor" id="distributorInput"
                            value="{{ old('distributor', $import->distributor) }}">
                        @error('distributor')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">ชื่อการค้า</label>
                        <input type="text" name="trade_name" value="{{ old('trade_name', $import->trade_name) }}"
                            placeholder="ใส่ชื่อการค้า"
                            class="w-full p-3 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500" />
                        @error('trade_name')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">ชื่อการค้าที่ <span
                                class="text-red-500"> *</span></label>
                        <div class="dropdown" id="namePositionDropdown">
                            <div style="height: 50px;" class="text-gray-500 dropdown-btn" id="namePositionBtn">--
                                เลือกชื่อการที่ --</div>
                            <div class="dropdown-list" id="namePositionList">
                                <div class="dropdown-item text-gray-500" data-value="">-- เลือกชื่การที่
                                    --</div>
                                <div class="dropdown-item" data-value="T">T</div>
                                <div class="dropdown-item" data-value="-">-</div>
                                <div class="dropdown-item" data-value="1">1</div>
                                <div class="dropdown-item" data-value="2">2</div>
                                <div class="dropdown-item" data-value="3">3</div>
                            </div>
                        </div>
                        <input type="hidden" name="trade_name_at" id="namePositionInput"
                            value="{{ old('trade_name_at', $import->trade_name_at) }}">
                        @error('trade_name_at')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">ชนิดทะเบียน <span
                                class="text-red-500"> *</span></label>
                        <div class="dropdown" id="typeRegistrationDropdown">
                            <div style="height: 50px;" class="text-gray-500 dropdown-btn" id="typeRegistrationBtn">--
                                เลือกชนิดทะเบียน --</div>
                            <div class="dropdown-list" id="typeRegistrationList">
                                <div class="dropdown-item text-gray-500" data-value="">--
                                    เลือกชนิดทะเบียน --</div>
                                <div class="dropdown-item" data-value="ชนิดที่ 1">ชนิดที่ 1</div>
                                <div class="dropdown-item" data-value="ชนิดที่ 2">ชนิดที่ 2</div>
                                <div class="dropdown-item" data-value="ชนิดที่ 3">ชนิดที่ 3</div>
                                <div class="dropdown-item" data-value="ชนิดที่ 4">ชนิดที่ 4</div>
                            </div>
                        </div>
                        <input type="hidden" name="type_production_registration" id="typeRegistrationInput"
                            value="{{ old('type_production_registration', $import->type_production_registration) }}">
                        @error('type_production_registration')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>


                    <div>
                        <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">ประเภทของการใช้ <span
                                class="text-red-500"> *</span></label>
                        <div class="dropdown" id="typeOfUseDropdown">
                            <div style="height: 50px;" class="text-gray-500 dropdown-btn" id="typeOfUseBtn">--
                                เลือกประเภทของการใช้ --</div>
                            <div class="dropdown-list" id="typeOfUseList">
                                <div class="dropdown-item text-gray-500" data-value="">--
                                    เลือกประเภทของการใช้ --</div>
                                <div class="dropdown-item" data-value="A : Acaricide (สารกำจัดไรศัตรูพืช)">A :
                                    Acaricide (สารกำจัดไรศัตรูพืช)</div>
                                <div class="dropdown-item" data-value="F : Fungicide (สารป้องกันกำจัดโรคพืช)">F :
                                    Fungicide (สารป้องกันกำจัดโรคพืช)</div>
                                <div class="dropdown-item" data-value="H : Herbicide (สารกำจัดวัชพืช)">H :
                                    Herbicide (สารกำจัดวัชพืช)</div>
                                <div class="dropdown-item" data-value="I : Insecticide (สารกำจัดแมลง)">I :
                                    Insecticide (สารกำจัดแมลง)</div>
                                <div class="dropdown-item" data-value="M : Molluscicide (สารกำจัดหอย)">M :
                                    Molluscicide (สารกำจัดหอย)</div>
                                <div class="dropdown-item" data-value="N : Nematicide (สารกำจัดไส้เดือนฝอย)">N :
                                    Nematicide (สารกำจัดไส้เดือนฝอย)</div>
                                <div class="dropdown-item"
                                    data-value="P : PlantGrowthRegulators (สารควบคุมการเจริญเติบโตของพืช)">
                                    P :
                                    PlantGrowthRegulators (สารควบคุมการเจริญเติบโตของพืช)</div>
                                <div class="dropdown-item" data-value="R : Rodenticide (สารกำจัดหนู)">R :
                                    Rodenticide (สารกำจัดหนู)</div>
                            </div>
                        </div>
                        <input type="hidden" name="usage_production_registration" id="typeOfUseInput"
                            value="{{ old('usage_production_registration', $import->usage_production_registration) }}">
                        @error('usage_production_registration')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">กลุ่มสาร</label>
                        <input type="text" name="group_of_substances"
                            value="{{ old('group_of_substances', $import->group_of_substances) }}"
                            placeholder="ใส่กลุ่มสาร"
                            class="w-full p-3 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500" />
                        @error('group_of_substances')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">พืช</label>
                        <input type="text" name="plant" value="{{ old('plant', $import->plant) }}"
                            placeholder="ใส่พืช"
                            class="w-full p-3 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500" />
                        @error('plant')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">ศัตรูพืช</label>
                        <input type="text" name="pests" value="{{ old('pests', $import->pests) }}"
                            placeholder="ใส่ศัตรูพืช"
                            class="w-full p-3 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500" />
                        @error('pests')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="production_license_quantity"
                            class="mx-3 text-base block text-gray-700 mb-1 mt-3">ปริมาณ</label>
                        <input type="text" name="production_license_quantity" id="production_license_quantity"
                            value="{{ old('production_license_quantity', $import->production_license_quantity) }}"
                            placeholder="ใส่ปริมาณ"
                            class="w-full p-3 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500" />
                        @error('production_license_quantity')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="registration_number_pass"
                            class="mx-3 text-base block text-gray-700 mb-1 mt-3">เลขที่ใบอนุญาต</label>
                        <input type="text" name="registration_number_pass" id="registration_number_pass"
                            value="{{ old('registration_number_pass', $import->registration_number_pass) }}"
                            placeholder="ใส่เลขที่ใบอนุญาต"
                            class="w-full p-3 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500" />
                        @error('registration_number_pass')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">วันหมดอายุใบอนุญาต</label>
                        <input type="text" name="production_license_expiry" id="production_license_expiry"
                            class="date-th w-full p-3 pl-2 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500"
                            value="{{ old('production_license_expiry', $import->production_license_expiry ? \Carbon\Carbon::parse($import->production_license_expiry)->addYears(543)->format('d/m/Y') : '') }}"
                            placeholder="วว/ดด/ปปปป">
                        @error('production_license_expiry')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">ใบอนุญาตเลขที่เดิม</label>
                        <input type="text" name="production_license_number"
                            value="{{ old('production_license_number', $import->production_license_number) }}"
                            placeholder="ใส่เลขที่ใบอนุญาต"
                            class="w-full p-3 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500" />
                        @error('production_license_number')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">วันหมดอายุใบอนุญาตเดิม</label>
                        <input type="text" name="expired_at" value="{{ old('expired_at', $import->expired_at) }}"
                            placeholder="ใส่วันหมดอายุใบอนุญาตเดิม"
                            class="w-full p-3 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500" />
                        @error('expired_at')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">ใบแจ้งครอบครอง วอ.2</label>
                        <input type="text" name="possession_form_wo2"
                            value="{{ old('possession_form_wo2', $import->possession_form_wo2 ?? '') }}"
                            placeholder="ใส่ใบแจ้งครอบครอง วอ.2"
                            class="w-full p-3 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500" />
                        @error('possession_form_wo2')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">วันหมดอายุใบแจ้งครอบครอง
                            วอ.2</label>
                        <input type="text" name="possession_form_expiry" {{-- value="{{ old('possession_form_expiry', $import->possession_form_expiry ? $import->possession_form_expiry->format('Y-m-d') : '-') }}" --}}
                            value="{{ old('possession_form_expiry', $import->possession_form_expiry ?? '') }}"
                            placeholder="ใส่วันหมดอายุใบแจ้งครอบครองวอ.2"
                            class="w-full p-3 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500" />
                        @error('possession_form_expiry')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
            </div>
            <div>
                <h3
                    class="text-2xl font-semibold text-white bg-gradient-to-r from-blue-400 to-indigo-400 px-4 py-3 rounded-t-md">
                    ข้อมูลอื่นๆ
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                    <div class="md:col-span-2">
                        <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">รายละเอียดขนาดบรรจุ</label>
                        <textarea name="packaging_size_details" placeholder="ใส่รายละเอียดขนาดบรรจุ"
                            class="w-full p-3 border rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-500" rows="2">{{ old('packaging_size_details', $import->packaging_size_details) }}</textarea>
                        @error('packaging_size_details')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Hidden fields with current values --}}
                    <input type="hidden" name="new_or_old" value="{{ old('new_or_old', $import->new_or_old) }}">
                    <input type="hidden" name="step" value="{{ old('step', $import->step) }}">
                    <input type="hidden" name="status" value="{{ old('status', $import->status) }}">
                    <input type="hidden" name="is_active" value="{{ old('is_active', $import->is_active) }}">
                    <input type="hidden" name="is_deleted" value="{{ old('is_deleted', $import->is_deleted) }}">
                    <input type="hidden" name="progress" value="{{ old('progress', $import->progress) }}">
                    <input type="hidden" name="sub_progress"
                        value="{{ old('sub_progress', $import->sub_progress) }}">

                    {{-- We can keep created_by but update updated_by --}}
                    <input type="hidden" name="created_by" value="{{ $import->created_by }}">
                    <input type="hidden" name="updated_by" value="{{ auth()->user()->name ?? 'system' }}">

                </div>
            </div>
            <div class="flex justify-center gap-4 pt-4">
                {{-- Cancel button now links to the index page --}}
                <a href="{{ route('import.index') }}"
                    class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-6 rounded-lg shadow-md flex items-center justify-center">
                    ยกเลิก
                </a>
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg shadow-md">
                    บันทึกการเปลี่ยนแปลง
                </button>
            </div>
        </form>
    </div>

    {{-- Custom Message Box and Scripts remain largely the same, but JS is updated --}}
    <div id="customMessageBox"
        class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        {{-- ... content of message box ... --}}
    </div>


    <script>
        function filterRegisNo(el) {
            // แปลง en-dash/em-dash เป็น hyphen ปกติ และคงไว้เฉพาะตัวเลขกับ '-'
            let v = el.value.replace(/[–—]/g, '-').replace(/[^\d-]/g, '');

            // ให้มี '-' ได้ตัวเดียว
            const firstDash = v.indexOf('-');
            if (firstDash !== -1) {
                v = v.slice(0, firstDash + 1) + v.slice(firstDash + 1).replace(/-/g, '');
            }

            // ตัดความยาวส่วนหน้าไม่เกิน 4 และส่วนหลังไม่เกิน 4
            const parts = v.split('-');
            if (parts.length === 1) {
                // ยังไม่มี '-', จำกัดหน้าสุด 4 หลัก
                parts[0] = parts[0].slice(0, 4);
                v = parts[0];
            } else {
                parts[0] = parts[0].slice(0, 4); // 3–4 หลักจะตรวจจริงด้วย pattern/regex อีกชั้น
                parts[1] = parts[1].slice(0, 4);
                v = parts[0] + '-' + parts[1];
            }

            // จำกัดความยาวรวมไม่เกิน 9 (เช่น 1234-2568)
            el.value = v.slice(0, 9);
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/th.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            flatpickr(".date-th", {
                allowInput: true,
                locale: "th",
                dateFormat: "d/m/Y",
                parseDate: (datestr, format) => {
                    if (!datestr) return null;
                    const parts = datestr.split('/');
                    if (parts.length === 3) {
                        let [dd, mm, yyyy] = parts.map(n => parseInt(n, 10));
                        if (yyyy > 2400) yyyy -= 543; // ถ้าเป็น พ.ศ. → ค.ศ.
                        return new Date(yyyy, mm - 1, dd);
                    }
                    return flatpickr.parseDate(datestr, format);
                },
                onReady: (selectedDates, dateStr, instance) => showBE(instance),
                onChange: (selectedDates, dateStr, instance) => showBE(instance),
                onOpen: (selectedDates, dateStr, instance) => showBE(instance)
            });

            function showBE(instance) {
                const selDate = instance.selectedDates[0];
                if (!selDate) return;
                const dd = String(selDate.getDate()).padStart(2, "0");
                const mm = String(selDate.getMonth() + 1).padStart(2, "0");
                const yyyyBE = selDate.getFullYear() + 543;
                instance.input.value = `${dd}/${mm}/${yyyyBE}`;
            }

            // ก่อน submit → แปลงเป็น ค.ศ. yyyy-mm-dd
            const form = document.getElementById("editRegisForm");
            if (form) {
                form.addEventListener("submit", () => {
                    document.querySelectorAll(".date-th").forEach(input => {
                        if (input.value.match(/^\d{2}\/\d{2}\/\d{4}$/)) {
                            let [dd, mm, yyyyBE] = input.value.split("/");
                            let yyyyAD = parseInt(yyyyBE, 10);
                            if (yyyyAD > 2400) yyyyAD -= 543;
                            input.value = `${yyyyAD}-${mm}-${dd}`;
                        }
                    });
                });
            }
        });
    </script>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if ($errors->has('registration_number'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'เลขทะเบียนซ้ำ',
                text: '{{ $errors->first('registration_number') }}'
            });
        </script>
    @endif

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'อัปเดตสำเร็จ!',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'ตกลง'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('createproduct.index') }}";
                }
            });
        </script>
    @endif

    <script>
        // document.getElementById('menu-inregister')?.classList.add('side-menu--active');
        document.getElementById('menu-manufacture')?.classList.add('side-menu--active');
        document.addEventListener('DOMContentLoaded', () => {
            function setupDropdown(btnId, listId, inputId, currentValue = null) {
                const btn = document.getElementById(btnId);
                const list = document.getElementById(listId);
                const input = document.getElementById(inputId);
                const items = list.querySelectorAll('.dropdown-item');

                function updateBtn(label, value) {
                    btn.textContent = label.trim();
                    if (value === "" || label.includes('--')) {
                        btn.classList.add('text-gray-500');
                    } else {
                        btn.classList.remove('text-gray-500');
                    }
                    input.value = value;
                }

                // Set initial value from the model data or old input
                if (currentValue) {
                    const match = [...items].find(i => i.dataset.value == currentValue);
                    if (match) {
                        updateBtn(match.textContent, match.dataset.value);
                    } else if (btn.textContent.trim() === '-- เลือก --') {
                        // Fallback for cases where initial value is not in the list
                        updateBtn('-- เลือก --', '');
                    }
                } else {
                    updateBtn('-- เลือก --', '');
                }

                btn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    list.classList.toggle('open');
                    btn.classList.toggle('open');
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
                        updateBtn(item.textContent, item.dataset.value);
                        list.classList.remove('open');
                        btn.classList.remove('open');
                    });
                });

                document.addEventListener('click', (e) => {
                    if (!e.target.closest('.dropdown')) {
                        list.classList.remove('open');
                        btn.classList.remove('open');
                    }
                });
            }

            // Setup for all dropdowns, passing the current data
            setupDropdown('companyBtn', 'companyList', 'companyInput',
                "{{ old('company_id', $import->company_id) }}");
            setupDropdown('importerBtn', 'importerList', 'importerInput',
                "{{ old('importer', $import->importer) }}");
            setupDropdown('distributorBtn', 'distributorList', 'distributorInput',
                "{{ old('distributor', $import->distributor) }}");
            setupDropdown('registrationTypeBtn', 'registrationTypeList', 'registrationTypeInput',
                "{{ old('registration_type', $import->registration_type) }}");
            setupDropdown('namePositionBtn', 'namePositionList', 'namePositionInput',
                "{{ old('trade_name_at', $import->trade_name_at) }}");
            setupDropdown('typeRegistrationBtn', 'typeRegistrationList', 'typeRegistrationInput',
                "{{ old('type_production_registration', $import->type_production_registration) }}");
            setupDropdown('typeOfUseBtn', 'typeOfUseList', 'typeOfUseInput',
                "{{ old('usage_production_registration', $import->usage_production_registration) }}");
        });
    </script>

    {{-- Styles remain unchanged --}}
    <style>
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
