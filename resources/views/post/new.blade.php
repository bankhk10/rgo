<x-app-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-tr from-purple-200 to-blue-100">
        <main class="w-full max-w-5xl bg-white rounded-3xl shadow-lg p-10">
            <!-- Stepper -->
            <div class="flex justify-between items-center mb-8">
                <div class="flex-1 flex flex-col items-center">
                    <span class="text-sm font-semibold mb-1">Registration</span>
                    <div id="stepIndicator1" class="w-6 h-6 flex items-center justify-center rounded-full border-2 border-blue-500 bg-green-400 text-white font-bold transition-all duration-200">1</div>
                </div>
                <div class="flex-1 flex flex-col items-center">
                    <span class="text-sm font-semibold mb-1">Protocol (Efficacy)</span>
                    <div id="stepIndicator2" class="w-6 h-6 flex items-center justify-center rounded-full border-2 border-gray-300 bg-gray-200 text-gray-400 font-bold transition-all duration-200">2</div>
                </div>
                <div class="flex-1 flex flex-col items-center">
                    <span class="text-sm font-semibold mb-1">Report (Efficacy)</span>
                    <div id="stepIndicator3" class="w-6 h-6 flex items-center justify-center rounded-full border-2 border-gray-300 bg-gray-200 text-gray-400 font-bold transition-all duration-200">3</div>
                </div>
                <div class="flex-1 flex flex-col items-center">
                    <span class="text-sm font-semibold mb-1">Protocol (Residue)</span>
                    <div id="stepIndicator4" class="w-6 h-6 flex items-center justify-center rounded-full border-2 border-gray-300 bg-gray-200 text-gray-400 font-bold transition-all duration-200">4</div>
                </div>
                <div class="flex-1 flex flex-col items-center">
                    <span class="text-sm font-semibold mb-1">Report (Residue)</span>
                    <div id="stepIndicator5" class="w-6 h-6 flex items-center justify-center rounded-full border-2 border-gray-300 bg-gray-200 text-gray-400 font-bold transition-all duration-200">5</div>
                </div>
            </div>
            <hr class="mb-8">

            <form method="POST" action="{{ route('admin.posts.store') }}" id="multiStepForm">
                @csrf

                <!-- Step 1 -->
                <div id="step1">
                    <div class="grid grid-cols-2 gap-x-10 gap-y-6">
                        <label class="flex items-center justify-end text-lg font-medium text-gray-700">ชื่อสามัญ (Eng) :</label>
                        <input type="text" name="common_name" class="border rounded-lg px-4 py-2 w-full" placeholder="-" />

                        <label class="flex items-center justify-end text-lg font-medium text-gray-700">เปอร์เซ็นและสูตร :</label>
                        <input type="text" name="percent_formula" class="border rounded-lg px-4 py-2 w-full" placeholder="-" />

                        <label class="flex items-center justify-end text-lg font-medium text-gray-700">ชื่อการค้า :</label>
                        <input type="text" name="trade_name" class="border rounded-lg px-4 py-2 w-full" placeholder="-" />

                        <label class="flex items-center justify-end text-lg font-medium text-gray-700">ผู้ยื่นขอขึ้นทะเบียน :</label>
                        <input type="text" name="registrant" class="border rounded-lg px-4 py-2 w-full" placeholder="-" />

                        <label class="flex items-center justify-end text-lg font-medium text-gray-700">ผู้จำหน่าย :</label>
                        <input type="text" name="distributor" class="border rounded-lg px-4 py-2 w-full" placeholder="-" />

                        <label class="flex items-center justify-end text-lg font-medium text-gray-700">ผู้นำเข้า :</label>
                        <input type="text" name="importer" class="border rounded-lg px-4 py-2 w-full" placeholder="-" />

                        <label class="flex items-center justify-end text-lg font-medium text-gray-700">Trial (สรุปฝ่ายขาย) :</label>
                        <input type="text" name="trial" class="border rounded-lg px-4 py-2 w-full" placeholder="-" />
                    </div>
                    <div class="flex justify-end mt-10">
                        <button type="button" id="nextBtn"
                            class="bg-indigo-600 text-white font-bold px-10 py-2 rounded-full shadow hover:bg-indigo-700 transition-colors text-lg">ถัดไป</button>
                    </div>
                </div>

                <!-- Step 2 -->
                <div id="step2" class="hidden">
                    <div class="text-center text-2xl text-gray-600 mb-10">Protocol (Efficacy)</div>
                    <div class="grid grid-cols-2 gap-x-10 gap-y-6">
                        <label class="flex items-center justify-end text-lg font-medium text-gray-700">รายละเอียด Protocol :</label>
                        <input type="text" name="protocol_detail" class="border rounded-lg px-4 py-2 w-full" placeholder="-" />
                    </div>
                    <div class="flex justify-between mt-10">
                        <button type="button" id="prevBtn"
                            class="bg-gray-400 text-white font-bold px-10 py-2 rounded-full shadow hover:bg-gray-500 transition-colors text-lg">ย้อนกลับ</button>
                        <button type="button" id="nextBtn2"
                            class="bg-indigo-600 text-white font-bold px-10 py-2 rounded-full shadow hover:bg-indigo-700 transition-colors text-lg">ถัดไป</button>
                    </div>
                </div>

                <!-- Step 3 -->
                <div id="step3" class="hidden">
                    <div class="text-center text-2xl text-gray-600 mb-10">Report (Efficacy)</div>
                    <div class="grid grid-cols-2 gap-x-10 gap-y-6">
                        <label class="flex items-center justify-end text-lg font-medium text-gray-700">รายละเอียด Report (Efficacy) :</label>
                        <input type="text" name="report_efficacy_detail" class="border rounded-lg px-4 py-2 w-full" placeholder="-" />
                    </div>
                    <div class="flex justify-between mt-10">
                        <button type="button" id="prevBtn3"
                            class="bg-gray-400 text-white font-bold px-10 py-2 rounded-full shadow hover:bg-gray-500 transition-colors text-lg">ย้อนกลับ</button>
                        <button type="button" id="nextBtn3"
                            class="bg-indigo-600 text-white font-bold px-10 py-2 rounded-full shadow hover:bg-indigo-700 transition-colors text-lg">ถัดไป</button>
                    </div>
                </div>

                <!-- Step 4 -->
                <div id="step4" class="hidden">
                    <div class="text-center text-2xl text-gray-600 mb-10">Protocol (Residue)</div>
                    <div class="grid grid-cols-2 gap-x-10 gap-y-6">
                        <label class="flex items-center justify-end text-lg font-medium text-gray-700">รายละเอียด Protocol (Residue) :</label>
                        <input type="text" name="protocol_residue_detail" class="border rounded-lg px-4 py-2 w-full" placeholder="-" />
                    </div>
                    <div class="flex justify-between mt-10">
                        <button type="button" id="prevBtn4"
                            class="bg-gray-400 text-white font-bold px-10 py-2 rounded-full shadow hover:bg-gray-500 transition-colors text-lg">ย้อนกลับ</button>
                        <button type="submit"
                            class="bg-indigo-600 text-white font-bold px-10 py-2 rounded-full shadow hover:bg-indigo-700 transition-colors text-lg">บันทึก</button>
                    </div>
                </div>


            </form>
        </main>
    </div>

    <script>
        // Stepper logic
        const steps = [
            document.getElementById('step1'),
            document.getElementById('step2'),
            document.getElementById('step3'),
            document.getElementById('step4')
        ];
        const indicators = [
            document.getElementById('stepIndicator1'),
            document.getElementById('stepIndicator2'),
            document.getElementById('stepIndicator3'),
            document.getElementById('stepIndicator4'),
            document.getElementById('stepIndicator5')
        ];
        let currentStep = 0;

        function showStep(idx) {
            steps.forEach((step, i) => {
                if (step) step.classList.toggle('hidden', i !== idx);
            });
            indicators.forEach((ind, i) => {
                // Reset all indicators
                ind.classList.remove('bg-green-400', 'text-white', 'border-blue-500', 'bg-gray-200', 'text-gray-400', 'border-gray-300');
                ind.innerHTML = (i + 1).toString();
                // Completed steps
                if (i < idx) {
                    ind.classList.add('bg-green-400', 'text-white', 'border-blue-500');
                    ind.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>`;
                }
                // Current step
                else if (i === idx) {
                    ind.classList.add('bg-green-400', 'text-white', 'border-blue-500');
                }
                // Next steps
                else {
                    ind.classList.add('bg-gray-200', 'text-gray-400', 'border-gray-300');
                }
            });
        }

        document.getElementById('nextBtn').onclick = function () {
            if (currentStep < steps.length - 1) {
                currentStep++;
                showStep(currentStep);
            }
        };
        document.getElementById('nextBtn2').onclick = function () {
            if (currentStep < steps.length - 1) {
                currentStep++;
                showStep(currentStep);
            }
        };
        document.getElementById('nextBtn3').onclick = function () {
            if (currentStep < steps.length - 1) {
                currentStep++;
                showStep(currentStep);
            }
        };
        document.getElementById('prevBtn').onclick = function () {
            if (currentStep > 0) {
                currentStep--;
                showStep(currentStep);
            }
        };
        document.getElementById('prevBtn3').onclick = function () {
            if (currentStep > 0) {
                currentStep--;
                showStep(currentStep);
            }
        };
        document.getElementById('prevBtn4').onclick = function () {
            if (currentStep > 0) {
                currentStep--;
                showStep(currentStep);
            }
        };
        showStep(currentStep);
    </script>
</x-app-layout>
