<x-app-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-tr from-purple-200 to-blue-100">
        <main class="w-full max-w-5xl bg-white rounded-3xl shadow-lg p-10 flex flex-col items-start justify-center">
            <div class="flex justify-center w-full mb-8">
                <div class="flex w-full max-w-3xl">
                    <div class="flex-1 flex flex-col items-center">
                        <span class="text-sm font-semibold mb-1">Registration</span>
                        <div id="stepIndicator1"
                             class="w-6 h-6 flex items-center justify-center rounded-full border-2 border-blue-500 bg-green-400 text-white font-bold transition-all duration-200">
                            1</div>
                    </div>
                    <div class="flex-1 flex flex-col items-center">
                        <span class="text-sm font-semibold mb-1">Protocol (Efficacy)</span>
                        <div id="stepIndicator2"
                             class="w-6 h-6 flex items-center justify-center rounded-full border-2 border-gray-300 bg-gray-200 text-gray-400 font-bold transition-all duration-200">
                            2</div>
                    </div>
                    <div class="flex-1 flex flex-col items-center">
                        <span class="text-sm font-semibold mb-1">Report (Efficacy)</span>
                        <div id="stepIndicator3"
                             class="w-6 h-6 flex items-center justify-center rounded-full border-2 border-gray-300 bg-gray-200 text-gray-400 font-bold transition-all duration-200">
                            3</div>
                    </div>
                    <div class="flex-1 flex flex-col items-center">
                        <span class="text-sm font-semibold mb-1">Protocol (Residue)</span>
                        <div id="stepIndicator4"
                             class="w-6 h-6 flex items-center justify-center rounded-full border-2 border-gray-300 bg-gray-200 text-gray-400 font-bold transition-all duration-200">
                            4</div>
                    </div>
                    <div class="flex-1 flex flex-col items-center">
                        <span class="text-sm font-semibold mb-1">Report (Residue)</span>
                        <div id="stepIndicator5"
                             class="w-6 h-6 flex items-center justify-center rounded-full border-2 border-gray-300 bg-gray-200 text-gray-400 font-bold transition-all duration-200">
                            5</div>
                    </div>
                </div>
            </div>
            <hr class="mb-8 w-full max-w-3xl mx-auto">
            <form method="POST"
                  action="{{ route('admin.posts.store') }}"
                  id="multiStepForm"
                  class="w-full max-w-3xl mx-auto flex flex-col items-start justify-center">
                @csrf

                <div id="step1"
                     style="margin-left: 20px;">
                    <div class="grid grid-cols-2 gap-x-3 gap-y-6 items-center">
                        <label class="col-span-1 text-lg font-medium text-gray-700">ชื่อสามัญ (Eng) :</label>
                        <input type="text"
                               name="common_name_eng"
                               class="col-span-1 border rounded-lg px-4 py-2 w-full"
                               placeholder="-" />

                        <label class="col-span-1 text-lg font-medium text-gray-700">เปอร์เซ็นและสูตร :</label>
                        <input type="text"
                               name="percent_formula"
                               class="col-span-1 border rounded-lg px-4 py-2 w-full"
                               placeholder="-" />

                        <label class="col-span-1 text-lg font-medium text-gray-700">ชื่อการค้า :</label>
                        <input type="text"
                               name="trade_name"
                               class="col-span-1 border rounded-lg px-4 py-2 w-full"
                               placeholder="-" />

                        <label class="col-span-1 text-lg font-medium text-gray-700">ผู้ยื่นขอขึ้นทะเบียน :</label>
                        <input type="text"
                               name="registrant"
                               class="col-span-1 border rounded-lg px-4 py-2 w-full"
                               placeholder="-" />

                        <label class="col-span-1 text-lg font-medium text-gray-700">ผู้จำหน่าย :</label>
                        <input type="text"
                               name="distributor"
                               class="col-span-1 border rounded-lg px-4 py-2 w-full"
                               placeholder="-" />

                        <label class="col-span-1 text-lg font-medium text-gray-700">ผู้นำเข้า :</label>
                        <input type="text"
                               name="importer"
                               class="col-span-1 border rounded-lg px-4 py-2 w-full"
                               placeholder="-" />

                        <label class="col-span-1 text-lg font-medium text-gray-700">Trial (สรุปฝ่ายขาย) :</label>
                        <input type="text"
                               name="trial_summary"
                               class="col-span-1 border rounded-lg px-4 py-2 w-full"
                               placeholder="-" />

                        <label
                               class="col-span-1 text-lg font-medium text-gray-700">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    </div>
                </div>

                <div id="step2"
                     style="margin-left: 20px;">
                    <div class="grid grid-cols-2 gap-x-3 gap-y-6 items-center">
                        <label class="col-span-1 text-lg font-medium text-gray-700">Crop :</label>
                        <input type="text"
                               name="crop"
                               class="col-span-1 border rounded-lg px-4 py-2 w-full"
                               placeholder="-" />

                        <label class="col-span-1 text-lg font-medium text-gray-700">Pest :</label>
                        <input type="text"
                               name="pest"
                               class="col-span-1 border rounded-lg px-4 py-2 w-full"
                               placeholder="-" />

                        <label class="col-span-1 text-lg font-medium text-gray-700">ส่งแผนการทดลองให้แผนกทะเบียน
                            :</label>
                        <input type="text"
                               name="protocol_sent"
                               class="col-span-1 border rounded-lg px-4 py-2 w-full"
                               placeholder="-" />

                        <label class="col-span-1 text-lg font-medium text-gray-700">Inspector ให้แก้ไขแผนการทดลอง
                            (Status):</label>
                        <input type="text"
                               name="protocol_inspector_status"
                               class="col-span-1 border rounded-lg px-4 py-2 w-full"
                               placeholder="-" />

                        <label class="col-span-1 text-lg font-medium text-gray-700">แผนการทดลอง (Approved) :</label>
                        <input type="text"
                               name="protocol_approved"
                               class="col-span-1 border rounded-lg px-4 py-2 w-full"
                               placeholder="-" />

                        <label
                               class="col-span-1 text-lg font-medium text-gray-700">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    </div>
                </div>

                <div id="step3"
                     style="margin-left: 20px;">
                    <div class="grid grid-cols-2 gap-x-3 gap-y-6 items-center">
                        <label class="col-span-1 text-lg font-medium text-gray-700">ส่งผลการทดลองให้ทะเบียน :</label>
                        <input type="text"
                               name="efficacy_report_sent"
                               class="col-span-1 border rounded-lg px-4 py-2 w-full"
                               placeholder="-" />

                        <label class="col-span-1 text-lg font-medium text-gray-700">Efficacy Status :</label>
                        <input type="text"
                               name="efficacy_status"
                               class="col-span-1 border rounded-lg px-4 py-2 w-full"
                               placeholder="-" />

                        <label class="col-span-1 text-lg font-medium text-gray-700">Report Approval (ผ่านประชุม
                            สอพ/พืชสวน) :</label>
                        <input type="text"
                               name="efficacy_report_approval"
                               class="col-span-1 border rounded-lg px-4 py-2 w-full"
                               placeholder="-" />

                        <label class="col-span-1 text-lg font-medium text-gray-700"> ผู้รับผิดชอบหลัก/ผู้ควบคุมแปลง
                            :</label>
                        <input type="text"
                               name="efficacy_responsible_person"
                               class="col-span-1 border rounded-lg px-4 py-2 w-full"
                               placeholder="-" />

                        <label
                               class="col-span-1 text-lg font-medium text-gray-700">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    </div>
                </div>

                <div id="step4"
                     style="margin-left: 20px;">
                    <div class="grid grid-cols-2 gap-x-3 gap-y-6 items-center">
                        <label class="col-span-1 text-lg font-medium text-gray-700">ส่งแผนพิษตกค้างให้แผนกทะเบียน
                            :</label>
                        <input type="text"
                               name="residue_protocol_sent"
                               class="col-span-1 border rounded-lg px-4 py-2 w-full"
                               placeholder="-" />

                        <label class="col-span-1 text-lg font-medium text-gray-700">Inspector ให้แก้ไขแผนพิษตกค้าง
                            (Status) :</label>
                        <input type="text"
                               name="residue_protocol_inspector_status"
                               class="col-span-1 border rounded-lg px-4 py-2 w-full"
                               placeholder="-" />

                        <label class="col-span-1 text-lg font-medium text-gray-700">แผนพิษตกค้าง (Approved) :</label>
                        <input type="text"
                               name="residue_protocol_approved"
                               class="col-span-1 border rounded-lg px-4 py-2 w-full"
                               placeholder="-" />

                        <label
                               class="col-span-1 text-lg font-medium text-gray-700">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    </div>
                </div>

                <div id="step5"
                     style="margin-left: 20px;">
                    <div class="grid grid-cols-2 gap-x-3 gap-y-6 items-center">
                        <label class="col-span-1 text-lg font-medium text-gray-700">ส่งผลพิษตกค้างให้ทะเบียน :</label>
                        <input type="text"
                               name="residue_report_sent"
                               class="col-span-1 border rounded-lg px-4 py-2 w-full"
                               placeholder="-" />

                        <label class="col-span-1 text-lg font-medium text-gray-700">Residue Status :</label>
                        <input type="text"
                               name="residue_status"
                               class="col-span-1 border rounded-lg px-4 py-2 w-full"
                               placeholder="-" />

                        <label class="col-span-1 text-lg font-medium text-gray-700">Report Approval (ผ่าน กปผ)
                            :</label>
                        <input type="text"
                               name="residue_report_approval"
                               class="col-span-1 border rounded-lg px-4 py-2 w-full"
                               placeholder="-" />

                        <label class="col-span-1 text-lg font-medium text-gray-700">ผู้รับผิดชอบหลัก/ผู้ควบคุมแปลง
                            :</label>
                        <input type="text"
                               name="residue_responsible_person"
                               class="col-span-1 border rounded-lg px-4 py-2 w-full"
                               placeholder="-" />

                        <label
                               class="col-span-1 text-lg font-medium text-gray-700">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    </div>
                </div>

                <div id="btn-jus"
                     class="flex justify-between mt--50 w-full max-w-3xl mx-auto">
                    <button type="button"
                            id="prevBtn"
                            class="bg-gray-400 text-white font-bold px-10 py-2 rounded-full shadow hover:bg-gray-500 transition-colors text-lg">ย้อนกลับ</button>
                    <div>
                        <button type="button"
                                id="nextBtn"
                                class="bg-indigo-600 text-white font-bold px-10 py-2 rounded-full shadow hover:bg-indigo-700 transition-colors text-lg">ถัดไป</button>
                        <button type="submit"
                                id="submitBtn"
                                class="hidden bg-green-500 text-white font-bold px-10 py-2 rounded-full shadow hover:bg-green-600 transition-colors text-lg">บันทึก</button>
                    </div>
                </div>

            </form>
        </main>
    </div>

    <script>
        const btnJus = document.getElementById('btn-jus');
        const steps = [
            document.getElementById('step1'),
            document.getElementById('step2'),
            document.getElementById('step3'),
            document.getElementById('step4'),
            document.getElementById('step5')
        ];
        const indicators = [
            document.getElementById('stepIndicator1'),
            document.getElementById('stepIndicator2'),
            document.getElementById('stepIndicator3'),
            document.getElementById('stepIndicator4'),
            document.getElementById('stepIndicator5')
        ];
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        const submitBtn = document.getElementById('submitBtn');
        let currentStep = 0;

        function showStep(idx) {
            steps.forEach((step, i) => {
                if (step) step.classList.toggle('hidden', i !== idx);
            });
            indicators.forEach((ind, i) => {
                // Reset all indicators
                ind.classList.remove('bg-green-400', 'text-white', 'border-blue-500', 'bg-gray-200',
                    'text-gray-400', 'border-gray-300');
                ind.innerHTML = (i + 1).toString();
                // Completed steps
                if (i < idx) {
                    ind.classList.add('bg-green-400', 'text-white', 'border-blue-500');
                    ind.innerHTML =
                        `<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>`;
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

            // Control visibility of buttons
            if (currentStep === 0) {
                prevBtn.classList.add('hidden');
                // เปลี่ยน justify-between เป็น justify-end เมื่ออยู่หน้า 1
                btnJus.classList.remove('justify-between');
                btnJus.classList.add('justify-end');
            } else {
                prevBtn.classList.remove('hidden');
                // ถ้าไม่ใช่หน้า 1 ให้เป็น justify-between
                btnJus.classList.remove('justify-end');
                btnJus.classList.add('justify-between');
                // btnJus.classList.add('mt-10');
            }

            if (currentStep === steps.length - 1) {
                nextBtn.classList.add('hidden');
                submitBtn.classList.remove('hidden');
            } else {
                nextBtn.classList.remove('hidden');
                submitBtn.classList.add('hidden');
            }
        }

        nextBtn.onclick = function() {
            if (currentStep < steps.length - 1) {
                currentStep++;
                showStep(currentStep);
            }
        };

        prevBtn.onclick = function() {
            if (currentStep > 0) {
                currentStep--;
                showStep(currentStep);
            }
        };

        showStep(currentStep);
    </script>

</x-app-layout>
