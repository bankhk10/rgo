<x-app-layout>
    <main class="flex-1 overflow-x-hidden overflow-y-auto">
        <div class="container mx-auto px-6 py-6">
            <h1 class="text-4xl font-extrabold text-center text-indigo-700 mt-5 mb-10 tracking-wide">
                รายละเอียดการขึ้นทะเบียนสินค้าใหม่
            </h1>

            <div class="bg-white rounded-2xl overflow-hidden shadow-lg p-8 border border-gray-200">
                {{-- รายละเอียดข้อมูลยา --}}
                <div class="grid grid-cols-3 gap-6 text-lg text-gray-700 ml-16">
                    <div>
                        <p class="font-semibold text-indigo-600 mb-1">เลขที่ทะเบียน</p>
                        <form method="POST" action="{{ route('newregis.update', $drug->id) }}">
                            @csrf
                            @method('PUT')
                            <input type="text" name="registration_number"
                                class="border-gray-300 rounded-lg shadow-sm w-5/6 mt-1" placeholder="กรอกเลขที่ทะเบียน"
                                value="{{ $drug->registration_number }}">
                    </div>
                    <div>
                        <p class="font-semibold text-indigo-600 mb-1">ชื่อสามัญ</p>
                        <input type="text" name="common_name"
                            class="border-gray-300 rounded-lg shadow-sm w-5/6 mt-1 bg-gray-200"
                            placeholder="กรอกชื่อสามัญ" value="{{ $drug->chemicalImport->chemical_name_th }}" readonly>
                    </div>
                    <div>
                        <p class="font-semibold text-indigo-600 mb-1">สูตรอัตรส่วนผสมสารสำคัญและลักษณะ</p>
                        <input type="text" name="formula_of_ratio"
                            class="border-gray-300 rounded-lg shadow-sm w-5/6 mt-1"
                            placeholder="กรอกสูตรอัตรส่วนผสมของ..." value="{{ $drug->formula_of_ratio }}">
                    </div>
                    <div>
                        <p class="font-semibold text-indigo-600 mb-1">วันที่ยื่น Phase III</p>
                        <input type="date" name="date_request_phase_3"
                            class="border-gray-300 rounded-lg shadow-sm w-5/6 mt-1"
                            value="{{ $drug->date_request_phase_3 }}">
                    </div>
                    <div>
                        <p class="font-semibold text-indigo-600 mb-1">ผู้ขอขึ้นทะเบียน</p>
                        <select class="w-5/6 p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            name="registrant">
                            <option value="">-- เลือก --</option>
                            @foreach ($companies as $company)
                                <option value="{{ $company->full_name }}"
                                    {{ $drug->registrant == $company->full_name ? 'selected' : '' }}>
                                    {{ $company->full_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <p class="font-semibold text-indigo-600 mb-1">ชนิดทะเบียน</p>
                        <select class="w-5/6 p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            name="type_registration">
                            <option value="">-- เลือก --</option>
                            <option value="ชนิดที่ 2" {{ $drug->type_registration == 'ชนิดที่ 2' ? 'selected' : '' }}>
                                ชนิดที่ 2</option>
                            <option value="ชนิดที่ 3" {{ $drug->type_registration == 'ชนิดที่ 3' ? 'selected' : '' }}>
                                ชนิดที่ 3</option>
                        </select>
                    </div>
                    <div>
                        <p class="font-semibold text-indigo-600 mb-1">ประเภททะเบียน</p>
                        <select class="w-5/6 p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            name="registration_type">
                            <option value="">-- เลือก --</option>
                            <option value="นำเข้า (สารเข้มข้น)"
                                {{ $drug->registration_type == 'นำเข้า (สารเข้มข้น)' ? 'selected' : '' }}>นำเข้า
                                (สารเข้มข้น)</option>
                            <option value="นำเข้า (สำเร็จรูป)"
                                {{ $drug->registration_type == 'นำเข้า (สำเร็จรูป)' ? 'selected' : '' }}>นำเข้า
                                (สำเร็จรูป)</option>
                            <option value="ผลิต (ผสมปรุงแต่ง)"
                                {{ $drug->registration_type == 'ผลิต (ผสมปรุงแต่ง)' ? 'selected' : '' }}>ผลิต
                                (ผสมปรุงแต่ง)</option>
                            <option value="นำเข้า (แบ่งบรรจุ)"
                                {{ $drug->registration_type == 'นำเข้า (แบ่งบรรจุ)' ? 'selected' : '' }}>นำเข้า
                                (แบ่งบรรจุ)</option>
                        </select>
                    </div>
                    <div>
                        <p class="font-semibold text-indigo-600 mb-1">ชื่อการค้า</p>
                        <input type="text" name="request_number_phase_3"
                            class="border-gray-300 rounded-lg shadow-sm w-5/6 mt-1" placeholder="กรอกชื่อการค้า"
                            value="{{ $drug->trade_name }}">
                    </div>
                    <div>
                        <p class="font-semibold text-indigo-600 mb-1">ชื่อการที่</p>
                        <select
                            class="w-5/6 p-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                            name="name_position">
                            <option value="">-- เลือก --</option>
                            <option value="T" {{ $drug->name_position == 'T' ? 'selected' : '' }}>T</option>
                            <option value="-" {{ $drug->name_position == '-' ? 'selected' : '' }}>-</option>
                            <option value="1" {{ $drug->name_position == '1' ? 'selected' : '' }}>1</option>
                            <option value="2" {{ $drug->name_position == '2' ? 'selected' : '' }}>2</option>
                            <option value="3" {{ $drug->name_position == '3' ? 'selected' : '' }}>3</option>
                        </select>
                    </div>
                    <div>
                        <p class="font-semibold text-indigo-600 mb-1">ชื่อผู้นำเข้า</p>
                        <select class="w-5/6 p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            name="importer">
                            <option value="">-- เลือก --</option>
                            @foreach ($companies as $company)
                                <option value="{{ $company->full_name }}"
                                    {{ $drug->importer == $company->full_name ? 'selected' : '' }}>
                                    {{ $company->full_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <p class="font-semibold text-indigo-600 mb-1">ชื่อผู้จำหน่าย</p>
                        <select class="w-5/6 p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            name="distributor">
                            <option value="">-- เลือก --</option>
                            @foreach ($companies as $company)
                                <option value="{{ $company->full_name }}"
                                    {{ $drug->distributor == $company->full_name ? 'selected' : '' }}>
                                    {{ $company->full_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <p class="font-semibold text-indigo-600 mb-1">ประเภทของการใช้</p>
                        <select class="w-5/6 p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            name="type_of_use">
                            <option value="">-- เลือก --</option>
                            <option value="A : Acaricide (สารกำจัดไรศัตรูพืช)"
                                {{ $drug->type_of_use == 'A : Acaricide (สารกำจัดไรศัตรูพืช)' ? 'selected' : '' }}>A :
                                Acaricide (สารกำจัดไรศัตรูพืช)</option>
                            <option value="F : Fungicide (สารป้องกันกำจัดโรคพืช)"
                                {{ $drug->type_of_use == 'F : Fungicide (สารป้องกันกำจัดโรคพืช)' ? 'selected' : '' }}>F
                                : Fungicide (สารป้องกันกำจัดโรคพืช)</option>
                            <option value="H : Herbicide (สารกำจัดวัชพืช)"
                                {{ $drug->type_of_use == 'H : Herbicide (สารกำจัดวัชพืช)' ? 'selected' : '' }}>H :
                                Herbicide (สารกำจัดวัชพืช)</option>
                            <option value="I : Insecticide (สารกำจัดแมลง)"
                                {{ $drug->type_of_use == 'I : Insecticide (สารกำจัดแมลง)' ? 'selected' : '' }}>I :
                                Insecticide (สารกำจัดแมลง)</option>
                            <option value="M : Molluscicide (สารกำจัดหอย)"
                                {{ $drug->type_of_use == 'M : Molluscicide (สารกำจัดหอย)' ? 'selected' : '' }}>M :
                                Molluscicide (สารกำจัดหอย)</option>
                            <option value="N : Nematicide (สารกำจัดไส้เดือนฝอย)"
                                {{ $drug->type_of_use == 'N : Nematicide (สารกำจัดไส้เดือนฝอย)' ? 'selected' : '' }}>N
                                : Nematicide (สารกำจัดไส้เดือนฝอย)</option>
                            <option value="P : PlantGrowthRegulators (สารควบคุมการเจริญเติบโตของพืช)"
                                {{ $drug->type_of_use == 'P : PlantGrowthRegulators (สารควบคุมการเจริญเติบโตของพืช)' ? 'selected' : '' }}>
                                P : PlantGrowthRegulators (สารควบคุมการเจริญเติบโตของพืช)</option>
                            <option value="R : Rodenticide (สารกำจัดหนู)"
                                {{ $drug->type_of_use == 'R : Rodenticide (สารกำจัดหนู)' ? 'selected' : '' }}>R :
                                Rodenticide (สารกำจัดหนู)</option>
                        </select>
                    </div>
                    <div class="md:col-span-3">
                        <p class="font-semibold text-indigo-600 mb-1">รายละเอียดขนาดบรรจุ</p>
                        <textarea name="packaging_size_details"
                            class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" rows="2">{{ $drug->packaging_size_details }}</textarea>
                    </div>
                    <div>
                        <p class="font-semibold text-indigo-600 mb-1">วันที่ยื่นคำขอ</p>
                        <input type="date" name="date_submit_request"
                            class="border-gray-300 rounded-lg shadow-sm w-5/6 mt-1"
                            value="{{ $drug->date_submit_request }}">
                    </div>
                    <div>
                        <p class="font-semibold text-indigo-600 mb-1">เลขที่รับคำขอ</p>
                        <input type="text" name="request_number_1"
                            class="border-gray-300 rounded-lg shadow-sm w-5/6 mt-1" placeholder="กรอกเลขที่รับคำขอ"
                            value="{{ $drug->request_number_1 }}">
                    </div>
                    <div>
                        <p class="font-semibold text-indigo-600 mb-1">เลข # Phase I</p>
                        <input type="text" name="request_number_phase_1"
                            class="border-gray-300 rounded-lg shadow-sm w-5/6 mt-1" placeholder="กรอกเลข # Phase I"
                            value="{{ $drug->request_number_phase_1 }}">
                    </div>

                    <div class="md:col-span-3">
                        <p class="font-semibold text-indigo-600 mb-1">อื่นๆ (ระบุ)</p>
                        <textarea name="remarks" class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            rows="2">{{ $drug->remarks }}</textarea>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <a href="{{ route('newregis.index') }}"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-lg shadow transition duration-300 mr-2">
                        <i class="fa-solid fa-arrow-left mr-2"></i> ย้อนกลับ
                    </a>
                    <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg shadow transition">
                        <i class="fa-solid fa-floppy-disk mr-1"></i> บันทึก
                    </button>
                </div>
                </form>

                {{-- ไทม์ไลน์การขึ้นทะเบียน --}}
                <div class="mt-8">
                    @php
                        $subStepsAll = [
                            1 => [
                                'title' => 'คณะ PDC อนุมัติให้ดำเนินการขึ้นทะเบียน',
                                'items' => [
                                    'จัดซื้อต่างประเทศ' => ['ทะเบียน', 'ใบอนุญาตในประเทศผู้ผลิต', 'เอกสารอนุญาตอื่นๆ'],
                                    'ฝ่ายขาย' => ['รายชื่อผู้ขอขึ้นทะเบียน', 'ชื่อการค้า', 'Packing'],
                                    'วิจัยและพัฒนา' => ['เตรียมข้อมูลผลิตตัวอย่าง'],
                                    'แผนกวิชาการ' => ['แผนการทดลอง'],
                                    'แผนกทะเบียน' => [
                                        'ตรวจสอบเอกสารขึ้นทะเบียน',
                                        'ตรวจชื่อการค้า',
                                        'ขอใบอนุญาตนำเข้าตัวอย่าง',
                                        'อื่นๆ',
                                    ],
                                ],
                            ],
                            2 => [
                                'title' => 'นำเข้าตัวอย่าง',
                                'items' => [
                                    'จัดซื้อต่างประเทศ' => ['ประสานเพื่อนำเข้าตัวอย่าง'],
                                    'วิจัยและพัฒนา' => ['จัดเตรียมตัวอย่าง'],
                                    'แผนกทะเบียน' => ['ส่งตัวอย่างให้วิจัยและพัฒนา', 'ขอใบอนุญาตผลิต', 'ตรวจ COA'],
                                ],
                            ],
                            3 => [
                                'title' => 'ส่งข้อมูลศึกษาความเป็นพิษ (Tox)',
                                'items' => [
                                    'จัดซื้อต่างประเทศ' => ['ประสานเพื่อส่งออกตัวอย่าง', 'Data requirement จากผู้ผลิต'],
                                    'แผนกทะเบียน' => [
                                        'ประสานส่งออกตัวอย่าง',
                                        'ตรวจผลการศึกษา Tox',
                                        'เตรียมข้อมูลประกอบการยื่นขอขึ้นทะเบียน',
                                    ],
                                ],
                            ],
                            4 => [
                                'title' => 'ยื่นคำขอขึ้นทะเบียน',
                                'items' => [
                                    'จัดซื้อต่างประเทศ' => [
                                        'ทะเบียน',
                                        'ใบอนุญาตในประเทศผู้ผลิต (ส่ง DOA)',
                                        'เอกสารอนุญาตอื่นๆ',
                                    ],
                                    'วิจัยและพัฒนา' => ['เตรียมและส่งตัวอย่างให้ทะเบียน'],
                                    'แผนกวิชาการ' => ['ติดตามแผนการทดลอง Eff+ PHI (ถ้ามี)'],
                                    'แผนกทะเบียน' => [
                                        'รวบรวมข้อมูลและเอกสารยื่นขอขขึ้นทะเบียนตามที่ DOA กำหนด',
                                        'ติดตามผล Phase I',
                                    ],
                                ],
                            ],
                            5 => [
                                'title' => 'แผนการทดลอง Eff, PHI (ถ้ามี) + Phase I+ ผลวิเคราะห์ (อนุมัติ)',
                                'items' => [
                                    'แผนกทะเบียน' => [
                                        'รวบรวมข้อมูล',
                                        'เอกสารยื่นขอขึ้นทะเบียนตามที่ DOA กำหนด',
                                        'ติดตามผล Phase I',
                                    ],
                                    'แผนกวิชาการ' => [
                                        'รับแผนการทดลอง Eff, PHI (ถ้ามี)',
                                        'ทำการทดลอง Eff และผลการทดลอง PHI (ถ้ามี)',
                                    ],
                                    'วิจัยและพัฒนา' => [
                                        'รับทราบผลวิเคราะห์ในกรณีที่วิเคราะห์ไม่ผ่าน',
                                        'ส่งตัวอย่างให้ทะเบียนเพื่อยื่นขอขึ้นทะเบียนใหม่',
                                    ],
                                ],
                            ],
                            6 => [
                                'title' => 'ยื่น Phase III (ผลการทดลอง Eff, PHI (ถ้ามี)อนุมัติ+ผลวิเคราะห์อนุมัติ)',
                                'items' => [
                                    'แผนกวิชาการ' => ['ติดตามผลการทดลอง Eff', 'ผลการทดลอง PHI (ถ้ามี) จนอนุมัติ'],
                                    'แผนกทะเบียน' => [
                                        'รวบรวมข้อมูล',
                                        ' ผล Eff +ผล PHI (ถ้ามี) ที่อนุมัติ',
                                        ' เอกสารตามที่ DOA กำหนด และติดตามผล Phase III',
                                    ],
                                    'จัดซื้อต่างประเทศ' => [
                                        'ประสานขอเอกสารจากผู้ผลิตเพิ่มเติมในกรณีที่ผลพิจารณา Tox Phase III ไม่ผ่าน',
                                    ],
                                ],
                            ],
                            7 => [
                                'title' => 'Phase III อนุมัติ (ยื่นเอกสารเข้าประชุมพิจารณาขึ้นทะเบียน)',
                                'items' => [
                                    'แผนกทะเบียน' => [
                                        'แผนกทะเบียนได้รับผล Tox Phase III ที่อนุมัติ
                    ทำการรวบรวมข้อมูลเอกสารยื่นขอเข้าประชุมพิจารณาขึ้นทะเบียนใหม่',
                                    ],
                                ],
                            ],
                            8 => [
                                'title' => 'ยื่นขอออกทะเบียน',
                                'items' => [
                                    'ฝ่ายขาย' => ['สรุป packing และจัดทำ A/W'],
                                    'แผนกทะเบียน' => [
                                        'จัดเตรียมคำขอขึ้นทะเบียน',
                                        'ร่างฉลาก',
                                        'มติพิจารณาขึ้นทะเบียน',
                                        ' A/W',
                                    ],
                                ],
                            ],
                        ];

                        $completedStepFlags = [];
                        foreach ($subStepsAll as $step => $data) {
                            $totalSubSteps = collect($data['items'])->flatten()->count();
                            $completedCount = $drug->stepSubSteps($step)->whereNotNull('checked_at')->count();
                            $completedStepFlags[$step] = $totalSubSteps > 0 && $completedCount === $totalSubSteps;
                        }

                        $canEdit = auth()->user()->hasRole('admin') || auth()->user()->hasRole('manager');
                    @endphp

                    @foreach ($subStepsAll as $stepNumber => $stepData)
                        @php
                            $stepTitle = $stepData['title'];
                            $departments = $stepData['items'];
                            $savedSubSteps = $drug->stepSubSteps($stepNumber)->get()->keyBy('sub_step_index');

                            $allSubLabels = collect($departments)->flatten()->values()->all();
                            $totalSub = count($allSubLabels);
                            $completedCount = $savedSubSteps->whereNotNull('checked_at')->count();
                            $percent = $totalSub > 0 ? round(($completedCount / $totalSub) * 100, 2) : 0;

                            $completedStepFlags[$stepNumber] = $totalSub > 0 && $completedCount === $totalSub;

                            $canEdit = auth()->user()->hasRole('admin') || auth()->user()->hasRole('manager');
                            $previousStepsCompleted = collect(range(1, $stepNumber - 1))->every(
                                fn($s) => $completedStepFlags[$s] ?? false,
                            );
                            $isVisible = $stepNumber === 1 || $previousStepsCompleted;
                            $isEditable = $canEdit && $isVisible && $percent < 100;
                        @endphp
                        @if ($isVisible)
                            {{-- โค้ดแสดงแบบฟอร์มของขั้นตอนนี้ --}}
                            <form method="POST" action="{{ route('newregis.update-subprogress', $drug->id) }}">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="step_number" value="{{ $stepNumber }}">

                                <div class="mt-8 bg-gray-50 border border-gray-200 rounded-xl p-4">
                                    <h4 class="text-lg font-semibold text-indigo-600 mb-3">
                                        ขั้นตอนที่ {{ $stepNumber }}: {{ $stepTitle }}
                                    </h4>

                                    {{-- แถบสถานะ --}}
                                    <div class="mb-4">
                                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                                            <div class="h-2.5 rounded-full @if ($percent < 25) bg-red-500 @elseif ($percent < 75) bg-yellow-500 @else bg-green-500 @endif"
                                                style="width: {{ $percent }}%">
                                            </div>
                                        </div>
                                        <div class="text-xs text-gray-500 text-right mt-1">{{ $percent }}%</div>
                                    </div>

                                    {{-- รายการ checkbox --}}
                                    <div class="space-y-6">
                                        @php $checkboxIndex = 0; @endphp
                                        @php
                                            $userDept = auth()->user()->department;
                                            // ถ้าไม่ใช่ admin หรือ manager ให้เห็นเฉพาะหัวข้อของแผนกตัวเอง
                                            if (
                                                !auth()->user()->hasRole('admin') &&
                                                !auth()->user()->hasRole('manager')
                                            ) {
                                                $departments = collect($departments)
                                                    ->filter(fn($items, $deptName) => $deptName === $userDept)
                                                    ->all();
                                            }
                                        @endphp
                                        @foreach ($departments as $dept => $subItems)
                                            <div>
                                                <h5 class="text-sm font-bold text-gray-700 mb-2">{{ $dept }}
                                                </h5>

                                                <div class="space-y-2 pl-4">
                                                    @foreach ($subItems as $label)
                                                        @php
                                                            $record = $savedSubSteps[$checkboxIndex] ?? null;
                                                            $isChecked = $record && $record->checked_at;
                                                        @endphp
                                                        <div class="flex items-center justify-between">
                                                            <div class="flex items-center space-x-3">
                                                                <input type="checkbox" name="sub_steps[]"
                                                                    id="vehicle1_{{ $label }}"
                                                                    value="{{ $checkboxIndex }}"
                                                                    {{ $isChecked ? 'checked' : '' }}
                                                                    {{ !$isEditable ? 'disabled' : '' }}
                                                                    class="w-5 h-5 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                                                                <label for="vehicle1_{{ $label }}"
                                                                    class="text-sm text-gray-800">{{ $label }}</label>
                                                            </div>
                                                        </div>
                                                        @php $checkboxIndex++; @endphp
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    @if ($isEditable && $percent < 100)
                                        <div class="text-center mt-4">
                                            <a href="{{ route('newregis.index') }}"
                                                class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-lg shadow transition duration-300 mr-2">
                                                <i class="fa-solid fa-arrow-left mr-2"></i> ย้อนกลับ
                                            </a>
                                            <button type="submit"
                                                class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg shadow transition">
                                                <i class="fa-solid fa-floppy-disk mr-1"></i> บันทึกความคืบหน้า
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            </form>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </main>

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
                    window.location.href = "{{ route('newregis.index') }}";
                }
            });
        </script>
    @endif
</x-app-layout>
