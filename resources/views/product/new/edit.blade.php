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
                        <p class="font-semibold text-indigo-600">เลขที่ทะเบียน</p>
                        <form method="POST" action="{{ route('newregis.update-reg-number', $drug->id) }}">
                            @csrf
                            @method('PUT')
                            <input type="text" name="registration_number"
                                class="border-gray-300 rounded-lg shadow-sm w-80 mt-1" placeholder="กรอกเลขที่ทะเบียน"
                                value="{{ $drug->registration_number }}" required>
                    </div>
                    <div>
                        <p class="font-semibold text-indigo-600">วันที่ขึ้นทะเบียน</p>
                        <input type="date" name="registration_date"
                            class="border-gray-300 rounded-lg shadow-sm w-80 mt-1"
                            value="{{ $drug->created_at->format('Y-m-d') }}" readonly>
                    </div>
                    <div>
                        <p class="font-semibold text-indigo-600">ชื่อสามัญ</p>
                        <input type="text" name="common_name" class="border-gray-300 rounded-lg shadow-sm w-80 mt-1"
                            placeholder="กรอกชื่อสามัญ" value="{{ $drug->chemicalImport->chemical_name_th }}" readonly>
                    </div>
                    <div>
                        <p class="font-semibold text-indigo-600">ชื่อทางการค้า</p>
                        <input type="text" name="trade_name" class="border-gray-300 rounded-lg shadow-sm w-80 mt-1"
                            placeholder="กรอกชื่อทางการค้า" value="{{ $drug->trade_name }}" readonly>
                    </div>
                    <div>
                        <p class="font-semibold text-indigo-600">ชื่อผู้ผลิตและแหล่งผลิต</p>
                        <input type="text" name="manufacturer_name"
                            class="border-gray-300 rounded-lg shadow-sm w-80 mt-1" placeholder="กรอกชื่อผู้ผลิต"
                            value="{{ $drug->manufacturer_origin }}" readonly>
                    </div>
                    <div>
                        <p class="font-semibold text-indigo-600">ชื่อผู้นำเข้า</p>
                        <input type="text" name="importer_name"
                            class="border-gray-300 rounded-lg shadow-sm w-80 mt-1" placeholder="กรอกชื่อผู้นำเข้า"
                            value="{{ $drug->importer_name }}" readonly>
                    </div>
                    <div>
                        <p class="font-semibold text-indigo-600">ชื่อผู้จำหน่าย/ผู้จัดจำหน่าย</p>
                        <input type="text" name="distributor_name"
                            class="border-gray-300 rounded-lg shadow-sm w-80 mt-1" placeholder="กรอกชื่อผู้จำหน่าย"
                            value="{{ $drug->distributor_name }}" readonly>
                        {{-- <p>{{ $drug->distributor_name ?? '-' }}</p> --}}
                    </div>
                    <div>
                        <p class="font-semibold text-indigo-600">วัตถุประสงค์และประเภทของการใช้</p>
                        <input type="text" name="purpose_and_type_of_use"
                            class="border-gray-300 rounded-lg shadow-sm w-80 mt-1"
                            placeholder="กรอกวัตถุประสงค์และประเภทของการใช้"
                            value="{{ $drug->purpose_and_type_of_use }}" readonly>
                    </div>
                    <div>
                        <p class="font-semibold text-indigo-600">ชนิดและลักษณะหรือภาชนะบรรจุ</p>
                        <input type="text" name="packaging_type"
                            class="border-gray-300 rounded-lg shadow-sm w-80 mt-1"
                            placeholder="กรอกชนิดและลักษณะหีบห่อหรือภาชนะบรรจุ" value="{{ $drug->packaging_type }}"
                            readonly>
                    </div>
                    {{-- <div>
                        <p class="font-semibold text-indigo-600">อื่นๆ (ระบุ)</p>
                        <textarea type="text" name="other_details" class="border-gray-300 rounded-lg shadow-sm w-64 mt-1"
                            placeholder="กรอกรายละเอียดอื่นๆ" value="{{ $drug->notes }}" readonly>
                    </div> --}}


                    <div class="md:col-span-1.5">
                        {{-- <label class="block text-gray-700 mb-1">หมายเหตุ</label> --}}
                        <p class="font-semibold text-indigo-600">อื่นๆ (ระบุ)</p>
                        <textarea name="note" class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            rows="2"></textarea>
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
                    {{-- <h2 class="text-2xl font-bold text-indigo-700 mb-6">ไทม์ไลน์การขึ้นทะเบียน</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-lg text-gray-700 mt-6">
                        <div>
                            <p class="font-semibold text-indigo-600">สถานะความคืบหน้าโดยรวม:</p>
                            <div class="w-full bg-gray-200 rounded-full h-2.5 mt-2">
                                <div class="h-2.5 rounded-full
                                @if ($drug->progress < 25) bg-red-500
                                @elseif ($drug->progress < 75) bg-yellow-500
                                @else bg-green-500 @endif" style="width: {{ $drug->progress }}%">
                                </div>
                            </div>
                            <div class="text-xs text-gray-500 text-center mt-1">
                                {{ $drug->progress }}%
                            </div>
                        </div>
                    </div> --}}

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
                        $isEditable = $canEdit && $isVisible && $percent < 100; @endphp @if ($isVisible)
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
                                                            @if ($isChecked)
                                                                {{-- <div class="text-sm text-gray-500">
                                                <i class="fa-solid fa-clock mr-1 text-gray-400"></i>
                                                {{ \Carbon\Carbon::parse($record->checked_at)->format('d/m/Y H:i') }}
                                            </div> --}}
                                                            @endif
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
                {{-- <div class="text-center mt-12">
                    <a href="{{ route('newregis.index') }}"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-lg shadow transition duration-300">
                        <i class="fa-solid fa-arrow-left mr-2"></i> ย้อนกลับ
                    </a>
                </div> --}}
            </div>
        </div>
    </main>
</x-app-layout>
