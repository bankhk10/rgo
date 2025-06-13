<x-app-layout>
    <main class="flex-1 overflow-x-hidden overflow-y-auto">
        <div class="container mx-auto px-6 py-6">
            <h1 class="text-4xl font-extrabold text-center text-indigo-700 mt-5 mb-10 tracking-wide">
                รายละเอียดสินค้า: {{ $drug->name }}
            </h1>

            <div class="bg-white rounded-2xl overflow-hidden shadow-lg p-8 border border-gray-200">
                {{-- รายละเอียดข้อมูลยา --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-lg text-gray-700">
                    <div>
                        <p class="font-semibold text-indigo-600">ชื่อสามัญ:</p>
                        <p>{{ $drug->name }}</p>
                    </div>
                    <div>
                        <p class="font-semibold text-indigo-600">เลขที่ทะเบียน:</p>
                        <p>{{ $drug->registration_number }}</p>
                    </div>
                    <div>
                        <p class="font-semibold text-indigo-600">วันที่ขึ้นทะเบียน:</p>
                        <p>{{ $drug->expiry_date->format('d/m/Y') }}</p>
                    </div>
                    <div>
                        <p class="font-semibold text-indigo-600">รายละเอียด:</p>
                        <p>{{ $drug->description ?? 'ไม่มีรายละเอียดเพิ่มเติม' }}</p>
                    </div>
                </div>

                @php
                // dd($drug->progress);
                    // กำหนด mapping ของ progress กับขั้นตอน
                    // คุณสามารถปรับค่าเหล่านี้ให้ตรงกับ logic การคำนวณ progress ของคุณ
                    $totalSteps = 8;
                    $steps = [
                        1 => ['label' => 'คณะ PDC อนุมัติให้ดำเนินการขึ้นทะเบียน', 'progress_threshold' => 12.5], // 1/8 * 100
                        2 => ['label' => '1', 'progress_threshold' => 25], // 2/8 * 100
                        3 => ['label' => '2', 'progress_threshold' => 37.5], // 3/8 * 100
                        4 => ['label' => '3', 'progress_threshold' => 50], // 4/8 * 100
                        5 => ['label' => '4', 'progress_threshold' => 62.5], // 5/8 * 100
                        6 => ['label' => '5', 'progress_threshold' => 75], // 6/8 * 100
                        7 => ['label' => '66', 'progress_threshold' => 87.5], // 7/8 * 100
                        8 => ['label' => 'การเฝ้าระวังหลังการขาย', 'progress_threshold' => 100], // 8/8 * 100
                    ];

                    // คำนวณขั้นตอนปัจจุบัน
                    $currentStep = 0;
                    foreach ($steps as $key => $step) {
                        if ($drug->progress >= $step['progress_threshold']) {
                            $currentStep = $key;
                        } else {
                            // หาก progress ยังไม่ถึง threshold ของขั้นตอนปัจจุบัน
                            // และขั้นตอนก่อนหน้าไม่ถึง 100% (คือไม่ใช่ขั้นตอนสุดท้าย)
                            // ให้กำหนดขั้นตอนปัจจุบันเป็นขั้นตอนที่เรายังทำไม่เสร็จ
                            if ($currentStep < $key) {
                                $currentStep = $key;
                                break;
                            }
                        }
                    }
                    if ($drug->progress == 0) {
                        $currentStep = 1;
                    } elseif ($drug->progress == 100) {
                        $currentStep = $totalSteps;
                    }
                @endphp

                {{-- Timeline ของขั้นตอนการดำเนินการ --}}
                <div class="mt-8">
                    <h2 class="text-2xl font-bold text-indigo-700 mb-6">ไทม์ไลน์การขึ้นทะเบียน</h2>
                    @foreach (array_chunk($steps, 4, true) as $chunk)
                        <ol class="items-center sm:flex space-y-4 sm:space-y-0 mb-6 {{ $loop->first ? '' : 'mt-6' }}">
                            @foreach ($chunk as $stepNumber => $stepInfo)
                                @php
                                    $isCompleted = $drug->progress >= $stepInfo['progress_threshold'];
                                    $isCurrent = ($stepNumber == $currentStep && $drug->progress < 100) || ($stepNumber == $totalSteps && $drug->progress == 100);

                                    $iconClass = $isCompleted ? 'text-white' : 'text-blue-800 dark:text-blue-300';
                                    $bgClass = $isCompleted ? 'bg-green-500' : ($isCurrent ? 'bg-blue-500 ring-4 ring-blue-300' : 'bg-blue-100');
                                    $lineClass = $isCompleted ? 'bg-green-500' : 'bg-gray-200 dark:bg-gray-700';
                                    $dotClass = $isCurrent ? 'ring-blue-500 dark:ring-blue-500' : 'ring-white dark:ring-gray-900';
                                @endphp
                                <li class="relative mb-6 sm:mb-0 w-full sm:w-1/4">
                                    <div class="flex items-center">
                                        <div
                                            class="z-10 flex items-center justify-center w-8 h-8 rounded-full ring-0 sm:ring-8 shrink-0
                                            {{ $bgClass }} {{ $dotClass }}">
                                            @if ($isCompleted)
                                                <svg class="w-4 h-4 {{ $iconClass }}" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                            @else
                                                <svg class="w-3 h-3 {{ $iconClass }}" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path
                                                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                                </svg>
                                            @endif
                                        </div>
                                        @if (!$loop->last || !$loop->parent->last)
                                            {{-- ซ่อนเส้นเชื่อมสำหรับขั้นตอนสุดท้ายของแต่ละแถว --}}
                                            <div class="hidden sm:flex w-full h-0.5 {{ $lineClass }}"></div>
                                        @endif
                                    </div>
                                    <div class="mt-3 sm:pr-8">
                                        <h3 class="text-gray-900 dark:text-white {{ $isCurrent ? 'font-bold text-blue-600' : '' }}">
                                            ขั้นตอนที่ {{ $stepNumber }}
                                        </h3>
                                        <p class="font-normal text-gray-500 dark:text-gray-400">
                                            {{ $stepInfo['label'] }}
                                        </p>
                                    </div>
                                </li>
                            @endforeach
                        </ol>
                    @endforeach
                </div>

                {{-- สถานะความคืบหน้าโดยรวม --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-lg text-gray-700 mt-6">
                    <div>
                        <p class="font-semibold text-indigo-600">สถานะความคืบหน้าโดยรวม:</p>
                        <div class="w-full bg-gray-200 rounded-full h-2.5 mt-2">
                            <div class="h-2.5 rounded-full
                                @if ($drug->progress < 25) bg-red-500
                                @elseif ($drug->progress < 75) bg-yellow-500
                                @else bg-green-500 @endif"
                                style="width: {{ $drug->progress }}%">
                            </div>
                        </div>
                        <div class="text-xs text-gray-500 text-center mt-1">
                            {{ $drug->progress }}%
                        </div>
                    </div>
                </div>

                {{-- ปุ่มกลับ --}}
                <div class="mt-8 text-center">
                    <a href="{{ url()->previous() }}"
                        class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        กลับ
                    </a>
                </div>
            </div>
        </div>
    </main>
</x-app-layout>
