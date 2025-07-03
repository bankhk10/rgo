<x-app-layout>
    <div class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-2xl space-y-6 mt-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4 text-center">แบบฟอร์มขึ้นทะเบียนใหม่</h2>
        <form method="POST" action="{{ route('newregis.store') }}" class="grid grid-cols-2 md:grid-cols-2 gap-4">
            @csrf
            <div>
                <label class="block text-gray-700 mb-1">ชื่อสามัญ</label>
                <input type="text" id="productSearch"
                    class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="พิมพ์ชื่อสามัญ..." oninput="autocompleteSearch(this.value)" autocomplete="off" />
                <ul id="autocomplete-list"
                    class="absolute z-10 bg-white border w-80 rounded-lg shadow max-h-60 overflow-y-auto hidden">
                </ul>
                <input type="hidden" id="hazardous_name_th" name="chemical_name_th" />
                <input type="hidden" id="formulation_ratio"
                    class="w-full p-2 border rounded-lg bg-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    name="common_name" readonly />
                <input type="hidden" id="chemical_imports_id"
                    class="w-full p-2 border rounded-lg bg-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    name="chemical_imports_id" readonly />
            </div>
            <div>
                <label class="block text-gray-700 mb-1">สูตรอัตรส่วนผสมของสารสำคัญและลักษณะ</label>
                <input type="text"
                    class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    name="formula_of_ratio" />
            </div>
            <div>
                <label class="block text-gray-700 mb-1">วันที่ยื่น Phase III</label>
                <input type="date" name="date_request_phase_3"
                    class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            <div>
                <label class="block text-gray-700 mb-1">เลข # Phase III</label>
                <input type="text"
                    class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    name="request_number_phase_3" />
            </div>
            <div>
                <label class="block text-gray-700 mb-1">ผู้ขอขึ้นทะเบียน</label>
                <select class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    name="registrant">
                    <option value="">-- เลือก --</option>
                    @foreach ($companies as $company)
                        <option value="{{ $company->full_name }}">{{ $company->full_name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-gray-700 mb-1">ชนิดทะเบียน</label>
                <select class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    name="type_registration">
                    <option value="">-- เลือก --</option>
                    <option value="ชนิดที่ 2">ชนิดที่ 2</option>
                    <option value="ชนิดที่ 3">ชนิดที่ 3</option>
                </select>
            </div>

            <div>
                <label class="block text-gray-700 mb-1">ประเภททะเบียน</label>
                <select class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    name="registration_type">
                    <option value="">-- เลือก --</option>
                    <option value="นำเข้า (สารเข้มข้น)">นำเข้า (สารเข้มข้น)</option>
                    <option value="นำเข้า (สำเร็จรูป)">นำเข้า (สำเร็จรูป)</option>
                    <option value="ผลิต (ผสมปรุงแต่ง)">ผลิต (ผสมปรุงแต่ง)</option>
                    <option value="นำเข้า (แบ่งบรรจุ)">นำเข้า (แบ่งบรรจุ)</option>
                </select>
            </div>

            <div>
                <label class="block text-gray-700 mb-1">ชื่อการค้า</label>
                <input type="text"
                    class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    name="trade_name" />
            </div>
            <div>
                <label class="block text-gray-700 mb-1">ชื่อการที่</label>
                <select class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    name="name_position">
                    <option value="">-- เลือก --</option>
                    <option value="T">T</option>
                    <option value="-">-</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </select>
            </div>

            <div>
                <label class="block text-gray-700 mb-1">ชื่อผู้นำเข้า</label>
                <select class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    name="importer">
                    <option value="">-- เลือก --</option>
                    @foreach ($companies as $company)
                        <option value="{{ $company->full_name }}">{{ $company->full_name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-gray-700 mb-1">ชื่อผู้จำหน่าย</label>
                <select class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    name="distributor">
                    <option value="">-- เลือก --</option>
                    @foreach ($companies as $company)
                        <option value="{{ $company->full_name }}">{{ $company->full_name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-gray-700 mb-1">ชื่อผู้ผลิตและแหล่งผลิต</label>
                <input type="text"
                    class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    name="manufacturer" />
            </div>

            <div>
                <label class="block text-gray-700 mb-1">ประเภทของการใช้</label>
                <select class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    name="type_of_use">
                    <option value="">-- เลือก --</option>
                    <option value="A : Acaricide (สารกำจัดไรศัตรูพืช)">A : Acaricide (สารกำจัดไรศัตรูพืช)</option>
                    <option value="F : Fungicide (สารป้องกันกำจัดโรคพืช)">F : Fungicide (สารป้องกันกำจัดโรคพืช)</option>
                    <option value="H : Herbicide (สารป้องกันกำจัดโรคพืช)">H : Herbicide (สารกำจัดวัชพืช)</option>
                    <option value="I : Insecticide (สารกำจัดแมลง)">I : Insecticide (สารกำจัดแมลง)</option>
                    <option value="M : Molluscicide (สารกำจัดหอย)">M : Molluscicide (สารกำจัดหอย)</option>
                    <option value="N : Nematicide (สารกำจัดไส้เดือนฝอย)">N : Nematicide (สารกำจัดไส้เดือนฝอย)</option>
                    <option value="P : PlantGrowthRegulators (สารควบคุมการเจริญเติบโตของพืช)">P : PlantGrowthRegulators
                        (สารควบคุมการเจริญเติบโตของพืช)</option>
                    <option value="R : Rodenticide (สารกำจัดหนู)">R : Rodenticide (สารกำจัดหนู)</option>
                </select>
            </div>

            <div class="md:col-span-2">
                <label class="block text-gray-700 mb-1">รายละเอียดขนาดบรรจุ</label>
                <textarea name="packaging_size_details"
                    class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" rows="2"></textarea>
            </div>

            <div class="md:col-span-2">
                <div class="flex flex-col md:flex-row gap-4">
                    <div class="w-full md:w-1/3">
                        <label class="block text-gray-700 mb-1">วันที่ยื่นคำขอ</label>
                        <input type="date" name="date_submit_request"
                            class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    </div>

                    <div class="w-full md:w-1/3">
                        <label class="block text-gray-700 mb-1">เลขที่รับคำขอ</label>
                        <input type="text" name="request_number_1"
                            class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    </div>

                    <div class="w-full md:w-1/3">
                        <label class="block text-gray-700 mb-1">เลข # Phase I</label>
                        <input type="text" name="request_number_phase_1"
                            class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    </div>
                </div>
            </div>

            <div class="md:col-span-2">
                <label class="block text-gray-700 mb-1">อื่นๆ (ระบุ)</label>
                <textarea name="remarks" class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    rows="2"></textarea>
            </div>

            <div class="text-right mt-8">
                <a href="{{ route('newregis.index') }}"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-lg shadow transition duration-300 ">
                    <i class="fa-solid fa-arrow-left mr-2"></i> ย้อนกลับ
                </a>
            </div>
            <div class="text-left mt-6">
                <button type="submit"
                    class="bg-blue-800 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline shadow-md">
                    บันทึก
                </button>
            </div>

        </form>
    </div>

    <script>
        document.getElementById('menu-newregis')?.classList.add('side-menu--active');

        let typingTimer;
        const delay = 300;
        const listElement = document.getElementById("autocomplete-list");
        // เราไม่จำเป็นต้องใช้ userSelected flag แล้วครับ เพราะ clearFields() จะถูกเรียกใช้เมื่อ keyword เป็นค่าว่าง
        // หรือเมื่อไม่มีข้อมูลกลับมาจาก API หรือเกิดข้อผิดพลาด
        // และเรามี logic ใน window.addEventListener("click") เพื่อจัดการกรณีที่ผู้ใช้พิมพ์แล้วไม่ได้เลือก

        // กำหนดตัวแปรสำหรับ Element ของฟิลด์ต่างๆ ล่วงหน้า
        const productSearchInput = document.getElementById("productSearch");
        const hazardousNameThInput = document.getElementById("hazardous_name_th");
        const formulationRatioInput = document.getElementById("formulation_ratio");
        const chemicalImportsId = document.getElementById("chemical_imports_id");

        // เนื่องจาก expiry_date ถูกคอมเมนต์ออกไป ผมจะไม่รวมไว้ใน clearFields()
        // แต่ถ้าคุณต้องการนำกลับมาใช้ อย่าลืมเพิ่ม const สำหรับมันด้วย
        // const expiryDateInput = document.querySelector('input[name="expiry_date"]');

        function autocompleteSearch(keyword) {
            clearTimeout(typingTimer);

            if (!keyword.trim()) {
                listElement.innerHTML = "";
                listElement.classList.add("hidden");
                clearFields(); // ✅ ล้างค่าเมื่อช่องว่าง
                return;
            }

            typingTimer = setTimeout(() => {
                fetch('/api/products/search-list?name=' + encodeURIComponent(keyword))
                    .then(res => res.json())
                    .then(data => {
                        listElement.innerHTML = "";
                        listElement.classList.remove("hidden");

                        // ตรวจสอบว่า `data` เป็น array และมีข้อมูลหรือไม่
                        // หาก API ส่งรูปแบบอื่นมา (เช่น { data: [] } หรือ { results: [] })
                        // คุณอาจต้องปรับ `data` เป็น `data.data` หรือ `data.results` ก่อน
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
                    .catch(err => {
                        console.error("Autocomplete error", err);
                        clearFields(); // เคลียร์ค่าเมื่อเกิดข้อผิดพลาด
                        listElement.innerHTML = "";
                        listElement.classList.add("hidden");
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

        function clearFields() {
            hazardousNameThInput.value = "";
            formulationRatioInput.value = "";
            chemicalImportsId.value = "";
            // ถ้ามีการนำ expiry_date กลับมาใช้ ให้ uncomment บรรทัดนี้
            // if (expiryDateInput) {
            //     expiryDateInput.value = "";
            // }
            // หากคุณต้องการเคลียร์ productSearchInput ด้วยเมื่อ clearFields ถูกเรียก
            // productSearchInput.value = "";
        }

        // ซ่อนรายการ autocomplete เมื่อคลิกข้างนอก
        window.addEventListener("click", function(e) {
            if (!productSearchInput.contains(e.target) && !listElement.contains(e.target)) {
                listElement.classList.add("hidden");
                // ถ้าช่องค้นหาว่างเปล่าหลังการคลิกนอก แสดงว่าผู้ใช้ไม่ได้เลือกรายการ
                // หรือลบข้อความออกไปแล้ว จึงควรเคลียร์ข้อมูล
                if (!productSearchInput.value.trim()) {
                    clearFields();
                }
            }
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
                    window.location.href = "{{ route('newregis.index') }}";
                }
            })
        </script>
    @endif

    <style>
        .bg-gray-200 {
            background-color: #e2e8f0;
        }

        input[readonly].bg-gray-200 {
            background-color: #e2e8f0 !important;
        }
    </style>

</x-app-layout>
